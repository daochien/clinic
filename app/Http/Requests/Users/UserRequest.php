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
            'name' => 'required|string|max:191',
            'email' => 'required|string|email|max:191|unique:users',
            'type_id' => 'required',
            'group_ids' => 'nullable',
            'level_id' => 'nullable',
            'clinic_ids' => 'nullable',
            'description' => 'nullable',
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
            'name' => 'sometimes|string|max:191',
            'email' => 'sometimes|string|email|max:191|unique:users,email,' . $this->get('id'),
            'type_id' => 'required',
            'group_id' => 'nullable',
            'level_id' => 'nullable',
            'clinic_id' => 'nullable',
            'description' => 'nullable',
        ];
    }
}
