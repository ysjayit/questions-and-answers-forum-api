<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRegisterRequest extends FormRequest
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
            'email' => request()->route('user') 
            ? 'required|email|max:255|unique:users,email,' . request()->route('user')
            : 'required|email|max:255|unique:users,email',
            'password' => request()->route('user') ? 'nullable' : 'required|max:50'
        ];
    }

    protected function failedValidation(Validator $validator) {

        $response = [
            'success' => false,
            'message' => $validator->errors(),
        ];

        throw new HttpResponseException(response()->json($response, 422));
    }


}
