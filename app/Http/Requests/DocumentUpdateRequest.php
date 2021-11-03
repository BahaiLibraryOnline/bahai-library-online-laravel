<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DocumentUpdateRequest extends FormRequest
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
            'slug' => ['required', 'max:255', 'string'],
            'is_pdf' => ['nullable', 'boolean', 'boolean'],
            'is_audio' => ['nullable', 'boolean', 'boolean'],
            'is_image' => ['nullable', 'boolean', 'boolean'],
            'is_video' => ['nullable', 'boolean', 'boolean'],
            'is_html' => ['nullable', 'boolean', 'boolean'],
            'file_url' => ['nullable', 'max:255', 'string'],
            'blurb' => ['nullable', 'max:255', 'string'],
            'content_html' => ['nullable', 'max:255', 'string'],
            'content_size' => ['nullable', 'integer', 'min:0'],
            'edit_quality' => ['nullable', 'in:high,medium,low'],
            'formatting_quality' => ['nullable', 'in:high,medium,low'],
            'publication_permission' => [
                'required',
                'in:author,editor,publisher,translator,recipient,fair use,unknown',
            ],
            'notes' => ['nullable', 'max:255', 'string'],
            'input_type' => ['required', 'in:scanned,typed,transcribed'],
            'publication_approval' => [
                'required',
                'in:approved,rejected,pending',
            ],
            'views' => ['required', 'max:255'],
        ];
    }
}
