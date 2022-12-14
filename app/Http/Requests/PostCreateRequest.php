<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class PostCreateRequest extends FormRequest
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
            'title'   => 'required',
            'content' => 'required'
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
