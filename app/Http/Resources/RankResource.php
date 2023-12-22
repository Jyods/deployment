<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\SecurityLevelResource;

use App\Models\SecurityLevel;

class RankResource extends JsonResource
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
            'rank' => $this->rank,
            'unit' => $this->unit,
            'kader' => $this->kader,
            'abbreviation' => $this->abbreviation,
            'level' => $this->level,
            'securityLevel' => new SecurityLevelResource(SecurityLevel::find($this->security_level_id)),
        ];
    }
}
