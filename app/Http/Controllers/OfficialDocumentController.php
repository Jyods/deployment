<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OfficialDocument;

use App\Http\Resources\ODTStatusResource;

use App\Models\User;


class OfficialDocumentController extends Controller
{
    function index(Request $request)
    {
        //get the user from the request
        $user = $request->user();
        //returne alle OfficialDocuments die der User erstellt hat mit der OTDStatusResource und welche die nicht archiviert sind
        return ODTStatusResource::collection(OfficialDocument::where('user_id', $user->id)->where('isarchived', false)->get());

        return ODTStatusResource::collection(OfficialDocument::where('user_id', $user->id)->get());

        return OfficialDocument::where('user_id', $user->id)->get();
    }
    
    function id(int $id)
    {
        return OfficialDocument::find($id);
    }

    function store(Request $request)
    {

        // * JUST EDIT THIS PART * \\
        $current_delay_hours = 22;
      // *************************** \\

        $current_delay_hours = $current_delay_hours * 3600;

        $delay_timezone = 2 * 3600;

        //speichere die derzeitige Zeit in $current_time und addiere 13 Stunden bei $delayed_time beis muss den datentyp datetime haben
        $current_time = date("Y-m-d H:i:s");
        $delayed_time = date("Y-m-d H:i:s", strtotime($current_time) + $current_delay_hours + $delay_timezone);
        $doubled_delayed_time = date("Y-m-d H:i:s", strtotime($current_time) + ($current_delay_hours * 2) + $delay_timezone);
        $trippled__delayed_time = date("Y-m-d H:i:s", strtotime($current_time) + ($current_delay_hours * 2.5) + $delay_timezone);
        // es wird * 
        
        $user = $request->user();
        $user_id = $user->id;

        $officialDocument = new OfficialDocument();
        $officialDocument->name = $request->name;
        $officialDocument->description = $request->description;
        $officialDocument->file = $request->file;
        $officialDocument->file_type = $request->file_type;
        $officialDocument->institution_id = $request->institution_id;
        $officialDocument->usercheckstatus = $delayed_time;
        $officialDocument->processstatus = $doubled_delayed_time;
        $officialDocument->sendupstatus = $trippled__delayed_time;
        $officialDocument->isanswer = $request->isanswer;
        $officialDocument->official_document_id = $request->official_document_id;
        $officialDocument->user_id = $request->user_id != null ? $request->user_id : $user_id;
        $officialDocument->save();
        return $officialDocument;
    }
}
