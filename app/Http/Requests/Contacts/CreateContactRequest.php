<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;

class CreateContactRequest extends FormRequest
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
            'name'     => 'required',
            'email'    => 'required|email',
            'phone'    => 'required',
            'category' => 'required|int',
            'file'     => 'nullable|file|mimes:jpg,png,jpeg,webp|max:2048',
            'lat'      => 'nullable|numeric',
            'long'     => 'nullable|numeric'
        ];
    }

    public function messages()
    {
        return [
            'category.integer' => 'Category is required'
        ];
    }
}
