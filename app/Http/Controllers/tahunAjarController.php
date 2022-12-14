<?php

namespace App\Http\Controllers;

use App\Models\Kampus;
use App\Models\Tahun_ajar;
use Illuminate\Http\Request;

class tahunAjarController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kampus = Kampus::select('id', 'nama_kampus')->get();
        $tahun_ajar = Tahun_ajar::all();
        return view('tahun_ajar.index', [
            'tahun_ajar' => $tahun_ajar,
            'kampuses' => $kampus
        ]);
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
        $tahun_ajar = new Tahun_ajar;
        $tahun_ajar->id_kampus = $request->id_kampus;
        $tahun_ajar->tahun_ajar = $request->tahun_ajar;
        $tahun_ajar->status = $request->status;
        $tahun_ajar->save();

        return redirect()->route('masterKampus.tahunajar.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('tahun_ajar.edit', [
            'datanya' => Tahun_ajar::where('id', $id)->get()[0],
            'kampuses' => Kampus::select('id', 'nama_kampus')->get()
        ]);
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
        $tahun_ajar = Tahun_ajar::where('id', $id)->get()[0];
        $tahun_ajar->id_kampus = $request->id_kampus;
        $tahun_ajar->tahun_ajar = $request->tahun_ajar;
        $tahun_ajar->status = $request->status;
        $tahun_ajar->save();

        return redirect()->route('masterKampus.tahunajar.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tahun_ajar::where('id', $id)->delete();
        return redirect()->route('masterKampus.tahunajar.index');
    }
}
