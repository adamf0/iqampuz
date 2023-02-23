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

    public function get_data($type){
        if($type=="transport"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_transportasi')->get()
                )
            );
        }
        else if($type=="pendidikan"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_jenjang_pendidikan')->get()
                )
            );
        }
        else if($type=="pekerjaan"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_pekerjaan')->get()
                )
            );
        }
        else if($type=="penghasilan"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_penghasilan')->get()
                )
            );
        }
        else if($type=="jurusan"){
            return response()->json(
                $this->show_data_object(
                    DB::table('m_jurusan')->get()
                )
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
