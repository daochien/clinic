<?php

namespace App\Http\Requests\Users;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
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

    /**
     * Define validation rules to store method for resource creation
     *
     * @return array
     */
    public function createRules(): array
    {
        $rules =  [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
//            'groups' => 'required',
            'clinics' => 'required',
            'role' => 'required',
//            'level_id' => 'nullable',
            'description' => 'nullable|max:500',
        ];

        if ($this->role['id'] == 4 )
        {
            $rules['type_id'] = 'required';
        }

        return $rules;
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        $rules =  [
            'name' => 'sometimes|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->get('id'),
//            'groups' => 'required',
            'clinics' => 'required',
            'role' => 'required',
//            'level_id' => 'nullable',
            'description' => 'nullable|max:500',
        ];

        if ($this->role['id'] == 4 )
        {
            $rules['type_id'] = 'required';
        }

        return $rules;
    }

    public function attributes()
    {
        return [
            'name' => 'ユーザー名 ',
            'email' => 'メールアドレス',
            'type_id' => '職業',
            'clinics' => 'クリニック',
            'role' => 'ユーザータイプ',
            'description' => 'メモ',
        ];
    }
}
