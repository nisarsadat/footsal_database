<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookingRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [


            'customer_id'=>"required|integer",
            'hall_id'=>"required|integer",
            'price'=>"required|integer",
            'from'=>"required",
            'to'=>"required",
            'date'=>"required|date",
            'discount'=>"numeric",
            'stuffs_rent'=>"numeric",
            'grand_total'=>"numeric",
            'due'=>"numeric",
            'total'=>"numeric",
            //
        ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'customer_id' => $this->input('customerId'),
            'hall_id' => $this->input('hallId'),
            'stuffs_rent' => $this->input('stuffsRent'),
        ]);}
}
