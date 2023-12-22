<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Http\Resources\UserResource;
use App\Models\User;

use App\Http\Resources\RankResource;
use App\Models\Rank;

class AllchatResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //nimm die id des users und such den user mit der id
        $user = User::where('id', $this->user_id)->get()->first();

        return [
            'id' => $this->id,
            'message' => $this->message,
            'author' => [
                'name' => $user->name,
                'id' => $user->id,
                'rank' => RankResource::collection(Rank::where('id', $user->rank_id)->get())->first(),
            ],
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
