<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreQueueRequest extends FormRequest
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
            'service_id' => 'required|exists:services,id',
            'customer_type_id' => 'required|exists:customer_types,id',
            'customer_type_name' => 'required|exists:customer_types,name',
            'customer_title' => ['nullable' , 'required_if:customer_type_name,Citizen', Rule::in(['Mr.', 'Miss', 'Mrs.', 'Ms.'])],
            'customer_first_name' => 'nullable|required_if:customer_type_name,Citizen|max:100',
            'customer_last_name' => 'nullable|required_if:customer_type_name,Citizen|max:100',
            'customer_organisation_name' => 'nullable|required_if:customer_type_name,Organisation|max:200',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'service_id.required' => 'Please select a service',
            'customer_type_id.required' => 'Please select the type of the customer',
        ];
    }

}
