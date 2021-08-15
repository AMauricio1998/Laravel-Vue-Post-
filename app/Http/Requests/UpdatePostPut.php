<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostPut extends FormRequest
{
    // public function messages(){
    //     return[
    //         'title.required' => __("messages.titlePost")
    //     ];
    // }

    public function attributes(){
        return[
            'title' => "Titulo de mi post"
        ];
    }


   
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
            'title' => 'required|min:5|max:500',
            'url_clean' => 'max:500|unique:posts,url_clean,'.$this->route('post')->id,
            'content' => 'required|min:5',
            'category_id' => 'required',
            'posted' => 'required',
            'tags_id' => 'required',
        ];
    }
}
