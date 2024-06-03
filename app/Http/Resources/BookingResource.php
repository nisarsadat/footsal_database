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
                        'id' => $this->customer->id,
                        'name' => $this->customer->name,
                    ],
            'hall' => [
                        'id' => $this->hall->id,
                        'name' => $this->hall->name,
                    ],
            'from' => $this->from,
            'to' => $this->to,
            'date' => $this->date,
            'price' => $this->price,
            'discount' => $this->discount,
            'stuffs_rent' => $this->stuffs_rent,
            'total' => $this->total,
            'grandTotal' => $this->grand_total,
            'due' => $this->due,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];

        // 'customer' => new CustomerResource($this->whenLoaded('customer')),
        // 'hall' => new HallResource($this->whenLoaded('hall')),



    }
}
