<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\FileLawResource;
use App\Models\FileLaw;
use App\Models\Law;

class FileLawController extends Controller
{
    public function index(Request $request)
    {
        return FileLawResource::collection(FileLaw::all());
    }
    // create a function that returns all filelaws with the given file_id
    public function id(int $id)
    {
        return FileLawResource::collection(FileLaw::where('file_id', $id)->get());
    }
    public function store(Request $request)
    {
        $filelaw = new FileLaw();
        $filelaw->file_id = $request->file_id;
        $law = Law::where('Paragraph', $request->paragraph)->first();
        //return $law;
        $filelaw->law_id = $law->id;
        $filelaw->save();
        return new FileLawResource($filelaw);
    }
}
