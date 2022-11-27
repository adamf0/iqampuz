<?php
namespace App\Traits;

use App\Models\MasterKampus;

trait utility {
    public function ambil_subdomain($etc="") {
        $url = parse_url($_SERVER['HTTP_ORIGIN']);
        if($url['host']=="localhost"){
            return $url['host'];
        }
        else{
            $potong = explode(".",$url['host']); //HTTP_FROM
            if(count($potong)){
                return $potong[0];
            }
        }
    }
    public function ambil_id_kampus($etc="") {
        $url = parse_url($_SERVER['HTTP_ORIGIN']);
        if($url['host']=="localhost"){
            $subdomain = MasterKampus::select('id')->where('kode_kampus',$url['host'])->first();
        }
        else{
            $potong = explode(".",$url['host']); //HTTP_FROM
            $subdomain = MasterKampus::select('id')->where('kode_kampus',count($potong)? $potong[0]:'')->first();
        }
        
        return $subdomain;
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