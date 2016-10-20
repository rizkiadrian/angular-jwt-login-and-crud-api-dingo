<?php

namespace App\Http\Controllers\Mahasiswa;

use Illuminate\Http\Request;
use App\Mahasiswa\Mahasiswa;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
   { 

        $input = $request->all();
        if($request->get('search')){
        $mahasiswas = Mahasiswa::where("Nama", "LIKE", "%{$request->get('search')}%")
        ->paginate(5); 
        return response()->json($mahasiswas);     
        }else{
        $mahasiswas = Mahasiswa::latest()->paginate(5);
        return response()->json($mahasiswas);
        
    }
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
        $mahasiswa = new Mahasiswa();
        $mahasiswa->NRP = $request->input('NRP');
        $mahasiswa->Nama = $request->input('Nama');
        $mahasiswa->email = $request->input('email');
        $mahasiswa->save();
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        return response()->json($mahasiswa);
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
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->NRP = $request->input('NRP'); 
        $mahasiswa->Nama = $request->input('Nama'); 
        $mahasiswa->email = $request->input('email');
        $mahasiswa->save();
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $mahasiswa = Mahasiswa::find($id);
        $mahasiswa->delete();
        
    }
}
