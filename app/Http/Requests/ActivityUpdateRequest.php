<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ActivityUpdateRequest extends FormRequest
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
            'document_id' => ['required', 'exists:documents,id'],
            'user_id' => ['required', 'exists:users,id'],
            'activity_type' => [
                'required',
                'in:created,proofread,formatted,published,depublished',
            ],
            'comment' => ['required', 'max:255', 'string'],
        ];
    }
}
