<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ExpenseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'amount' => $this->amount,
            'note' => $this->note,
            'date' => $this->date,
            'expenseCatagory' => [
                'id' => $this->expenseCatagory->id,
                'name' => $this->expenseCatagory->name,
            ],
        ];
    }
}
