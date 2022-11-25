<?php

namespace App\Http\Controllers;

use App\Models\master_kampus;
use Illuminate\Http\Request;

class masterKampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $masterKampus = master_kampus::all();
        return view('master.kampus.index', [
            'masterKampuses' => $masterKampus
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
    public function showinsert()
    {
        return view('master.kampus.insert');
    }
    public function detail(Request $id)
    {
        $masterKampus = master_kampus::find($id);
        return view('master.kampus.edit', [
            'detailKampus' => $masterKampus
        ]);
    }
    public function store(Request $request)
    {
        $masterKampus = new master_kampus;
        $request->validate([
            'nama_kampus' => 'required|max:50',
            'kode_kampus' => 'required',
            'tgl_kerjasama' => 'required',
            'logo_kampus' => 'required',
            'nama_rektor' => 'required',
            'alamat_kampus' => 'required',
            'profil_kampus' => 'required',
            'foto_kampus' => 'required',
            'foto_rektor' => 'required'
        ]);
        $masterKampus->nama_kampus = $request->nama_kampus;
        $masterKampus->kode_kampus = $request->kode_kampus;
        $masterKampus->alamat_kampus = $request->alamat_kampus;
        $masterKampus->profil_kampus = $request->profil_kampus;
        $masterKampus->warna_kampus = $request->warna_kampus;
        $masterKampus->nama_rektor = $request->nama_rektor;
        $masterKampus->tgl_kerjasama = $request->tgl_kerjasama;

        $masterKampus->foto_kampus = $request->foto_kampus->getClientOriginalName();
        $masterKampus->foto_rektor = $request->foto_rektor->getClientOriginalName();
        $masterKampus->logo_kampus = $request->logo_kampus->getClientOriginalName();


        $masterKampus->save();

        return redirect()->route('masterKampus.index');
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
    public function edit(Request $id)
    {
        $masterKampus = master_kampus::find($id);
        return view('master.kampus.edit', [
            'detailKampus' => $masterKampus
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $updateKampus = master_kampus::find($request->id);
        $updateKampus->nama_kampus = $request->nama_kampus;
        $updateKampus->kode_kampus = $request->kode_kampus;
        $updateKampus->tgl_kerjasama = $request->tgl_kerjasama;
        $updateKampus->nama_rektor = $request->nama_rektor;
        $updateKampus->alamat_kampus = $request->alamat_kampus;
        $updateKampus->profil_kampus = $request->profil_kampus;
        $updateKampus->warna_kampus = $request->warna_kampus;

        $updateKampus->foto_kampus = $request->foto_kampus->getClientOriginalName();
        $updateKampus->foto_rektor = $request->foto_rektor->getClientOriginalName();
        $updateKampus->logo_kampus = $request->logo_kampus->getClientOriginalName();

        $updateKampus->save();

        return redirect()->route('masterKampus.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = master_kampus::find($id);
        $delete->delete();
        return redirect()->route('masterKampus.index');
    }
}
