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
                'id'=>$this->booking->id??null,
                'booking_name'=>$this->booking->booking_name??null,
                'date'=>$this->booking->date??null,


            ],

            // 'expenseCatagory' => [
            //     'id' => $this->expenseCatagory->id,
            //     'name' => $this->expenseCatagory->name,
            // ],
        ];     }
}
