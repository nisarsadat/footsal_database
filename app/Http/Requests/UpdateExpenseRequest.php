<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExpenseRequest extends FormRequest
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
            'expense_catagory_id'=>"required",
            'amount'=>"required",
            'note'=>"string",
            'date'=>"date",
                //
            ];
    }


    protected function prepareForValidation()
    {
        $this->merge([
            'expense_catagory_id' => $this->input('expenseCatagoryId'),
           
        ]);}
}
