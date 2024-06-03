<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GymnasiumResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'path' => $this->path ? asset('/storage' . $this->path) : null,
            'name' => $this->name ? $this->name  :  null,
            'note' => $this->note ? $this->note  :  null,
        ];
    }
}
