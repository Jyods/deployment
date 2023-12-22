<?php

namespace App\Http\Controllers;

use App\Models\ProdiaLink;
use Illuminate\Http\Request;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class ProdiaLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     */
    public function show(ProdiaLink $prodiaLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProdiaLink $prodiaLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProdiaLink $prodiaLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProdiaLink $prodiaLink)
    {
        //
    }

    public function generate(Request $request)
    {
        $client = new Client();

        try {
            $response = $client->request('POST', 'https://api.prodia.com/v1/job', [
                'body' => $request->getContent(),
                'headers' => [
                    'X-Prodia-Key' => '022ee431-4073-424c-8298-68cb75352785',
                    'accept' => 'application/json',
                    'content-type' => 'application/json',
                ],
            ]);

           //gib die response als json zurück
            $body = json_decode($response->getBody());

            $request = json_decode($request->getContent());

            //Erstelle einen neuen Datenbankeintrag
            $prodiaLink = new ProdiaLink();
            $prodiaLink->jobId = $body->job;
            $prodiaLink->prompt = $request->prompt;
            $prodiaLink->model = $request->model;
            $prodiaLink->steps = $request->steps;
            $prodiaLink->cfgScale = $request->cfg_scale;
            $prodiaLink->seed = $request->seed;
            $prodiaLink->upscale = $request->upscale;
            $prodiaLink->sampler = $request->sampler;
            $prodiaLink->aspectRatio = $request->aspect_ratio;
            $prodiaLink->negativePrompt = $request->negative_prompt;
            $prodiaLink->save();

            return $body; 
        } catch (RequestException $e) {
            return $e->getResponse()->getBody();
        }
        return response()->json(['message' => 'Passed'], 200);
    }

    public function job(Request $request)
    {
        $client = new Client();
        $route = 'https://api.prodia.com/v1/job/' . $request->getContent();
        try {
            $response = $client->request('GET', $route, [
            'headers' => [
                'X-Prodia-Key' => '022ee431-4073-424c-8298-68cb75352785',
                'accept' => 'application/json',
            ],
            ]);

        }
        catch (RequestException $e) {
            return $e->getResponse()->getBody();
        }
        return $response->getBody();
    }
}
