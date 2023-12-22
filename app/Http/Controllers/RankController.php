<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RankResource;
use App\Models\Rank;

class RankController extends Controller
{
    public function index()
    {
        $rank = Rank::all();
        return RankResource::collection($rank);
    }
}
