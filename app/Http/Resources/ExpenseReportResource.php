<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'date' =>$this->date??null,
            'note' =>$this->note??null,


            'total_amount' => $this->total_amount??null,
            'expenseCatagoryid' =>$this->expense_catagory_id??null,
            'expenseCatagoryName' =>$this->expense_catagory_name??null,
            'numberOfRecives' =>$this->numberOfRecives??null,
            // 'expense_catagory_id' =>$this->expense_catagory_id??null,

            // Add any other fields that might be present in either data structure
        ];   }
}

// "id": 3,
//         "expense_catagory_id": 3,
//         "amount": 2055,
//         "note": "Et quaerat enim accusantium hic repellendus.",
//         "date": "1979-07-17",
//         "deleted_at": null,
//         "created_at": "2024-07-11T09:56:27.000000Z",
//         "updated_at": "2024-07-11T09:56:27.000000Z",
//         "name": "Holly Collier"
