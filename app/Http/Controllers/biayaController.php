<?php

namespace App\Http\Controllers;

use App\Models\Jurusan;
use App\Models\Kampus;
use App\Models\Komponen;
use App\Models\komponen_biaya;
use App\Models\pmb_gelombang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class biayaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

        $komponen = Komponen::all();

        // List prodi yang ada dikampus itu
        $lists_prodi = json_decode(Kampus::select('prodi')->where('id', $id)->get()[0]['prodi']);
        foreach ($lists_prodi as $list_prodi) {
            $kodes_prodi[] = (explode('|', $list_prodi));
        }
        foreach ($kodes_prodi as $kode_prodi) {
            $jrs_kampus[] = Jurusan::select('kode', 'nama', 'jenjang')->where('kode', $kode_prodi[1])->get();
        }
        foreach ($jrs_kampus as $jurusan) {
            $fixjurusan[] = $jurusan[0];
        }
        if (pmb_gelombang::where('id_kampus', $id)->exists()) {
            $gelombang = pmb_gelombang::where('id_kampus', $id)->get();
        } else {
            $gelombang = 'false';
        }



        if (komponen_biaya::where('id_kampus', $id)->exists()) {

            $komponens_biaya = komponen_biaya::where('id_kampus', $id)->get();

            // List komponen yang ada dikampus itu
            foreach ($komponens_biaya as $komponen_biaya) {
                $nama_komponen[] = Komponen::where('id_komponen', $komponen_biaya['id_komponen'])->get()[0]['nama_komponen'];
                $data_kom[] = $komponen_biaya;
            }

            return view('biaya.index', [
                'ada' => 'true',
                'list_komponen' => $nama_komponen,
                'data_komponen' => $data_kom,
                'jurusan' => $fixjurusan,
                'komponens' => $komponen,
                'gelombangs' => $gelombang,
                'id' => $id,
            ]);
        } else {
            return view('biaya.index', [
                'tidakada' => 'false',
                'jurusan' => $fixjurusan,
                'komponens' => $komponen,
                'gelombangs' => $gelombang,
                'id' => $id,
            ]);
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
    public function store(Request $request, $id)
    {
        $komponen_biaya = new komponen_biaya;
        $komponen_biaya->id_komponen = $request->komponen;
        $komponen_biaya->biaya = json_encode($request->biaya);
        $komponen_biaya->id_kampus = $id;
        $komponen_biaya->id_tahun_ajar = 99;
        $komponen_biaya->kode_jurusan = json_encode($request->jurusan);
        $komponen_biaya->status = 'masih dipantek';
        $komponen_biaya->id_gelombang = $request->gelombang;
        $komponen_biaya->save();

        $chanel_pembayaran = 'alfamart,bni,bsm,cimbniaga,ewallet,indomaret,faspay,bsi,shopee,nicepay';
        DB::table('kampus')->where('id', $id)->update(['channel' => $chanel_pembayaran]);



        return redirect()->route('masterKampus.biaya.index', ['id' => $id]);
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
        $komponen_biaya = komponen_biaya::where('id_komponen_biaya', $request->id_komponen_biaya)->get()[0];
        $komponen_biaya->id_komponen = $request->komponen;
        $komponen_biaya->biaya = json_encode($request->biaya);
        $komponen_biaya->id_kampus = $id;
        $komponen_biaya->id_tahun_ajar = 99;
        $komponen_biaya->kode_jurusan = json_encode($request->jurusan);
        $komponen_biaya->status = 'masih dipantek';
        $komponen_biaya->id_gelombang = 99;
        $komponen_biaya->save();

        return redirect()->route('masterKampus.biaya.index', ['id' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $id_kampus)
    {
        komponen_biaya::where('id_komponen_biaya', $id)->delete();
        return redirect()->route('masterKampus.biaya.index', ['id' => $id_kampus]);
    }
}
