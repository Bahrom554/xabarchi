<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostEditRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'=>'string|max:255',
            'subtitle'=>'string|max:500',
            'slug'=>'nullable|unique:posts,slug,'.$this->post->id,
            'body'=>'string',
        ];
    }
}
