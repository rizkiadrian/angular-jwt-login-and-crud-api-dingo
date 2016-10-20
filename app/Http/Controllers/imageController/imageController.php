<?php

namespace App\Http\Controllers\imageController;

use Illuminate\Http\Request;
use App\image\image;
use Imager;
use File;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class imageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $details = image::all();
        return response()->json($details);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $detail = new image();
        $detail->image_description = $request->input('image_description');
        $detail->author = $request->input('author');
        $detail->image_extension = $request->file('image')->getClientOriginalExtension();
        $destinationFolder = public_path().'/uploadimage';
        $destinationThumbnail = public_path().'/uploadimage/thumbnails';
        $detail->image_path = $destinationFolder;
        $detail->save();
        $file = $request->file('image');
        $imageId = $detail->id;
        $extension = $request->file('image')->getClientOriginalExtension();
        $image = Imager::make($file->getRealPath());
        //save image with thumbnail
        $image->save(public_path().'/uploadimage/'. $imageId . '.' . $extension)->resize(200, 300)->save(public_path().'/uploadimage/thumbnails/'. 'thumb-' . $imageId . '.' . $extension);
        return response()->json($detail);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $detail = image::findOrFail($id);
        return response()->json($detail);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       $detail = image::findOrFail($id);
       $detail->author = $request->input('author');
       $detail->image_description = $request->input('image_description');
       $detail->save();
       return response()->json($detail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $detail  = image::find($id);
        $thumbPath = $detail->image_path.'\thumbnails';
        File::delete(public_path('/uploadimage/').
        $detail->id . '.' .
        $detail->image_extension);
        File::delete(public_path('/uploadimage/thumbnails/'.'thumb-').
        $detail->id . '.' .
        $detail->image_extension);
        $detail->delete();
        return response()->json('deleted');
    }
}
