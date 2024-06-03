<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePaymentRequest extends FormRequest
{

// importent very ok

    // protected function prepareForValidation()
    // {
    //     $this->merge([
    //         'booking_id' => $this->input('bookingId'),
    //     ]);
    // }



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
            'booking_id'=>"",
            'payed'=>"",
            'date'=>"date"

            //
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'booking_id' => $this->input('bookingId'),
            // Add more input mappings as needed
        ]);}


}
