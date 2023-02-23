<?php

namespace App\Http\Controllers;

use App\Models\KomponenBiaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\utility;
use Exception;

class UtilityController extends Controller
{
    use utility;

    public function get_data($type,Request $request){
        if($type=="transport"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_transportasi')->select('id_alat_transport as value','nm_alat_transport as label')->get()
                )
            );
        }
        else if($type=="pendidikan"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_jenjang_pendidikan')->select('id_jenj_didik as value','nm_jenj_didik as label')->get()
                )
            );
        }
        else if($type=="pekerjaan"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_pekerjaan')->select('id_pekerjaan as value','nm_pekerjaan as label')->get()
                )
            );
        }
        else if($type=="penghasilan"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_penghasilan')->select('id_penghasilan as value','nm_penghasilan as label')->get()
                )
            );
        }
        else if($type=="jurusan"){
            $datas = DB::table('m_jurusan')->select('kode as value', DB::raw("concat(nama,' - ',jenjang) as label"));
            if($request->has('jenjang')) $datas->where('jenjang',$request->get('jenjang'));
            $datas = $datas->get();
            
            return response()->json(
                $this->show_data_object($datas)
            );
        }
        else if($type=="komponen_biaya"){
            try {
                $kampus = $this->ambil_id_kampus();
                $datas = KomponenBiaya::with([
                    'master_komponen',
                    'jurusan',
                    'tahun_ajar'=>function($query){
                        $query->select('tahun_ajar')->where('status',1);
                    }
                ])
                ->where('id_kampus',$kampus->id)->get();
                
                $datas->each(function($row){
                    $row->value = $row->id_komponen_biaya;
                    $row->label = $row->master_komponen->nama_komponen;
                    unset(
                        $row->id_komponen_biaya,
                        $row->id_komponen,
                        $row->id_kampus,
                        $row->id_tahun_ajar,
                        $row->id_jurusan,
                        $row->jurusan,
                        $row->tahun_ajar,
                        $row->master_komponen
                    );
                });

                return response()->json(
                    $this->show_data_object($datas)
                );
            } catch (Exception $e) {
                return response()->json($this->res_insert("fatal"));
            }
        }
        else{
            return response()->json($this->res_insert("fatal"));
        }
    }
}
