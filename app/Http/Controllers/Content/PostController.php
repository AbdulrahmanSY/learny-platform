<?php

namespace App\Http\Controllers\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Post\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use App\Models\Teacher;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function addPost(StorePostRequest $request)
    {
        try {
            DB::beginTransaction();
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            $values = $request->validated();
            $post = Post::create(
                [
                    'title' => $values['title'],
                    'description' => $values['description'],
                    'type_id' => $values['type_id'],
                    'language_id' => $values['language_id'],
                    'content_levels_id' => $values['content_levels_id'],
                    'teacher_id' => $teacher->id,
                ]);

            if (!empty($values['files'])) {
                foreach ($values['files'] as $file) {
                    if ($file !== null) {
                        $file_url = handleFile($file, 'post_file/');
                        $post->file()->create([
                            'file' => $file_url,
                        ]);
                    }
                }
            }

            DB::commit();
            return $this->success(message: trans('validation.custom.content.question.add'));
        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getMyPost()
    {
        try {
            $languageId = explode(',',request()->query('language_id')) ?? config('constants.content.language_default');
            $type_id = explode(',',request()->query('$type_id')) ?? config('constants.content.post.type_id');
            $content_level_Id =explode(',', request()->query('content_level_Id')) ?? config('constants.content.content_level_default');

            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            if (Post::where('teacher_id', $teacher->id)
                ->whereIn('content_levels_Id', $content_level_Id)
                ->whereIn('language_id', $languageId)
                ->whereIn('type_id', $type_id)
                ->exists()) {

                $post = Post::with('file', 'teacher', 'language', 'type', 'contentLevel')
                    ->where('teacher_id', $teacher->id)
                    ->whereIn('language_id', $languageId)
                    ->whereIn('content_levels_Id', $content_level_Id)
                    ->whereIn('type_id', $type_id)
                    ->paginate(config('constants.content.paginate'));

                return PostResource::collection($post);

            }
            return $this->success(message: trans('validation.custom.content.post.not_found'));
        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function deletePost(int $id): \Illuminate\Http\JsonResponse
    {
        try {
            DB::beginTransaction();
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();
            $post = Post::where('teacher_id', $teacher->id)->where('id', $id);
            if ($post->exists()) {
                DB::table('files_posts')->where('post_id', $teacher->id)->delete();
                $post->delete();
                DB::commit();
                return $this->success(message: trans('validation.custom.content.post.not_found.delete'));
            } else {
                return $this->success(message: trans('validation.custom.content.post.not_found'));
            }
        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getAllPost()
    {
        try {
            $followedTeachers = Auth::user()->follow;
            $languageId = explode(',',request()->query('language_id')) ?? config('constants.content.language_default');
            $type_id = explode(',',request()->query('type_id') )?? config('constants.content.post.type_id');
            $content_level_Id = explode(',',request()->query('content_level_Id') )?? config('constants.content.content_level_default');

            if (Post::whereIn('content_levels_Id', $content_level_Id)
                ->whereIn('language_id', $languageId)
                ->whereIn('type_id', $type_id)
                ->exists()) {

                $post = Post::with('file', 'teacher', 'language', 'type', 'contentLevel')
                    ->whereIn('language_id', $languageId)
                    ->whereIn('content_levels_Id', $content_level_Id)
                    ->whereIn('type_id', $type_id)
                    ;
                if ($followedTeachers->isNotEmpty()) {
                    $post->orderByRaw("FIELD(teacher_id, " . implode(',', $followedTeachers->pluck('id')->toArray()) . ") DESC")
                        ->orderBy('teacher_id');
                }
                return PostResource::collection($post->paginate(config('constants.content.paginate')));

            }
            return $this->success(message: trans('validation.custom.content.post.not_found'));
        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function getPost($id)
    {
        try {
            $user_id = Auth()->id();
            $teacher = Teacher::where('user_id', $user_id)->first();

            if (Post::with('file', 'teacher', 'language', 'type', 'contentLevel')
                ->where('id', $id)
                ->where('teacher_id', $teacher->id)
                ->exists()) {
                $post = Post::with('file', 'teacher', 'language', 'type', 'contentLevel')
                    ->where('id', $id)
                    ->where('teacher_id', $teacher->id)->get();
                return $this->success(
                    PostResource::collection(
                        $post
                    )
                );
            }
            return $this->success(message: trans('validation.custom.content.post.not_found'));

        } catch (Exception $ex) {
            return $this->error(errors: $ex->getMessage());
        }
    }

    public function edit(Post $post)
    {
        //
    }

}
