<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Institution;

use App\Http\Resources\InstitutionResource;

class InstitutionController extends Controller
{
    function index()
    {
        return InstitutionResource::collection(Institution::all());
    }
}
