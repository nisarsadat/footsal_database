<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class profitAndLossControllerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'total_owner_pickups' => $this->resource['total_owner_pickups'],
            'total_expenses' => $this->resource['total_expenses'],
            'total_booking' => $this->resource['total_booking'],
            'total_payments' => $this->resource['total_payments'],
            'profit_or_loss' => $this->resource['profit_or_loss'],
        ];   }
}

