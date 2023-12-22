<?php

namespace App\Http\Controllers;

use App\Models\Publish;
use Illuminate\Http\Request;

use App\Http\Resources\PublishResource;

use App\Events\StatusRequest;

class PublishController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //get all publishes with the publish Resource
        $publishes = PublishResource::collection(Publish::all());

        return response()->json([
            'message' => $publishes,
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request, int $id)
    {
        $user = $request->user();
        if ($user->restrictionClass < 10) {
            return response()->json([
                'message' => 'You are not allowed to publish',
            ], 403);
        }
        //get the file from the request fileid with the file Resource
        $file = \App\Models\File::find($id);

        //erstelle eine UID
        $uid = uniqid();

        //kopiere die Daten aus dem File in ein Publish
        $publish = new Publish();
        $publish->fileID = $file->id;
        $publish->entry_id = $file->entry_id;
        $publish->user_id = $file->user_id;
        $publish->definition = $file->definition;
        $publish->date = $file->date;
        $publish->description = $file->description;
        $publish->fine = $file->fine;
        $publish->isRestricted = $file->isRestricted;
        $publish->restrictionClass = $file->restrictionClass;
        $publish->rank_id = $file->rank_id;
        $publish->route = $uid;
        $publish->publisher_id = $user->id;
        $publish->save();


        //sende eine Broadcast Nachricht an den Channel test-channel
        broadcast(new StatusRequest('The User: ' . $user->identification . ' created a new public entry.'))->toOthers();

        return response()->json([
            'message' => 'You are allowed to publish',
            'route' => $uid,
            'file' => $file,
            'publish' => $publish,
        ], 200);

    }

    public function id(Request $request, string $route)
    {
        //get the first publish from the request route with the publish Resource
        $publish = PublishResource::collection(Publish::where('route', $route)->get())->first();
        

        if ($publish == null) {
            return response()->json([
                'message' => 'Publish not found',
            ], 404);
        }

        return response()->json([
            'message' => $publish,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Publish $publish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Publish $publish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Publish $publish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, string $id)
    {
        //check if the user is allowed to delete
        $user = $request->user();
        if ($user->restrictionClass < 10) {
            return response()->json([
                'message' => 'You are not allowed to delete',
            ], 403);
        }
        //get the publish from the request id
        $publish = Publish::find($id);
        if ($publish == null) {
            return response()->json([
                'message' => 'Publish not found',
            ], 404);
        }

        //delete the publish
        $publish->delete();

        return response()->json([
            'message' => 'Publish deleted',
        ], 200);
    
    }
}
