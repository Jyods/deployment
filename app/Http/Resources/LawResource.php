<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LawResource extends JsonResource
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
            'Paragraph' => $this->Paragraph,
            'Title' => $this->Title,
            'Category' => $this->Category,
            'Severity' => $this->Severity,
            'ShortDescription' => $this->ShortDescription,
            'Description' => $this->Description,
            'minJail' => $this->minJail,
            'maxJail' => $this->maxJail,
        ];
    }
}
