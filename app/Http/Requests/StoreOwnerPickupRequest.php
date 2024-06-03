<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOwnerPickupRequest extends FormRequest
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

            'owner_id'=>"",
            'amount'=>"",
            'note'=>"",
            'date'=>"",
            //
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'owner_id' => $this->input('ownerId'),
           
        ]);}
}
