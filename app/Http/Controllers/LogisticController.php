<?php

namespace App\Http\Controllers;

use App\Models\Logistic;
use App\Http\Resources\LogisticResource;

use Illuminate\Http\Request;

class LogisticController extends Controller
{
    function index()
    {
        return LogisticResource::collection(Logistic::all());
    }

    function id(int $id)
    {
        return new LogisticResource(Logistic::findOrFail($id));
    }

    function store(Request $request)
    {
        $logistic = new Logistic();
        $logistic->name = $request->name;
        $logistic->description = $request->description;
        $logistic->stock = $request->stock;
        $logistic->ordered = $request->ordered;
        $logistic->inuse = $request->inuse;
        $logistic->used = $request->used;
        $logistic->price = $request->price;
        $logistic->save();
        return new LogisticResource($logistic);
    }

    function update(Request $request, int $id)
    {
        $logistic = Logistic::findOrFail($id);
        $logistic->name = $request->name;
        $logistic->description = $request->description;
        $logistic->stock = $request->stock;
        $logistic->ordered = $request->ordered;
        $logistic->inuse = $request->inuse;
        $logistic->used = $request->used;
        $logistic->price = $request->price;
        $logistic->save();
        return new LogisticResource($logistic);
    }

    function delete(int $id)
    {
        $logistic = Logistic::findOrFail($id);
        $logistic->delete();
        return new LogisticResource($logistic);
    }
        
}
