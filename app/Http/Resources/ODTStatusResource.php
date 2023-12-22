<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Support\Carbon;

use App\Models\Institution;

class ODTStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $current_time = Carbon::now();

        //addiere 2h auf die Zeit, da die Zeitzone nicht stimmt
        $current_time->addHours(2);

        //setzte current_time auf die aktuelle Zeit mit dem Format yyyy-mm-dd hh:mm:ss
        $current_time = $current_time->format('Y-m-d H:i:s');

        // return [
        //     'current_time' => $current_time,
        //     'usercheckstatus' => $this->usercheckstatus,
        //     'test' => $current_time > $this->usercheckstatus ? 2 : 1,
        //     'userstatus' => $this->usercheckstatus == null ? 0 : ($current_time > $this->userstatus ? 1 : 2),
        // ];


        //überprüfe bei jeder statusmeldung ob das Datum in jedem Status schon vergangen ist, wenn ja dann setze den status auf 1, wenn nicht dann auf 0
        $userstatus = $this->usercheckstatus == null ? 0 : ($current_time > $this->usercheckstatus ? 2 : 1);
        $processstatus = $userstatus != 2 ? 0 : ($this->processstatus == null ? 0 : ($current_time > $this->processstatus ? 2 : 1));
        $sendupstatus = $processstatus != 2 ? 0 : ($this->sendupstatus == null ? 0 : ($current_time > $this->sendupstatus ? 2 : 1));
        $companystatus = $sendupstatus != 2 ? 0 : ($this->waschecked == 0 ? 1 : ($this->companystatus == null ? 1 : ($current_time > $this->companystatus ? 2 : 1)));
        $redirectedstatus = $companystatus != 2 ? 0 : ($this->wasredirected == 0 ? 0 : ($this->redirectedstatus == null ? 1 : ($current_time > $this->redirectedstatus ? 2 : 1)));
        $senddownstatus = $this->wasredirected == 1 ? ($redirectedstatus != 2 ? 0 : ($this->senddownstatus == null ? 1 : ($current_time > $this->senddownstatus ? 2 : 1))) : ($companystatus != 2 ? 0 : ($this->senddownstatus == null ? 1 : ($current_time > $this->senddownstatus ? 2 : 1)));
        $deliverystatus = $senddownstatus != 2 ? 0 : ($this->deliverystatus == null ? 1 : ($current_time > $this->deliverystatus ? 2 : 1));

        $data = [
            'id' => $this->id,
            'title' => $this->name,
            'description' => $this->description,
            'institution' => Institution::find($this->institution_id),
            'isdeleted' => $this->isdeleted,
            'isarchived' => $this->isarchived,
            'isanswer' => $this->isanswer,
            'wasredirected' => $this->wasredirected,
            'shouldReply' => $this->shouldreply,
            'status' => [
                'user' => $userstatus,
                'process' => $processstatus,
                'sendup' => $sendupstatus,
                'company' => $companystatus,
                'redirected' => $redirectedstatus,
                'senddown' => $senddownstatus,
                'delivery' => $deliverystatus,
            ],
            'error' => [
                'missing' => $this->gonemissing,
                'missingReason' => $this->missingcomment,
            ]
            ];
        


        return $data;
    }
}
