<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Questions\StoreAnswersRequest;
use App\Http\Requests\Questions\StoreQuestionsRequest;
use App\Http\Requests\Questions\UpdateQuestionsRequest;
use App\Http\Resources\QuestionsResource;
use App\Models\Questions;
use App\Models\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class QuestionsController extends Controller
{
    public function createQuestion(StoreQuestionsRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            $values = $request->validated();
            $question = Questions::create(
                [
                    'question' => $values['question'],
                    'content_levels_id' => $values['content_levels_id'],
                    'explanation' => $values['explanation'],
                    'category_id' => $values['category_id'],
                    'teacher_id' => $teacher->id,
                ]);

            foreach ($values['answers'] as $answer) {
                $question->answer()->create([
                    'answer' => $answer['answer'],
                    'correct' => $answer['correct'],
                ]);
            }
            DB::commit();
            return $this->success(message: trans('validation.custom.content.question.add'));
        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function editQuestion(UpdateQuestionsRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if (Questions::where('teacher_id', $teacher->id)->where('id', $request->input('id'))->exists()) {
                $values = $request->validated();
                $question = Questions::findOrFail($request->input('id'));
                $question->update([
                    'question' => $values['question'],
                    'content_levels_id' => $values['content_levels_id'],
                    'explanation' => $values['explanation'],
                    'category_id' => $values['category_id'],
                ]);

                // Delete all existing answers and create new ones
                $question->answer()->delete();
                foreach ($values['answers'] as $answer) {
                    $question->answer()->create([
                        'answer' => $answer['answer'],
                        'correct' => $answer['correct'],
                    ]);
                }

                DB::commit();
                return $this->success(new QuestionsResource($question));
            } else {
                DB::rollback();
                return $this->error(message: trans('validation.custom.content.question.permission'));
            }
        } catch (Exception $ex) {
            DB::rollback();
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getAllQuestion()
    {
        try {

            $followedTeachers = User::find(\auth()->id())->follow;
            $questionSolve = User::find(\auth()->id())->questions;


            $languageId = explode(',', request()->query('language_id')) ?? config('constants.content.language_default');
            $category_Id =  explode(',',request()->query('category_id') )?? config('constants.content.category_default');
            $content_level_Id = explode(',', request()->query('content_level_Id')) ?? config('constants.content.content_level_default');
            if (Questions::with('answer', 'category')->whereIn('content_levels_Id', $content_level_Id)
                ->whereHas('category.language', function ($query) use ($languageId) {
                    $query->whereIn('id', $languageId);
                })->whereHas('category', function ($query) use ($category_Id) {
                    $query->whereIn('id', $category_Id);
                })
                ->exists()) {

                $questions = Questions::with('answer', 'category')
                    ->whereIn('content_levels_Id', $content_level_Id)
                    ->whereHas('category.language', function ($q) use ($languageId) {
                        $q->whereIn('id', $languageId);
                    })
                    ->whereHas('category', function ($q) use ($category_Id) {
                        $q->whereIn('id', $category_Id);
                    });

                $questionSolveIds = $questionSolve->pluck('id')->toArray();
                $followedTeacherIds = $followedTeachers->pluck('id')->toArray();

                if ($followedTeachers->isNotEmpty()) {
                    $questions->orderByRaw("FIELD(teacher_id, " . implode(',', $followedTeacherIds) . ") DESC")
//                        ->orderByRaw("FIELD(id, " . implode(',', $questionSolveIds) . ") ASC")
                        ->orderBy('teacher_id');
                }else if ($questionSolve->isNotEmpty()){

                    $questions->orderByRaw("FIELD(id, " . implode(',', $questionSolveIds) . ") ASC");
                }

                $questionList = $questions->paginate();
                $questionList->getCollection()->transform(function ($question) use ($questionSolveIds) {
                    $question->is_solved = in_array($question->id, $questionSolveIds);
                    return $question;
                });
                return QuestionsResource::collection($questionList);

            }
            return $this->success(message: trans('validation.custom.content.question.not_found'));

        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function solveQuestion(StoreAnswersRequest $request): JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $value = $request->validated();
            if ($user->questions()
                ->wherePivot('question_id', $value['question_id'])->wherePivot('user_id', $user->id)
                ->exists()) {
                $user->questions()->updateExistingPivot($value['question_id'], ['answer_id' => $value['answer_id']]);
                DB::commit();
                return $this->success(message:trans('validation.custom.content.question.update_answered'));
            } else {

                $user->questions()->attach($value['question_id'], ['answer_id' => $value['answer_id']]);
                DB::commit();
                return $this->success(message: trans('validation.custom.content.question.answered'));
            }
        } catch (Exception $ex) {
            DB::rollBack();
            return $this->error(errors: $ex->getMessage());
        }


    }

    public function getMyQuestion()
    {
        try {
            $languageId = explode(',',request()->query('language_id')) ?? config('constants.content.language_default');
            $category_Id = explode(',', request()->query('category_id')) ?? config('constants.content.category_default');
            $content_level_Id = explode(',',request()->query('content_level_Id')) ?? config('constants.content.content_level_default');

            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();

            if (Questions::with('answer', 'category')
                ->where('teacher_id', $teacher->id)
                ->whereIn('content_levels_Id', $content_level_Id)
                ->whereHas('category.language', function ($query) use ($languageId) {
                    $query->whereIn('id', $languageId);
                })->whereHas('category', function ($query) use ($category_Id) {
                    $query->whereIn('id', $category_Id);
                })->exists()) {

                $questions = Questions::with('answer', 'category')
                    ->where('teacher_id', $teacher->id)
                    ->whereIn('content_levels_Id', $content_level_Id)
                    ->whereHas('category.language', function ($query) use ($languageId) {
                        $query->whereIn('id', $languageId);
                    })->whereHas('category', function ($query) use ($category_Id) {
                        $query->whereIn('id', $category_Id);
                    })->paginate(config('constants.content.paginate'));

                return QuestionsResource::collection($questions);
            }
            return $this->success(message: trans('validation.custom.content.question.not_found'));

        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getQuestion($id): JsonResponse
    {
        try {
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if (Questions::with('answer', 'category')
                ->where('id', $id)
                ->where('teacher_id', $teacher->id)
                ->exists()) {
                $questions = Questions::with('answer', 'category')
                    ->where('id', $id)
                    ->where('teacher_id', $teacher->id)
                    ->first();
                return $this->success(new QuestionsResource($questions));
            }
            return $this->success(message: trans('validation.custom.content.question.not_found'));

        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function deleteQuestion($questions_id): JsonResponse
    {
        try {
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if (Questions::where('id', $questions_id)->where('teacher_id', $teacher->id)->exists()) {

                $question = Questions::find($questions_id);
                $question->delete();
                return $this->success(message: trans('validation.custom.content.question.delete'));

            }
            return $this->success(message: trans('validation.custom.content.question.permission'));

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

}
