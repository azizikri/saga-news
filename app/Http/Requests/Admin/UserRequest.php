<?php

namespace App\Http\Requests\Admin;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => [Rule::when($this->isMethod('POST'), 'required', 'sometimes'), 'string', 'max:255'],
            'is_admin' => [Rule::when($this->isMethod('POST'), 'required', 'sometimes'), 'boolean'],
            'email' => [Rule::when($this->isMethod('POST'), 'required', 'sometimes'), 'string', 'email', 'max:255', Rule::unique('users', 'email')->ignore($this->user)],
            'password' => ['sometimes', 'string', 'min:8', 'confirmed', Password::defaults()],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->input('password') === null) {
            $this->request->remove('password');
        }

        if($this->isMethod('PATCH')){
            $fields = ['name', 'roles', 'email'];

            foreach ($fields as $field) {
                if ($this->input($field) === null) {
                    $this->request->remove($field);
                }
            }
        }
    }
}
