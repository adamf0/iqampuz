<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use JWTAuth;

class MasterIqampusController extends Controller
{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

   function edu_tag_replace($datanya = '') {
        $datanya = preg_replace('/_ul/', "<ul class='list-unstyled'>", $datanya);
        $datanya = preg_replace('/ul_/', '</ul>', $datanya);
        $datanya = preg_replace('/_li/', '<li>', $datanya);
        $datanya = preg_replace('/li_/', '</li>', $datanya);
        $datanya = preg_replace('/_b/', '<b>', $datanya);
        $datanya = preg_replace('/b_/', '</b>', $datanya);

        return $datanya;
    }

    function array_orderby(){
        $args = func_get_args();
        $data = array_shift($args);
        foreach ($args as $n => $field) {
            if (is_string($field)) {
                $tmp = array();
                foreach ($data as $key => $row)
                    $tmp[$key] = $row[$field];
                $args[$n] = $tmp;
                }
        }
        $args[] = &$data;
        call_user_func_array('array_multisort', $args);
        return array_pop($args);
    }  

    public function mbank(){  
        $conf_bank =  DB::table('m_bank')->get();
        return $conf_bank;
    }
  
    function provinsi(){
        $provinsi =  DB::table('m_wilayah')->where('parent','=','000000')->get();
        return $provinsi;
    }

    function kabkota(Request $request){
        $id_parent = $request->id_parent;
        $kecamatan =  DB::table('m_wilayah')->where('parent','=',$id_parent)->get();

        return $kecamatan;
    }

    function kecamatan(Request $request){
        $id_parent = $request->id_parent;
        $kecamatan =  DB::table('m_wilayah')->where('parent','=',$id_parent)->get();

        return $kecamatan;
    }

    function desa(Request $request){
        $id_parent = $request->id_parent;
        $desa =  DB::table('m_wilayah')->where('parent','=',$id_parent)->get();

        return $desa;
    }

    function kota(){
        $kota =  DB::table('m_wilayah')->where('fmod','=','Kabupaten/Kota')->get();
        
        return $kota;
    }

    function jurusan(){
        $jurusan =  DB::table('m_jurusan')->where('jenjang','!=','SMK')->get();

        foreach($jurusan as $u){
            $output_json[] = [
                "id"=> $u->id,
                "kode"=> $u->kode,
                "nama"=> $u->nama,
                "jenjang"=> $u->jenjang,
                "gelar"=>  $u->gelar,
                "karir"=>$u->karir,
                "komp"=>$u->komp,
            ];
        }

        return $output_json;

        $result = json_decode($output_json, true);
        $sorted = $this->array_orderby($result, 'nama',SORT_ASC, 'gelar', SORT_ASC);
        return $sorted;
    }

     function jurusan_detail(Request $request){
        error_reporting(0);
        $kode_jurusan = $request->kode_jurusan;
        $jurusan =  DB::table('conf_jurusan')->where('jenjang','!=','SMK')->where('kode','=',$kode_jurusan)->get();
          foreach($jurusan as $u){
            $output_json[] = [
                "id"=> $u->id,
                "kode"=> $u->kode,
                "nama"=> $u->nama,
                "jenjang"=> $u->jenjang,
                "gelar"=>  $u->gelar,
                "karir"=>$this->edu_tag_replace($u->karir),
                "komp"=>$u->komp,
            ];
        }

        return $output_json;
    }

    function pendidikan(){
        $pendidikan =  DB::table('m_leveledu')->where('urutan','>=','4')->get();

        return $pendidikan;
    }

    function pendidikan_registrasi_daftar(Request $request){
        $kodelulusan =  DB::table('m_leveledu')
        ->where('kode','=',$request->kodelulusan)
        ->first();

        //  echo "<pre>";
        //  print_r($kodelulusan->minurutan);
        //  echo "</pre>";
        // die;

        if($kodelulusan->minurutan==3){
            $minurutan = 4;
        }else{
            $minurutan = 4;
        }


        $pendidikan =  DB::table('m_leveledu')
        ->where('urutan','=',$minurutan)
        ->get();

        return $pendidikan;
    }

    function pendidikan_registrasi_daftar_mapping(Request $request){
        error_reporting(0);

         $kodelulusan =  DB::table('m_leveledu')
        ->where('kode','=',$request->kodelulusan)
        ->first();

        $urutan = $kodelulusan->urutan;

        
        $kelompok = $request->kelompok;


         $kodelulusan =  DB::table('m_leveledu')
        ->where('kode','=',$kelompok)
        ->first();

          $minurutan = $kodelulusan->minurutan;



        if($urutan >= $minurutan){
              $data['status'] = 200;
              $data['message'] = "Boleh Lanjut";
        }else{
             $data['status'] = 404;
              $data['message'] = "Tidak Boleh Lanjut , Pendidikan belum waktunya";
        }

        return $data;


    }

     function kelas(){

        $kelas =  DB::table('conf_kumkod')
        ->where('urutan','<=',5)
        ->where('jenis','=','kelas')
        ->get();

        return $kelas;
    }

     function unitarea(){

        $unitarea =  DB::table('conf_unitarea')->get();

        $result = json_decode($unitarea, true);



          $sorted = $this->array_orderby($result, 'nama',
          SORT_ASC, 'id', SORT_DESC);

         return $sorted;


    }

}
