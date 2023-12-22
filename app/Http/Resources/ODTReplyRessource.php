<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use App\Models\OfficialDocument;

class ODTReplyRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //überprüfe anhand der official_document_id ob zu diesem Eintrag bereits eine Antowrt erstellt würde
        $reply = OfficialDocument::where('official_document_id', $this->id)->first();
        $message = "";
        
        if ($reply != null) {
            $message = "There is a reply";
        } else {
            $message = null;
        }
        return [
            'id' => $this->id,
            'title' => $this->name,
            'message' => $message
        ];
    }
}
