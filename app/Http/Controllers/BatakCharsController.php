<?php

namespace App\Http\Controllers;

use App\Models\BatakChars;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpParser\Node\Stmt\TryCatch;

class BatakCharsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        $guide = new Collection();
        $data = BatakChars::get();

        if (isset($_GET["huruf"])) {
            $guide = $data->first(function ($item) {
                return $item->class == $_GET["huruf"];
            });
        }
        return view('intro', compact('data', 'guide'));
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
        $file = $this->store_image($request['signed']);
        return $this->predict($request['signed']);
    }

    public function predict($imagestr)
    {
        $url = "localhost:8001/predict/image";
        $client = new Client();

        $body = '{ "image_base64" : "'.$imagestr.'" }';
        $response = $client->post($url,
        [
            'headers' => [
                'Content-Type' => "application/json",
                'Accept' => 'application/json'
            ],
            'body' => $body,
        ]);

        return $response->getBody()->getContents();
    }

    public function store_image($imagedata)
    {
        $folderPath = "img-uploads/";
        $image_parts = explode(";base64,", $imagedata);
        $image_base64 = base64_decode($image_parts[1]);
        $filename = uniqid() . '.' . "jpg";
        $file = $folderPath . $filename;

        if (!Storage::exists($folderPath)) {
            Storage::makeDirectory($folderPath);
        }

        file_put_contents($file, $image_base64);

        return array($file, $filename);
    }

    /**
     * Display the specified resource.
     */
    public function show(BatakChars $batakChars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BatakChars $batakChars)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BatakChars $batakChars)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BatakChars $batakChars)
    {
        //
    }
}
