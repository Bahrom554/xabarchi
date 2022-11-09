<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest
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
            'title'=>'required|string|max:255',
            'subtitle'=>'required|string|max:500',
            'slug'=>'nullable|string|unique:posts',
            'body'=>'required|string',
            'category_id'=>'required',
            'tags'=>'required'
        ];
    }
}
