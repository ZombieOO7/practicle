<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;


class UserFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
        $validator = [
            'email' => ['required'],
            'full_name' => 'required',
            'department' => 'required',
            'joining_date' => 'required',
            'gender' =>'required',
            'phone_number' => 'required',
        ];
        if ($request->has('uuid') && $request->id != null) {
            $validator['email'][] = 'unique:users,email,' . $request->id.',id,deleted_at,NULL';
            $validator['phone'][] = 'unique:users,mobile,' . $request->id.',id,deleted_at,NULL';
        } else {
            $validator['email'][] = 'unique:users,email,NULL,id,deleted_at,NULL';
            $validator['phone'][] = 'unique:users,mobile,NULL,id,deleted_at,NULL';
        }
        return $validator;
    }
}
