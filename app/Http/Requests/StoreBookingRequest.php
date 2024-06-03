<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [


            'customer_id'=>"required|integer",
            'hall_id'=>"required|integer",
            'price'=>"required|integer",
            'from'=>"required",
            'to'=>"",
            'date'=>"required|date",
            'discount'=>"numeric",
            'stuffs_rent'=>"numeric",
            // 'due'=>"numeric",
            // 'grand_total'=>"numeric",
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
            'grand_total' => $this->input('grandTotal'),
        ]);}
}
