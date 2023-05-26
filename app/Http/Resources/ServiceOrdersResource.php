<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceOrdersResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'userName' => $this->user->name,
            'vehiclePlate' => $this->vehiclePlate,
            'entryDateTime' => $this->entryDateTime,
            'exitDateTime' => $this->exitDateTime,
            'priceType' => $this->priceType,
            'price' => $this->price,
        ];
    }
}
