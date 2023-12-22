<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\HealthResource;
use App\Models\Health;

class PatientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'Patient',
            'id' => $this->id,
            'identification' => $this->identification,
            'health' => HealthResource::collection(Health::where('patient_id', $this->id)->get()),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
