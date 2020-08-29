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
        return [
            'name' => 'required|string|max:50',
            'email' => 'required|string|email|max:255|unique:users',
            'type_id' => 'required',
//            'groups' => 'required',
            'clinics' => 'required',
            'role' => 'required',
//            'level_id' => 'nullable',
            'description' => 'nullable|max:500',
        ];
    }

    /**
     * Define validation rules to update method for resource update
     *
     * @return array
     */
    public function updateRules(): array
    {
        return [
            'name' => 'sometimes|string|max:50',
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->get('id'),
            'type_id' => 'required',
//            'groups' => 'required',
            'clinics' => 'required',
            'role' => 'required',
//            'level_id' => 'nullable',
            'description' => 'nullable|max:500',
        ];
    }
}
