<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Paragraph\AppreciationRequest;
use App\Http\Requests\Paragraph\StoreParagraphRequest;
use App\Http\Requests\Paragraph\UpdateParagraphRequest;
use App\Http\Resources\ParagraphResource;
use App\Models\Paragraph;
use App\Models\Teacher;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ParagraphController extends Controller
{
    public function createParagraph(StoreParagraphRequest $request): \Illuminate\Http\JsonResponse
    {

        try {
            DB::beginTransaction();
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            $values = $request->validated();
            $paragraph = Paragraph::create([
                'paragraph' => $values['paragraph'],
                'paragraph_category_id' => $values['paragraph_category_id'],
                'language_id' => $values['language_id'],
                'content_levels_id' => $values['content_levels_id'],
                'teacher_id' => $teacher->id,

            ]);
            DB::commit();
            return $this->success(trans('validation.custom.content.paragraph.add'));
        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function editParagraph(UpdateParagraphRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if (Paragraph::where('teacher_id', $teacher->id)->where('id', $request->input('id'))->exists()) {
                $values = $request->validated();
                $paragraph = Paragraph::findOrFail($request->input('id'));
                $paragraph->update([
                    'paragraph' => $values['paragraph'],
                    'paragraph_category_id' => $values['paragraph_category_id'],
                    'language_id' => $values['language_id'],
                    'content_levels_id' => $values['content_levels_id'],
                ]);

                DB::commit();
                return $this->success(trans('validation.custom.content.paragraph.update'));
            } else {
                DB::rollback();
                return $this->success(message: trans('validation.custom.content.paragraph.permission'));
            }
        } catch (Exception $ex) {
            DB::rollback();
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getAllParagraph()
    {
        try {
            $followedTeachers = Auth::user()->follow;
            $languageId = explode(',',request()->query('language_id') )?? config('constants.content.language_default');
            $paragraph_category_id = explode(',',request()->query('category_id')) ?? config('constants.content.paragraph_category');
            $content_level_Id = explode(',',request()->query('content_level_Id')) ?? config('constants.content.content_level_default');

            if (Paragraph::whereIn('language_id', $languageId)
                ->whereIn('content_levels_id', $content_level_Id)
                ->whereIn('paragraph_category_id', $paragraph_category_id)->exists()) {

                $paragraph = Paragraph::whereIn('language_id', $languageId)
                    ->whereIn('content_levels_id', $content_level_Id)
                    ->whereIn('paragraph_category_id', $paragraph_category_id)
                    ->with('category', 'teacher', 'language');
                if ($followedTeachers->isNotEmpty()) {
                                  $paragraph->orderByRaw("FIELD(teacher_id, " . implode(',', $followedTeachers->pluck('id')->toArray()) . ") DESC")
                        ->orderBy('teacher_id');
                }
                return  ParagraphResource::collection($paragraph->paginate());
            } else {

                return $this->success(message: trans('validation.custom.content.paragraph.not_found'));
            }
        } catch (Exception $ex) {

            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getMyParagraph()
    {
        $user_id = Auth()->id();
        $teacher = Teacher::where('user_id', $user_id)->first();
        try {
            $languageId = explode(',',request()->query('language_id') )?? config('constants.content.language_default');
            $paragraph_category_id = explode(',',request()->query('category_id')) ?? config('constants.content.paragraph_category');
            $content_level_Id = explode(',',request()->query('content_level_Id')) ?? config('constants.content.content_level_default');

            if (Paragraph::whereIn('language_id', $languageId)
                ->where('teacher_id', $teacher->id)
                ->whereIn('content_levels_id', $content_level_Id)
                ->whereIn('paragraph_category_id', $paragraph_category_id)
                ->exists()) {

                $paragraph = Paragraph::whereIn('language_id', $languageId)
                    ->where('teacher_id', $teacher->id)
                    ->whereIn('content_levels_id', $content_level_Id)
                    ->whereIn('paragraph_category_id', $paragraph_category_id)
                    ->with('category', 'teacher', 'language')
                    ->paginate();
                return ParagraphResource::collection($paragraph);
            } else {
                DB::rollback();
                return $this->success(message: trans('validation.custom.content.paragraph.not_found'));
            }
        } catch (Exception $ex) {

            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getParagraph($id)
    {
        try {
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if (Paragraph::where('id', $id)
                ->where('teacher_id', $teacher->id)
                ->exists()) {
                $paragraph = Paragraph::with('category', 'teacher', 'language')
                    ->where('id', $id)
                    ->where('teacher_id', $teacher->id)
                    ->first();
                return $this->success(new ParagraphResource($paragraph));
            }
            return  $this->success(message: trans('validation.custom.content.paragraph.not_found'));

        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function deleteParagraph($id): \Illuminate\Http\JsonResponse
    {
        try {
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if (Paragraph::where('id', $id)->where('teacher_id', $teacher->id)->exists()) {

                $question = Paragraph::find($id);
                $question->delete();
                return $this->success(message: trans('validation.custom.content.paragraph.delete'));

            }
            return $this->success(message: trans('validation.custom.content.paragraph.permission'));

        } catch (Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function addAppreciation(AppreciationRequest $request): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $user = Auth::user();
            $value = $request->validated();

            if ($user->paragraph()
                ->wherePivot('paragraph_id', $value['paragraph_id'])->wherePivot('user_id', $user->id)
                ->exists()) {

                $user->paragraph()->updateExistingPivot($value['paragraph_id'], ['Appreciation' => $value['appreciation']]);
                DB::commit();
                return $this->success(message:trans('validation.custom.content.paragraph.update_appreciation'));
            } else {

                $user->paragraph()->attach($value['paragraph_id'], ['Appreciation' => $value['appreciation']]);
                DB::commit();
                return $this->success(message: trans('validation.custom.content.paragraph.appreciation'));
            }
        } catch (Exception $ex) {
            DB::rollBack();
            return $this->error(errors: $ex->getMessage());
        }
    }

}
