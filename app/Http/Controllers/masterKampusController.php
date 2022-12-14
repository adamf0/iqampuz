<?php

namespace App\Http\Controllers;

use App\Models\hak_akses_kampus;
use App\Models\Jurusan;
use App\Models\Kampus;
use App\Models\komponen_biaya;
use App\Models\Panel;
use App\Models\Wilayah;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\JsonDecoder;
use Illuminate\Support\Facades\File;


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
            'panels' => Panel::all(),

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

    public function wilayah($type, $kode)
    {
        if ($type == "provinsi") {
            $datas = Wilayah::select('kode as id', 'nama as text')->where('fmod', 'Provinsi')->get();
            return response()->json($datas->toArray());
        } else if ($type == "kota") {
            $datas = Wilayah::select('kode as id', 'nama as text')->where('fmod', 'Kabupaten/Kota')->where('parent', $kode)->get();
            return response()->json($datas->toArray());
        } else if ($type == "jurusan") {
            $datas = Jurusan::select(DB::raw("CONCAT(jenjang,' - ',nama) AS text"), 'kode as idx')->get();
            return response()->json($datas->toArray());
        }
    }
    public function tes(Request $request)
    {
        // $provinsi = Wilayah::where('kode', '0' . $request->provinsi)->get();
        // dd($provinsi[0]['nama']);
        // // foreach ($provinsi as $pro) {
        // //     echo $pro['nama'];
        // // }
        // die;




        // foreach ($request->prodi as $p) {
        //     $prodi[] = $p;
        // }

        // $datanya = [];
        // foreach ($request->akreditasi as $index => $a) {
        //     $datanya[] = $a . "|" . $prodi[$index];
        // }
        // header('Content-Type: application/json');
        // echo json_encode($datanya);



        // // keterangan
        // $data_sejarah['sejarah'] = $request->sejarah;
        // $data_sejarah['visi'] = $request->visi;
        // $data_sejarah['misi'] = $request->misi;
        // $data_sejarah['youtube'] = $request->youtube;

        // $response = array(
        //     'keterangan' => $data_sejarah
        // );
        // $keterangan = json_encode($response);


        // // prodi dan akreditasi
        // $arr = [];
        // foreach ($request->akreditasi as $a) {
        //     $k[] = $a;
        // }
        // foreach ($request->prodi as $index => $p) {
        //     $prodi['kode'] = $p;
        //     $akre['akreditasi'] = $k[$index];
        //     $ha = array_merge($prodi, $akre);

        //     $arr['Prodi'][] = $ha;
        // }
        // $result =  json_encode($arr);

        // die;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function showinsert()
    {
        $akreditasi_kampus = ['A', 'A+', 'B', 'B+', 'C', 'C+'];

        return view('master.kampus.insert', [
            'panels' => Panel::all(),
            'jurusan' => Jurusan::select(DB::raw("CONCAT(jenjang,' - ',nama) AS text"), 'kode as idx')->get(),
            'akreditasi' => $akreditasi_kampus
        ]);
    }
    public function detail(Request $id)
    {
        $akreditasi_kampus = ['A', 'A+', 'B', 'B+', 'C', 'C+'];
        return view('master.kampus.edit', [
            'detailKampus' => Kampus::find($id),
            'akreditasi' => $akreditasi_kampus
        ]);
    }
    public function store(Request $request)
    {
        // dd($request);
        // $kmp = $request->file('logo_kampus');
        // echo $kmp->getClientOriginalExtension();
        // die;
        // validasi
        // $request->validate([
        //     'nama_kampus' => 'required',
        //     'kode_kampus' => 'required',
        //     'profil_kampus' => 'required',
        //     'warna_kampus' => 'required',
        //     'nama_rektor' => 'required',
        //     'tgl_kerjasama' => 'required',
        //     'alamat_kampus' => 'required',
        //     'singkatan_kampus' => 'required',
        //     'akreditasi' => 'required',
        //     'provinsi' => 'required',
        //     'tgl_berdiri' => 'required',
        //     'kota' => 'required',
        //     'telepon' => 'required',
        //     'kodepos' => 'required',
        //     'faximile' => 'required',
        //     'email' => 'required',
        //     'website' => 'required'
        // ]);

        $request->validate([
            'nama_kampus' => 'required',
        ]);

        // Get request post
        $masterKampus                       = new Kampus;
        $masterKampus->nama_kampus          = $request->nama_kampus;
        $masterKampus->kode_kampus          = $request->kode_kampus;
        $masterKampus->profil_kampus        = $request->profil_kampus;
        $masterKampus->warna_kampus         = $request->warna_kampus;
        $masterKampus->nama_rektor          = $request->nama_rektor;
        $masterKampus->tgl_kerjasama        = $request->tgl_kerjasama;
        $masterKampus->alamat_kampus        = $request->alamat_kampus;
        $masterKampus->singkatan_kampus     = $request->singkatan_kampus;
        $masterKampus->akreditasi           = $request->akreditasi_kampus;
        $provinsi = Wilayah::where('kode', "0" . $request->provinsi)->get();
        $masterKampus->provinsi             = $provinsi[0]['nama'];
        $masterKampus->tgl_berdiri          = $request->tanggal_berdiri;
        $masterKampus->kota                 = $request->kota;
        $kota = Wilayah::where('kode', "0" . $request->kota)->get();
        $masterKampus->kota                 = $kota[0]['nama'];
        $masterKampus->telepon              = $request->telepon;
        $masterKampus->kodepos              = $request->kode_pos;
        $masterKampus->faximile             = $request->faximile;
        $masterKampus->email                = $request->email;
        $masterKampus->website              = $request->website;
        $masterKampus->kode_pt              = $request->kode_pt;
        $masterKampus->subdomain            = strtolower($request->singkatan_kampus) . ".iqampuz.com";
        // keterangan = sejarah kampus
        // prodi = prodi dan akreditasi
        $masterKampus->created_at           = null;
        $masterKampus->updated_at           = null;


        // Kelola Gambar
        $folder_location                    = public_path('images');
        $logo_kampus                        = $request->file('logo_kampus');
        $foto_kampus                        = $request->file('foto_kampus');
        $foto_rektor                        = $request->file('foto_rektor');
        $name_logo_kampus                   = Str::random(10) . "." . $logo_kampus->getClientOriginalExtension();
        $name_foto_kampus                   = Str::random(10) . "." . $foto_kampus->getClientOriginalExtension();
        $name_foto_rektor                   = Str::random(10) . "." . $foto_rektor->getClientOriginalExtension();
        $logo_kampus->move($folder_location, $name_logo_kampus);
        $foto_kampus->move($folder_location, $name_foto_kampus);
        $foto_rektor->move($folder_location, $name_foto_rektor);

        $masterKampus->logo_kampus          = $name_logo_kampus;
        $masterKampus->foto_kampus          = $name_foto_kampus;
        $masterKampus->foto_rektor          = $name_foto_rektor;


        // field keterangan
        $data_sejarah['sejarah'] = $request->sejarah;
        $data_sejarah['visi'] = $request->visi;
        $data_sejarah['misi'] = $request->misi;
        $data_sejarah['slogan'] = $request->slogan;
        $data_sejarah['youtube'] = $request->youtube;


        $keterangan = json_encode($data_sejarah);
        $masterKampus->keterangan = $keterangan;


        // prodi dan akreditasi
        foreach ($request->prodi as $p) {
            $prodi[] = $p;
        }

        $datanya = [];
        foreach ($request->akreditasi as $index => $a) {
            $datanya[] = $a . "|" . $prodi[$index];
        }
        $hasilnya = json_encode($datanya);
        $masterKampus->prodi = $hasilnya;




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

        $akreditasi_kampus = ['A', 'A+', 'B', 'B+', 'C', 'C+'];
        $akses_kampus = hak_akses_kampus::select('id_panel')->where('id_kampus', $id['id'])->get();
        foreach ($akses_kampus as $akses_ke_panel) {
            $akses_panel[] = Panel::select('nama_panel', 'id_panel')->where('id_panel', $akses_ke_panel['id_panel'])->get();
        }
        foreach ($akses_panel as $step1) {
            foreach ($step1 as $panel) {
                $data_panel[] = $panel;
            }
        }

        return view('master.kampus.edit', [
            'detailKampus' => Kampus::find($id),
            'panels' => Panel::all(),
            'akreditasi' => $akreditasi_kampus,
            'jurusan' => Jurusan::select(DB::raw("CONCAT(jenjang,' - ',nama) AS text"), 'kode as idx')->get(),
            'hak_akses_panel' => $data_panel
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

        $request->validate([
            'nama_kampus' => 'required',
        ]);

        $id = (int) $request->id;

        // Get request post
        $masterKampus                       = Kampus::find($id);
        $masterKampus->nama_kampus          = $request->nama_kampus;
        $masterKampus->kode_kampus          = $request->kode_kampus;
        $masterKampus->profil_kampus        = $request->profil_kampus;
        $masterKampus->warna_kampus         = $request->warna_kampus;
        $masterKampus->nama_rektor          = $request->nama_rektor;
        $masterKampus->tgl_kerjasama        = $request->tgl_kerjasama;
        $masterKampus->alamat_kampus        = $request->alamat_kampus;
        $masterKampus->singkatan_kampus     = $request->singkatan_kampus;
        $masterKampus->akreditasi           = $request->akreditasi_kampus;

        if ($req_provinsi = (int) $request->provinsi) {
            if (strlen($req_provinsi) < 6) {
                $req_provinsi = 0 . $req_provinsi;
                $provinsi = Wilayah::where('kode', $req_provinsi)->get()[0]['nama'];
                $masterKampus->provinsi = $provinsi;
            } else {
                $provinsi = Wilayah::where('kode', $req_provinsi)->get()[0]['nama'];
                $masterKampus->provinsi = $provinsi;
            }
        } else {
            $masterKampus->provinsi = $request->provinsi;
        }

        if ($req_kota = (int) $request->kota) {
            if (strlen($req_kota) < 6) {
                $req_kota = 0 . $req_kota;
                $kota = Wilayah::where('kode', $req_kota)->get()[0]['nama'];
                $masterKampus->kota = $kota;
            } else {
                $kota = Wilayah::where('kode', $req_kota)->get()[0]['nama'];
                $masterKampus->kota = $kota;
            }
        } else {
            $masterKampus->kota = $request->kota;
        }

        // if (Wilayah::where('nama', $request->provinsi)) {
        //     $masterKampus->provinsi = $request->provinsi;
        // } else if (Wilayah::where('kode',)) {
        //     $provinsi = "0" . $request->provinsi;
        //     $qwilayah = Wilayah::where('kode', $provinsi)->get()[0]['nama'];
        //     echo $qwilayah;
        //     // $masterKampus->provinsi = Wilayah::where('kode', $provinsi)->get()[0]['nama'];
        // }

        // if (Wilayah::where('nama', $request->kota)) {
        //     $masterKampus->kota = $request->kota;
        // } else if (strlen($request->kota) < 6) {
        //     $kota = "0" . $request->kota;
        //     $masterKampus->kota = Wilayah::where('kode', $kota)->get()[0]['nama'];
        // }


        // if (strlen($request->provinsi) < 6) {
        //     $provinsi = "0" . $request->provinsi;
        //     $masterKampus->provinsi = Wilayah::where('kode', $provinsi)->get()[0]['nama'];
        // } else {
        //     $provinsi = $request->provinsi;
        //     $masterKampus->provinsi = $provinsi;
        // }

        // if (strlen($request->kota) < 6) {
        //     $kota = "0" . $request->kota;
        //     $masterKampus->kota = Wilayah::where('kode', $kota)->get()[0]['nama'];
        // } else {
        //     $kota = $request->kota;
        //     $masterKampus->kota = $kota;
        // }



        // $masterKampus->provinsi             = Wilayah::where('kode', "0" . $request->provinsi)->get() == [] ? $request->provinsi : Wilayah::where('kode', "0" . $request->provinsi)->get()[0]['nama'];
        // $masterKampus->provinsi             = 'tes';
        $masterKampus->tgl_berdiri          = $request->tanggal_berdiri;
        // $masterKampus->kota                 = Wilayah::where('kode', "0" . $request->kota)->get() == [] ? $request->kota : Wilayah::where('kode', "0" . $request->kota)->get()[0]['nama'];
        // $masterKampus->kota                 = 'tes';
        $masterKampus->telepon              = $request->telepon;
        $masterKampus->kodepos              = $request->kode_pos;
        $masterKampus->faximile             = $request->faximile;
        $masterKampus->email                = $request->email;
        $masterKampus->website              = $request->website;
        $masterKampus->kode_pt              = $request->kode_pt;
        $masterKampus->subdomain            = strtolower($request->singkatan_kampus) . ".iqampuz.com";
        // keterangan = sejarah kampus
        // prodi = prodi dan akreditasi
        $masterKampus->created_at           = null;
        $masterKampus->updated_at           = null;

        // File::delete('images/upin.jpg');
        // Kelola Gambar

        $folder_location                    = public_path('images');
        $kampus = Kampus::find($id);
        if ($request->file('logo_kampus') == null) {
            $masterKampus->logo_kampus = $kampus->logo_kampus;
        } else {
            $logo_kampus                    = $request->file('logo_kampus');
            $name_logo_kampus               = Str::random(10) . "." . $logo_kampus->getClientOriginalExtension();
            $logo_kampus->move($folder_location, $name_logo_kampus);
            $masterKampus->logo_kampus      = $name_logo_kampus;
            File::delete('images/' . $kampus->logo_kampus);
        }

        if ($request->file('foto_kampus') == null) {
            $masterKampus->foto_kampus = $kampus->foto_kampus;
        } else {
            $foto_kampus                        = $request->file('foto_kampus');
            $name_foto_kampus                   = Str::random(10) . "." . $foto_kampus->getClientOriginalExtension();
            $foto_kampus->move($folder_location, $name_foto_kampus);
            $masterKampus->foto_kampus          = $name_foto_kampus;
            File::delete('images/' . $kampus->foto_kampus);
        }

        if ($request->file('foto_rektor') == null) {
            $masterKampus->foto_rektor = $kampus->foto_rektor;
        } else {
            $foto_rektor                        = $request->file('foto_rektor');
            $name_foto_rektor                   = Str::random(10) . "." . $foto_rektor->getClientOriginalExtension();
            $foto_rektor->move($folder_location, $name_foto_rektor);
            $masterKampus->foto_rektor          = $name_foto_rektor;

            File::delete('images/' . $kampus->foto_rektor);
        }




        // $folder_location                    = public_path('images');
        // $logo_kampus                        = $request->file('logo_kampus');
        // $foto_kampus                        = $request->file('foto_kampus');
        // $foto_rektor                        = $request->file('foto_rektor');
        // $name_logo_kampus                   = Str::random(10) . "." . $logo_kampus->getClientOriginalExtension();
        // $name_foto_kampus                   = Str::random(10) . "." . $foto_kampus->getClientOriginalExtension();
        // $name_foto_rektor                   = Str::random(10) . "." . $foto_rektor->getClientOriginalExtension();
        // $logo_kampus->move($folder_location, $name_logo_kampus);
        // $foto_kampus->move($folder_location, $name_foto_kampus);
        // $foto_rektor->move($folder_location, $name_foto_rektor);

        // $masterKampus->logo_kampus          = $name_logo_kampus;
        // $masterKampus->foto_kampus          = $name_foto_kampus;
        // $masterKampus->foto_rektor          = $name_foto_rektor;


        // field keterangan
        $data_sejarah['sejarah'] = $request->sejarah;
        $data_sejarah['visi'] = $request->visi;
        $data_sejarah['misi'] = $request->misi;
        $data_sejarah['slogan'] = $request->slogan;
        $data_sejarah['youtube'] = $request->youtube;


        $keterangan = json_encode($data_sejarah);
        $masterKampus->keterangan = $keterangan;


        // prodi dan akreditasi
        foreach ($request->prodi as $p) {
            $prodi[] = $p;
        }

        $datanya = [];
        foreach ($request->akreditasi as $index => $a) {
            $datanya[] = $a . "|" . $prodi[$index];
        }
        $hasilnya = json_encode($datanya);
        $masterKampus->prodi = $hasilnya;


        $masterKampus->save();


        $delete_hak_akses_kampus = hak_akses_kampus::where('id_kampus', $id)->delete();
        foreach (Panel::all() as $index => $panels) {
            $index2 = $index + 1;
            if ($request->$index2) {
                $new_insert_hak_akses_kampus = new hak_akses_kampus;
                $new_insert_hak_akses_kampus->id_panel = $index2;
                $new_insert_hak_akses_kampus->id_kampus = $id;
                $new_insert_hak_akses_kampus->save();
            }
        }


        // foreach (Panel::all() as $index => $panel) {
        //     $index2 = $index + 1;
        //     if ($request->$index2 == 'on') {
        //         $hak_akses_kampus = hak_akses_kampus::where('id_kampus', $id);
        //         $hak_akses_kampus->id_panel = $index2;
        //         $hak_akses_kampus->id_kampus = $id;
        //         $hak_akses_kampus->save();
        //     }
        // }




        return redirect()->route('masterKampus.update', ['id' => $id]);



        // dd($request);
        // $updateKampus                       = Kampus::find($request->id);
        // $updateKampus->nama_kampus          = $request->nama_kampus;
        // $updateKampus->kode_kampus          = $request->kode_kampus;
        // $updateKampus->alamat_kampus        = $request->alamat_kampus;
        // $updateKampus->profil_kampus        = $request->profil_kampus;
        // $updateKampus->warna_kampus         = $request->warna_kampus;
        // $updateKampus->nama_rektor          = $request->nama_rektor;
        // $updateKampus->tgl_kerjasama        = $request->tgl_kerjasama;
        // $updateKampus->singkatan_kampus     = $request->singkatan_kampus;
        // $updateKampus->akreditasi           = $request->akreditasi;
        // $updateKampus->provinsi             = $request->provinsi;
        // $updateKampus->tgl_berdiri          = $request->tanggal_berdiri;
        // $updateKampus->kota                 = $request->kota;
        // $updateKampus->telepon              = $request->telepon;
        // $updateKampus->kodepos              = $request->kode_pos;
        // $updateKampus->faximile             = $request->faximile;
        // $updateKampus->email                = $request->email;
        // $updateKampus->website              = $request->website;
        // $updateKampus->created_at           = null;
        // $updateKampus->updated_at           = null;
        // $folder_location                     = public_path('images');

        // if ($request->has('logo_kampus')) {
        //     $logo_kampus                         = $request->logo_kampus;
        //     $name_logo_kampus                    = Str::random(10) . "." . $logo_kampus->getClientOriginalExtension();
        //     $logo_kampus->move($folder_location, $name_logo_kampus);
        //     $updateKampus->logo_kampus           = $name_logo_kampus;
        // }
        // if ($request->has('foto_kampus')) {
        //     $foto_kampus                         = $request->foto_kampus;
        //     $name_foto_kampus                    = Str::random(10) . "." . $foto_kampus->getClientOriginalExtension();
        //     $foto_kampus->move($folder_location, $name_foto_kampus);
        //     $updateKampus->foto_kampus           = $name_foto_kampus;
        // }
        // if ($request->has('foto_rektor')) {
        //     $foto_rektor                         = $request->foto_rektor;
        //     $name_foto_rektor                    = Str::random(10) . "." . $foto_rektor->getClientOriginalExtension();
        //     $foto_rektor->move($folder_location, $name_foto_rektor);
        //     $updateKampus->foto_rektor           = $name_foto_rektor;
        // }
        // $updateKampus->save();

        // return redirect()->route('masterKampus.update', ['id' => $request->id]);
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
