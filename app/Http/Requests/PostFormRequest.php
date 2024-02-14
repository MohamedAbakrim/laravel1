<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PostFormRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            "title"=> ["required", "min:8"],
            "content" => ["required"],
            "slug" => ["required", Rule::unique('posts')->ignore($this->route()->parameter('post'))]
        ];
    }


    protected function prepareForValidation(){
        $slug = $this->input("title") . "1";
        $this->merge([
            "slug" => $this->input('slug') ?: $slug
        ]);
    }
}
