<?php

namespace App\Http\Controllers;

use App\Models\KomponenBiaya;
use App\Models\Tagihan;
use App\Models\TagihanDetail;
use App\Traits\utility;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class TagihanController extends Controller
{
    use utility;

    public function buat_tagihan(Request $request){
        try {
            $payload            = JWTAuth::parseToken()->getPayload()->get('data');
            DB::transaction(function () use($payload,$request){
                $id_auth        = $payload->id;
                $id_kampus      = $payload->id_kampus;
                $tanggal_aktif  = date('Y-m-d');
                $tanggal_expire = date('Y-m-d',strtotime("+1 day"));           
    
                $tagihan                    = new Tagihan();
                $tagihan->id_auth           = $id_auth;
                $tagihan->id_kampus         = $id_kampus;
                $tagihan->tanggal_aktif     = $tanggal_aktif;
                $tagihan->tanggal_expire    = $tanggal_expire;
                $tagihan->tanggal_batal     = null;
                $tagihan->nomor_va          = $this->buat_nomor();
                $tagihan->status            = 'menunggu pembayaran';
                $tagihan->save();
    
                foreach($request->komponen_biaya as $komponen){
                    $komponen = KomponenBiaya::where('id_komponen_biaya',$komponen)->firstOrFail();

                    $tagihan_detail                     = new TagihanDetail();
                    $tagihan_detail->id_tagihan         = $tagihan->id;
                    $tagihan_detail->id_komponen_biaya  = $komponen->id_komponen_biaya;
                    $tagihan_detail->biaya              = $komponen->biaya; 
                    $tagihan_detail->save();
                }
            });

            return response()->json($this->res_insert("sukses"));
        } catch (Exception $e) {
            // return response()->json(["data"=>$request->all(), "log"=>$e->getMessage()]);
            return response()->json($this->res_insert("fatal"));
        } catch (TokenExpiredException $e) {
            return response()->json($this->res_insert("token_expired"));
        } catch (TokenInvalidException $e) {
            return response()->json($this->res_insert("token_invalid"));
        } catch (JWTException $e) {
            return response()->json($this->res_insert("token_absent"));
        }
    }
    public function riwayat_tagihan(Request $request){
        if($request->type=='belum_bayar'){
            $tagihan = Tagihan::where('status','menunggu pembayaran')->get();   
        }
        else{
            $tagihan = Tagihan::where('status','!=','menunggu pembayaran')->get();
        }
        return response()->json($this->show_data_object($tagihan));
    }
    public function batal_tagihan($id){
        $tagihan = Tagihan::findOrFail($id);
        $tagihan->status = "batal pembayaran";
        if($tagihan->save()){
            return response()->json($this->res_insert("sukses"));
        }
        else{
            return response()->json($this->res_insert("fatal"));
        }
    }
}
