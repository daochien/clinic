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
        $rules = [
            'title' => 'required|string|max:100',
            'type' => 'required',
            'public' => 'required|boolean',
            'status' => 'required|boolean',
            'summary' => 'max:500'
        ];

        if ($this->type != 'manual') {
            $rules['category_id'] = 'required';
        }

        if (!empty($this->files)) {
            $rules['files.*'] = 'mimes:jpeg,png,jpg,pdf,gif,webm,mp4,mpeg|max:204800';
        }

        if (!empty($this->image)) {
            $rules['image'] = 'image|mimes:jpeg,png,jpg,gif,svg|max:2048';
        }

        return $rules;
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
