<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OfficialDocument;

use App\Http\Resources\ODTStatusResource;

use App\Http\Resources\ODTReplyRessource;

class OfficialDocumentReplyController extends Controller
{
    function index(Request $request)
    {
        $current_date = date("Y-m-d H:i:s");

        $set_timezone = 2 * 3600;

        $current_date = date("Y-m-d H:i:s", strtotime($current_date) + $set_timezone);

        //get the user from the request
        $user = $request->user();
        //returne alle OfficialDocuments die der User erstellt hat mit der OTDStatusResource und welche die nicht archiviert sind
        return ODTReplyRessource::collection(OfficialDocument::where('user_id', $user->id)->where('isarchived', false)->where('shouldreply', true)->where('deliverystatus', '<',$current_date)->get());
    }
}
