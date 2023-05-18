<?php

namespace App\Http\Requests;

use App\Models\Article;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize() : bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules() : array
    {
        return [
            'category_id' => [Rule::when($this->isMethod('POST'), 'required', 'sometimes'), 'exists:categories,id'],
            'title' => [Rule::when($this->isMethod('POST'), 'required', 'sometimes'), 'string', 'max:255'],
            'content' => [Rule::when($this->isMethod('POST'), 'required', 'sometimes'), 'string'],
            'banner' => [Rule::when($this->isMethod('POST'), 'required', 'sometimes'), 'image', 'max:1024', 'mime:jpeg,png,jpg,gif,webp'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->isMethod('PATCH')) {
            $fields = [
                'category_id',
                'title',
                'content',
            ];

            foreach ($fields as $field) {
                if ($this->input($field) === null) {
                    $this->request->remove($field);
                }
            }
        }
    }
}
