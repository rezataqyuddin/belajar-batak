<?php

namespace App\Http\Controllers;

use App\Models\BatakChars;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

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
        dd($request);
        
        $folderPath = "img-upload/";
        $image_parts = explode(";base64,", $request['signed']);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
        $file = $folderPath . uniqid() . '.' . $image_type;
        file_put_contents($file, $image_base64);
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
