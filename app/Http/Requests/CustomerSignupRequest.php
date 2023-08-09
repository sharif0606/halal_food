<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerSignupRequest extends FormRequest
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
        return [
            'customer_name'=>'required|max:255',
            'mobile'=>'required|unique:db_customers,mobile,except,id',
            // 'address'=>'required',
            // 'email'=>'required',
            'password'=>'required|min:3',
        ];
    }
}
