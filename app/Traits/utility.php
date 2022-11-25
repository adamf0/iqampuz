<?php
namespace App\Traits;

use App\Models\MasterKampus;

trait utility {
    public function ambil_subdomain($etc="") {
        // $potong = explode(".",$_SERVER['HTTP_HOST']);
        $potong2 = explode(".",$etc);
        // dd(count($potong),$potong2);
        if(count($potong2)){
            return $potong2[0];
        }

        return null;
    }
    public function ambil_id_kampus($etc="") {
        // $potong = explode(".",$_SERVER['HTTP_HOST']);
        $potong2 = explode(".",$etc);
        $subdomain = MasterKampus::select('id')->whereIn('kode_kampus',count($potong2)? $potong2:[])->first();
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

    public function res_insert($status = false){
        switch($status){
            case 'sukses':
                return [
                    "kode"=>"001",
                    "message"=>""
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
            default:
                return [
                    "kode"=>"999",
                    "message"=>"unknown eror"
                ];
             
        }
    }
}