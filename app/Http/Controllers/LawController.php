<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\LawResource;
use App\Models\Law;

class LawController extends Controller
{
    public function index()
    {
        //return LawResource::collection(Law::all());
        //return all laws and sort first by Severity, then by paragraph(int)
        return LawResource::collection(Law::all()->sortBy('Paragraph')->sortBy('Severity'));
    }
    public function id(int $id)
    {
        return new LawResource(Law::find($id));
    }
}
