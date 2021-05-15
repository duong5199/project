<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        return [
            'name'  => ['required'],
            'email'  => ['required'],
            'phone'  => ['required'],
            'dob'  => ['required'],
            'address' => ['required'],
            'position_id' => ['required'],
            'department_id' => ['required'],
            'status' => ['required'],
            'salary' => ['required'],
            'allowance' => ['required'],
            'academic_level' => ['required'],
            'home_town' => ['required'],
            'cmnd' => ['required'],
            'time_start' => ['required'],
        ];
    }
}
