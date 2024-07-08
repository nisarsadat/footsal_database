<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return [
        //     'id' => $this->id,
        //     'customer' =>[
        //         'id' => $this->customer->id,
        //         'name' => $this->customer->name,
        //     ],
        //     'hall' =>[
        //         'id' => $this->hall->id,
        //         'name' => $this->hall->name,
        //     ],
        //     'stuffsRent' => $this->stuffs_rent,
        //     'id' => $this->price,
        //     'id' => $this->discount,
        //     'id' => $this->total,
        // ];

// dd($request);

        return [
            'id' => $this->id,
            'customer' => [
                        'id' => $this->customer->id??null,
                        'name' => $this->customer->name??null,
                    ],
            'hall' => [
                        'id' => $this->hall->id??null,
                        'name' => $this->hall->name??null,
                    ],
            'bookingName' => $this->booking_name,
            'from' => $this->from,
            'to' => $this->to,
            'date' => $this->date,
            'price' => $this->price,
            'discount' => $this->discount,
            'stuffsRent' => $this->stuffs_rent,
            'total' => $this->total,
            'payed' => $this->payed,
            'due' => $this->due,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        // 'customer' => new CustomerResource($this->whenLoaded('customer')),
        // 'hall' => new HallResource($this->whenLoaded('hall')),



    }
}
