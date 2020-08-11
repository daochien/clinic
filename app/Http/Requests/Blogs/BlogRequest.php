<?php

namespace App\Http\Requests\Blogs;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        if ($this->isMethod('post')) {
            return $this->createRules();
        } elseif ($this->isMethod('put')) {
            return $this->updateRules();
        }
    }

    public function createRules()
    {
        return [
            'category_ids' => 'required',
            'title' => 'required|string|max:100',
            'draft' => 'required|integer',
            'content' => 'required|string|max:1000',
            'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000',            
        ];
    }

    public function updateRules()
    {
        return [
            'category_ids' => 'required',
            'title' => 'required|string|max:100',
            'draft' => 'required|integer',
            'content' => 'required|string|max:1000',
            'image' => 'mimes:jpeg,jpg,png,gif|max:10000',            
        ];
    }
}
