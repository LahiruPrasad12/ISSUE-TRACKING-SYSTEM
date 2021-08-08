<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImageRequest extends FormRequest
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
            'imagable_type' => 'required',
            'imagable_id' => 'required',
            'size' => 'required',
            'path' => 'required',
            'name' => 'required',
            'extension' => 'required',
            'issue_id' => 'required',
            'comment_id' => 'required'
        ];
    }
}
