<?php

namespace App\Http\Requests\Paragraph;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateParagraphRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {

        return [
            'paragraph' => ['string', 'min:2'],
            'paragraph_category_id' => ['required', 'integer', Rule::exists('paragraph_categories', 'id')],
            'language_id' => ['integer', 'integer', Rule::exists('languages', 'id')],
            'content_levels_id' => ['integer', Rule::exists('content_levels', 'id')],
        ];

    }
}
