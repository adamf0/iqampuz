<?php

namespace App\Http\Controllers;

use App\Models\Gelombang;
use App\Models\Kampus;
use Illuminate\Http\Request;

class gelombangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        return view('gelombang.index', [
            'datanya' => Gelombang::where('id_kampus', $id)->get(),
            'kampuses' => Kampus::select('id', 'nama_kampus')->get()
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
        $gelombang = new Gelombang;
        $gelombang->nama_gelombang = $request->gelombang;
        $gelombang->tgl_mulai = $request->tgl_mulai;
        $gelombang->tgl_selesai = $request->tgl_selesai;
        $gelombang->status = $request->status;
        $gelombang->id_kampus = $request->id_kampus;
        $gelombang->tahun_ajar = $request->tahun_ajar;
        $gelombang->ujian_seleksi = $request->ujian_seleksi;
        $gelombang->save();

        return redirect()->route('masterKampus.gelombang.index');
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
        $edit_gelombang = Gelombang::where('id_gelombang', $id)->get()[0];
        // $edit_gelombang->nama_gelombang = $request->gelombang;
        // $edit_gelombang->tgl_mulai = $request->tgl_mulai;
        // $edit_gelombang->tgl_selesai = $request->tgl_selesai;
        // $edit_gelombang->status = $request->status;
        // $edit_gelombang->id_kampus = $request->id_kampus;
        // $edit_gelombang->tahun_ajar = $request->tahun_ajar;
        // $edit_gelombang->ujian_seleksi = $request->ujian_seleksi;
        // $edit_gelombang->save();

        return view('gelombang.edit', ['datanya' => $edit_gelombang]);
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
        $gelombang = Gelombang::where('id_gelombang', $id)->get()[0];
        $gelombang->nama_gelombang = $request->gelombang;
        $gelombang->tgl_mulai = $request->tgl_mulai;
        $gelombang->tgl_selesai = $request->tgl_selesai;
        $gelombang->status = $request->status;
        $gelombang->id_kampus = $request->id_kampus;
        $gelombang->tahun_ajar = $request->tahun_ajar;
        $gelombang->ujian_seleksi = $request->ujian_seleksi;
        $gelombang->save();

        return redirect()->route('masterKampus.gelombang.edit', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Gelombang::where('id_gelombang', $id)->delete();
        return redirect()->route('masterKampus.gelombang.index');
    }
}
