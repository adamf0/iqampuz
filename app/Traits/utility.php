<?php
namespace App\Traits;

use App\Models\MasterKampus;

trait utility {
    public function ambil_subdomain() {
        $url = parse_url($_SERVER['HTTP_ORIGIN']);
        return $url['host'];
    }
    public function ambil_id_kampus() {
        $url = parse_url($_SERVER['HTTP_ORIGIN']);
        $subdomain = MasterKampus::select('id','nama_kampus','subdomain')->where('subdomain',$url['host'])->first();
        
        return $subdomain;
    }
    public function buat_nomor($list_nomor_terdaftar = []){
        $nomor = sprintf("%10d", mt_rand(1, 9999999999));
        if(in_array($nomor,$list_nomor_terdaftar)){
            $this->buat_nomor($list_nomor_terdaftar);
        }
        else{
            return $nomor;
        }
    }

    public function null_data(){
        return [
            "kode"=>"002",
            "message"=>"gagal",
            "pageprop"=>[
                "dari"=>0,
                "hingga"=>0,
                "totalData"=>0,
                "totalHalaman"=>0
            ],
            "listdata"=>[]
        ];
    }
    public function null_data_v2(){
        return [
            "kode"=>"002",
            "message"=>"gagal",
            "listdata"=>[],
        ];
    }

    public function show_data($dari=0,$hingga=0,$totaldata=0,$totalhalaman=0,$data=null){
        return [
            "kode"=>"001",
            "message"=>"sukses",
            "pageprop"=>[
                "dari"=>$dari,
                "hingga"=>$hingga,
                "totalData"=>$totaldata,
                "totalHalaman"=>$totalhalaman
            ],
            "listdata"=>[
                $data
            ]
        ];
    }

    public function show_data_object($data=null){
        return [
            "kode"=>"001",
            "message"=>"sukses",
            "listdata"=>$data,
        ];
    } 

    public function res_insert($status = false){
        switch($status){
            case 'sukses':
                return [
                    "kode"=>"001",
                    "message"=>"berhasil"
                ];
            case 'gagal':
                return [
                    "kode"=>"002",
                    "message"=>"cannot insert"
                ];
            case 'invalid':
                return [
                    "kode"=>"003",
                    "message"=>"invalid value"
                ];
            case 'required':
                return [
                    "kode"=>"004",
                    "message"=>"field is required"
                ];
            case 'unique':
                return [
                    "kode"=>"005",
                    "message"=>"field is unique"
                ];
            case 'token_expired':
                return [
                    "kode"=>"006",
                    "message"=>"token is expired"
                ];
            case 'token_invalid':
                return [
                    "kode"=>"007",
                    "message"=>"token is invalid"
                ];
            case 'token_absent':
                return [
                    "kode"=>"008",
                    "message"=>"token not found"
                ];
            default:
                return [
                    "kode"=>"999",
                    "message"=>"unknown eror"
                ];
             
        }
    }
}