<?php

namespace App\Http\Controllers;

use App\Models\Patient;

use App\Http\Resources\PatientResource;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    function index()
    {
        return PatientResource::collection(Patient::all());
    }

    function id(int $id)
    {
        return new PatientResource(Patient::findOrFail($id));
    }
}
