<?php

namespace App\Http\Controllers;

use App\Models\hak_akses_kampus;
use App\Models\Kampus;
use App\Models\Panel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class masterKampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('master.kampus.index', [
            'masterKampuses' => Kampus::all(),
            'hak_akses_kampus' => hak_akses_kampus::all(),
            'panels' => Panel::all()
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
        return view('master.kampus.insert', [
            'panels' => Panel::all()
        ]);
    }
    public function detail(Request $id)
    {
        return view('master.kampus.edit', [
            'detailKampus' => Kampus::find($id)
        ]);
    }
    public function store(Request $request)
    {
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

        $masterKampus                       = new Kampus;
        $masterKampus->nama_kampus          = $request->nama_kampus;
        $masterKampus->kode_kampus          = $request->kode_kampus;
        $masterKampus->alamat_kampus        = $request->alamat_kampus;
        $masterKampus->profil_kampus        = $request->profil_kampus;
        $masterKampus->warna_kampus         = $request->warna_kampus;
        $masterKampus->nama_rektor          = $request->nama_rektor;
        $masterKampus->tgl_kerjasama        = $request->tgl_kerjasama;
        $masterKampus->singkatan_kampus     = $request->singkatan_kampus;
        $masterKampus->akreditasi           = $request->akreditasi;
        $masterKampus->provinsi             = $request->provinsi;
        $masterKampus->tgl_berdiri          = $request->tanggal_berdiri;
        $masterKampus->kota                 = $request->kota;
        $masterKampus->telepon              = $request->telepon;
        $masterKampus->kodepos              = $request->kode_pos;
        $masterKampus->faximile             = $request->faximile;
        $masterKampus->email                = $request->email;
        $masterKampus->website              = $request->website;
        $masterKampus->created_at           = null;
        $masterKampus->updated_at           = null;


        $folder_location                    = public_path('images');
        $logo_kampus                        = $request->logo_kampus;
        $foto_kampus                        = $request->foto_kampus;
        $foto_rektor                        = $request->foto_rektor;
        $name_logo_kampus                   = Str::random(10) . "." . $logo_kampus->getClientOriginalExtension();
        $name_foto_kampus                   = Str::random(10) . "." . $foto_kampus->getClientOriginalExtension();
        $name_foto_rektor                   = Str::random(10) . "." . $foto_rektor->getClientOriginalExtension();
        $logo_kampus->move($folder_location, $name_logo_kampus);
        $foto_kampus->move($folder_location, $name_foto_kampus);
        $foto_rektor->move($folder_location, $name_foto_rektor);

        $masterKampus->logo_kampus          = $name_logo_kampus;
        $masterKampus->foto_kampus          = $name_foto_kampus;
        $masterKampus->foto_rektor          = $name_foto_rektor;
        $masterKampus->save();

        $get_last_id_kampus = $masterKampus->id;
        foreach (Panel::all() as $index => $panel) {
            $index2 = $index + 1;
            if ($request->$index2 == 'on') {
                $hak_akses_kampus = new hak_akses_kampus;
                $hak_akses_kampus->id_panel = $index2;
                $hak_akses_kampus->id_kampus = $get_last_id_kampus;
                $hak_akses_kampus->save();
            }
        }

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
        return view('master.kampus.edit', [
            'detailKampus' => Kampus::find($id),
            'panel' => Panel::where('id_kampus', $id)
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
        $updateKampus                       = Kampus::find($request->id);
        $updateKampus->nama_kampus          = $request->nama_kampus;
        $updateKampus->kode_kampus          = $request->kode_kampus;
        $updateKampus->alamat_kampus        = $request->alamat_kampus;
        $updateKampus->profil_kampus        = $request->profil_kampus;
        $updateKampus->warna_kampus         = $request->warna_kampus;
        $updateKampus->nama_rektor          = $request->nama_rektor;
        $updateKampus->tgl_kerjasama        = $request->tgl_kerjasama;
        $updateKampus->singkatan_kampus     = $request->singkatan_kampus;
        $updateKampus->akreditasi           = $request->akreditasi;
        $updateKampus->provinsi             = $request->provinsi;
        $updateKampus->tgl_berdiri          = $request->tanggal_berdiri;
        $updateKampus->kota                 = $request->kota;
        $updateKampus->telepon              = $request->telepon;
        $updateKampus->kodepos              = $request->kode_pos;
        $updateKampus->faximile             = $request->faximile;
        $updateKampus->email                = $request->email;
        $updateKampus->website              = $request->website;
        $updateKampus->created_at           = null;
        $updateKampus->updated_at           = null;
        $folder_location                     = public_path('images');

        if($request->has('logo_kampus')){
            $logo_kampus                         = $request->logo_kampus;
            $name_logo_kampus                    = Str::random(10) . "." . $logo_kampus->getClientOriginalExtension();
            $logo_kampus->move($folder_location, $name_logo_kampus);
            $updateKampus->logo_kampus           = $name_logo_kampus;
        }
        if($request->has('foto_kampus')){
            $foto_kampus                         = $request->foto_kampus;
            $name_foto_kampus                    = Str::random(10) . "." . $foto_kampus->getClientOriginalExtension();
            $foto_kampus->move($folder_location, $name_foto_kampus);
            $updateKampus->foto_kampus           = $name_foto_kampus;
        }
        if($request->has('foto_rektor')){
            $foto_rektor                         = $request->foto_rektor;
            $name_foto_rektor                    = Str::random(10) . "." . $foto_rektor->getClientOriginalExtension();
            $foto_rektor->move($folder_location, $name_foto_rektor);
            $updateKampus->foto_rektor           = $name_foto_rektor;
        }
        $updateKampus->save();

        return redirect()->route('masterKampus.update', ['id' => $request->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $delete_hak_akses_kampus = hak_akses_kampus::where('id_kampus', $id)->delete();
        $delete_kampus = Kampus::find($id)->delete();

        return redirect()->route('masterKampus.index');
    }
}
