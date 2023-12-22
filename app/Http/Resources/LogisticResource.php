<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LogisticResource extends JsonResource
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
            'name' => $this->name,
            'description'=> $this->description,
            'stock' => $this->stock,
            'ordered' => $this->ordered,
            'inuse' => $this->inuse,
            'used' => $this->used,
            'price' => $this->price,
        ];
    }
}
