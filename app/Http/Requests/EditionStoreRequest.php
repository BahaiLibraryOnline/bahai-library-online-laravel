<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditionStoreRequest extends FormRequest
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
            'title' => ['required', 'max:255', 'string'],
            'subtitle' => ['nullable', 'max:255', 'string'],
            'title_parent' => ['nullable', 'max:255', 'string'],
            'volume' => ['nullable', 'max:255', 'string'],
            'page_range' => ['nullable', 'max:255'],
            'page_total' => ['nullable', 'max:255'],
            'publisher_name' => ['nullable', 'max:255', 'string'],
            'publisher_city' => ['nullable', 'max:255', 'string'],
            'date' => ['nullable', 'date', 'date'],
            'isbn' => ['nullable', 'max:255', 'string'],
            'document_id' => ['required', 'exists:documents,id'],
        ];
    }
}
