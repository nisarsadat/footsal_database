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
                'id' => $this->expenseCatagory->id??null,
                'name' => $this->expenseCatagory->name??null,
<<<<<<< HEAD
            ],
        ];
    }
=======
            ],        ];    }
>>>>>>> 2ad567d3c53fd07d14bf18c8a031b776b3b859dd
}
