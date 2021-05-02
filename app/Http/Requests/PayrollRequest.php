<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PayrollRequest extends FormRequest
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
        $rules = [];

//        switch ($this->method()) {
//            case 'PUT':
//                $rules = [
//                    'name' => ['required', 'string', 'max:255'],
//                ];
//                break;
//            case 'POST':
//                $rules = [
//                    'name' => ['required', 'string', 'max:255'],
//                ];
//                break;
//        }

        return $rules;
    }
}
