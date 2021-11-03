<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatorUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_names' => ['nullable', 'max:255', 'string'],
            'last_names' => ['nullable', 'max:255', 'string'],
            'is_author' => ['nullable', 'boolean'],
            'is_editor' => ['nullable', 'boolean'],
            'is_translator' => ['nullable', 'boolean'],
            'is_compiler' => ['nullable', 'boolean'],
        ];
    }
}
