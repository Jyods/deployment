<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


use App\Http\Resources\FileResource;
use App\Http\Controllers\LoginController;

use App\Http\Resources\PublishResource;
use App\Models\Publish;

class EntryResource extends JsonResource
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
            'type' => 'Straftaeter',
            'identification' => $this->identification,
            'isWanted' => $this->isWanted ? true : false,
            //add files that belongs to the entry, when the user restrictionClass is lower or equal to the file restrictionClass show the text, else show "Restricted"
            'files' => $this->files->map(function ($file) {
                $class = LoginController::getUser();
                $class = $class->restrictionClass;
                if ($file->restrictionClass <= $class) {
                    return new FileResource($file);
                } else {
                    return [
                        'type' => 'Eintrag',
                        'id' => $file->id,
                        'definition' => 'Restricted',
                        'description' => 'Restricted',
                        'date' => 'Restricted',
                        'fine' => 'Restricted',
                        'isRestricted' => true,
                        'restrictionClass' => $file->restrictionClass,
                        'created_at' => 'Restricted',
                        'updated_at' => 'Restricted',
                        'user' => 'Restricted',
                        'publishes' => PublishResource::collection(Publish::where('fileID', $file->id)->get()),
                    ];
                }
            }),
        ];
    }
}
