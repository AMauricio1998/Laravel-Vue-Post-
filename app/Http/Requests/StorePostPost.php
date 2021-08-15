<?php

namespace App\Http\Requests;

use App\Rules\Uppercase;
use Illuminate\Foundation\Http\FormRequest;

class StorePostPost extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

     public static function myRules() {  
         // 'title' => 'required|min:5|max:500',
         return [
        'url_clean' => 'max:500|unique:posts',
        'content' => 'required|min:5',
        'category_id' => 'required',
        'posted' => 'required',
        'tags_id' => 'required',
        'title' => [
            'required',
            'min:5',
            'max:500',
            new Uppercase()
        ]
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
        //dd($this->myRules());
        return $this->myRules();
    }
}
