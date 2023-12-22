<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Controllers\LoginController;

use App\Http\Resources\LawResource;
use App\Http\Resources\FileLawResource;
use App\Http\Resources\UserResource; 
use App\Models\FileLaw;
use App\Models\Rank;
use App\Models\User;

class PublishResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'Eintrag',
            'id' => $this->id,
            'fileID' => $this->fileID,
            'definition' => $this->definition,
            'description' => $this->description,
            'date' => $this->date,
            'fine' => $this->fine,
            'isRestricted' => $this->isRestricted,
            'restrictionClass' => $this->restrictionClass,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'user' => new UserResource($this->user),
            'laws' => FileLawResource::collection(FileLaw::where('file_id', $this->fileID)->get()),
            'rank' => RankResource::collection(Rank::where('id', $this->rank_id)->get()),
            'publisher' => UserResource::collection(User::where('id', $this->publisher_id)->get()),
            'route' => $this->route,
        ];
    }
}
