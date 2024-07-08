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
            'booking_name'=>"string",
            'from'=>"required",
            'to'=>"",
            'date'=>"required|date",
            'discount'=>"numeric",
            'stuffs_rent'=>"numeric",
            // 'due'=>"numeric",
            'payed'=>"numeric",
            // 'total'=>"numeric",
            //
        ];
    }



    protected function prepareForValidation()
    {
        $this->merge([
            'customer_id' => $this->input('customerId'),
            'hall_id' => $this->input('hallId'),
            'booking_name' => $this->input('bookingName'),
            'stuffs_rent' => $this->input('stuffsRent'),
            'payed' => $this->input('payed'),
        ]);}
}
