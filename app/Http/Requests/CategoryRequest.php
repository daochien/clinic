<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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

    public function createRules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:categories',
            'type' => 'required',            
            'description' => 'max:500',
        ];
    }

    public function updateRules(): array
    {
        return [
            'name' => 'required|string|max:50|unique:categories,name,' . $this->get('id'),
            'type' => 'required',
            'description' => 'max:500',
        ];
    }

    public function messages()
    {
        return [
            'name.unique' => '指定の名前は既に使用されています',            
        ];
    }
}
