<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMemberRequest extends FormRequest
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
           'name' => 'required',
           'telephone' => 'required|numeric|regex:/^0[1-9]{1}[0-9]{8}$/',
           'address' => 'required',
           'email' => 'required|email',
           'whatsapp_number' => 'required|numeric|regex:/^0[1-9]{1}[0-9]{8}$/', 
        ];
    }
}
