<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\utility;

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
        else{
            return response()->json($this->res_insert("fatal"));
        }
    }
}
