<?php

namespace App\Http\Requests\Pages;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Contracts\Validation\Validator;

class PageRequest extends FormRequest
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
            'title' => 'required|string|max:100',
            'type' => 'required',
            'category_id' => 'required'                        
        ];
    }

    public function updateRules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'type' => 'required',
            'category_id' => 'required' 
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = $validator->errors()->first();

        throw new HttpResponseException(response()->json(
        [
            'errors' => $validator->errors(),
            'message' => $error,
            'status' => false,
            'code' => '01'
        ], 200));
    }
}
