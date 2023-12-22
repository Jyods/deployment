<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Entry;
use App\Http\Resources\EntryResource;
use App\Http\Resources\OnlyEntryResource;

use App\Events\FireMinorMessage;

class EntryController extends Controller
{
    public function index(Request $request)
    {
        /*get the user from the request
        $user = $request->user();
        $class = $user->restrictionClass;
        get all entries and files where the restrictionClass is lower or equal to the user restrictionClass
        $entries = Entry::whereHas('files', function ($query) use ($class) {
            $query->where('restrictionClass', '<=', $class);
        })->get();
        return EntryResource::collection($entries);*/
        return EntryResource::collection(Entry::all());
    }

    public function id(int $id)
    {
        $entry = Entry::find($id);
        return new EntryResource(Entry::find($id));
    }
    public function store(Request $request)
    {
        $entry = new Entry();
        $entry->identification = $request->identification;
        $entry->save();
        return new EntryResource($entry);
    }
    public function onlyEntry() {
        return OnlyEntryResource::collection(Entry::all());
    }
    public function changeWanted(int $id) {
        $entry = Entry::find($id);
        $entry->isWanted = !$entry->isWanted;
        $entry->save();
        event(new FireMinorMessage($entry->isWanted ? 'Eintrag ' . $id . ' wurde zur Fahndung hinzugefügt' : 'Eintrag ' . $id . ' wurde von der Fahndung entfernt'));
        return new EntryResource($entry);
    }
}
