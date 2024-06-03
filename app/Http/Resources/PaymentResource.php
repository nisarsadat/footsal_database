<?php

namespace App\Http\Resources;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        // dd($request);
        return [
            'id' => $this->id,
            'payed' => $this->payed,
            'date' => $this->date,
            'booking' => [
                'id'=>$this->booking->id,
                'name'=>$this->booking->price,
                'date'=>$this->booking->date,


            ],

            // 'expenseCatagory' => [
            //     'id' => $this->expenseCatagory->id,
            //     'name' => $this->expenseCatagory->name,
            // ],
        ];     }
}
