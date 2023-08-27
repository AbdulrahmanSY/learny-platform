<?php

namespace App\Http\Requests\Post;

use App\Traits\ApiResponderTrait;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    use ApiResponderTrait;
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {

        if($this->input('type_id')==3){
            return [
                'title'=>['required','string'],
                'description'=>['required','string'],
                'type_id'=>['required','integer',Rule::exists('type_posts','id')],
                'language_id'=>['required','integer',Rule::exists('languages','id')],
                'content_levels_id'=>['required','integer',Rule::exists('content_levels','id')],
//                'files' => ['required', 'array', 'max:4', 'min:1'],
//                'files.*' => ['required',],
            ];
        }else{
            return [
                'title'=>['required','string'],
                'description'=>['required','string'],
                'type_id'=>['required','integer',Rule::exists('type_posts','id')],
                'language_id'=>['required','integer',Rule::exists('languages','id')],
                'content_levels_id'=>['required','integer',Rule::exists('content_levels','id')],
                'files' => ['required', 'array', 'max:4', 'min:1'],
                'files.*' => ['required',],
            ];
        }

    }
    public function failedValidation(Validator $validator)
    {
        $errors = $validator->errors()->all();
        throw new HttpResponseException($this->badRequestResponse('Bad input', $errors));
    }
}
