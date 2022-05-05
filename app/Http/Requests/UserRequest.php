<?php

namespace App\Http\Requests;

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
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'name' => 'required|max:250',
            'email' => 'required|email|unique:users,email,'.request()->id ?: null,
            //'password' => 'required|min:6|max:30|confirmed',
            'photo' => 'sometimes|nullable|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'role' => 'required'
        ];

        /*if(isset(request()->id)){
            $rules['password'] = 'sometimes|nullable|min:6|max:30|confirmed';
        }*/

        return $rules;
    }
}
