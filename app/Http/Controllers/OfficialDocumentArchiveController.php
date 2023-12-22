<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\OfficialDocument;

use App\Http\Resources\OfficialDocumentArchiveResource;

class OfficialDocumentArchiveController extends Controller
{
    function index()
    {
        return OfficialDocumentArchiveResource::collection(OfficialDocument::all());
    }
}
