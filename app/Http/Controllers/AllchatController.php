<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Allchat;

use App\Http\Resources\AllchatResource;

use App\Models\User;

use App\Events\FireAllchatMessage;

class AllchatController extends Controller
{
    function index()
    {   
        //letzten 10 Nachrichten
        return AllchatResource::collection(Allchat::orderBy('id', 'desc')->take(10)->get());
    }
    function range(int $id)
    {
        //nimm die letzten 10 Nachrichten von der angegebenen id
        return AllchatResource::collection(Allchat::where('id', '<', $id)->orderBy('id', 'desc')->take(10)->get());
    }
    function store(Request $request)
    {
        $user = $request->user();

        $allchat = new Allchat();
        $allchat->user_id = $user->id;
        $allchat->message = $request->message;
        $allchat->save();

        event(new FireAllchatMessage(new AllchatResource($allchat)));

        return new AllchatResource($allchat);
    }
}
