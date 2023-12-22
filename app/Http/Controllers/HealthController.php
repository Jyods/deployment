<?php

namespace App\Http\Controllers;

use App\Models\Health;

use App\Http\Resources\HealthResource;

use Illuminate\Http\Request;

class HealthController extends Controller
{
    function index()
    {
        return HealthResource::collection(Health::all());
    }

    function id(int $id)
    {
        return new HealthResource(Health::findOrFail($id));
    }

    function store(Request $request)
    {
        $health = new Health();
        $health->patient_id = $request->patient_id;
        $health->date = $request->date;
        $health->temperature = $request->temperature;
        $health->blood_pressure = $request->blood_pressure;
        $health->heart_rate = $request->heart_rate;
        $health->respiratory_rate = $request->respiratory_rate;
        $health->save();
        return new HealthResource($health);
    }

    function update(Request $request, int $id)
    {
        $health = Health::findOrFail($id);
        $health->patient_id = $request->patient_id;
        $health->date = $request->date;
        $health->temperature = $request->temperature;
        $health->blood_pressure = $request->blood_pressure;
        $health->heart_rate = $request->heart_rate;
        $health->respiratory_rate = $request->respiratory_rate;
        $health->save();
        return new HealthResource($health);
    }
}
