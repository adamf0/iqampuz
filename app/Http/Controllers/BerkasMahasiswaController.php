<?php

namespace App\Http\Controllers;

use App\Models\BerkasMahasiswa;
use App\Models\mahasiswa;
use App\Traits\utility;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class BerkasMahasiswaController extends Controller
{
    use utility;

    public function upload_berkas(Request $request){
        try {
            $payload    = JWTAuth::parseToken()->getPayload()->get('data');
            $mahasiswa  = mahasiswa::where('id_auth',$payload->id)->firstOrFail();
            
            DB::transaction(function () use($request,$mahasiswa,$payload){
                if($request->has('foto')){
                    $type_foto = $request->file('foto')->getClientMimeType();
                    $file_foto = $mahasiswa->nama."_foto.".$request->file('foto')->getClientOriginalExtension();
                    
                    $berkas1             = BerkasMahasiswa::where('id_auth',$payload->id)->first();
                    if($berkas1!=null && file_exists(public_path('berkas_mahasiswa/foto/'.$berkas1->nama_file))){
                        unlink(public_path('berkas_mahasiswa/foto/'.$berkas1->nama_file));
                    }
                    if($berkas1==null){
                        $berkas1 = new BerkasMahasiswa();
                    }
                    
                    $simpan_foto = $request->file('foto')->move('berkas_mahasiswa/foto', $file_foto);
                    $berkas1->id_auth    = $payload->id;
                    $berkas1->nama_file  = $file_foto;
                    $berkas1->tipe_file  = $type_foto;
                    $berkas1->save();                    
                }
                if($request->has('ktp')){
                    $type_ktp = $request->file('ktp')->getClientMimeType();
                    $file_ktp = $mahasiswa->nama."_ktp.".$request->file('ktp')->getClientOriginalExtension();
                    
                    $berkas2             = BerkasMahasiswa::where('id_auth',$payload->id)->first();
                    if($berkas2!=null && file_exists(public_path('berkas_mahasiswa/ktp/'.$berkas2->nama_file))){
                        unlink(public_path('berkas_mahasiswa/ktp/'.$berkas2->nama_file));
                    }
                    if($berkas2==null){
                        $berkas2 = new BerkasMahasiswa();
                    }
                    $simpan_ktp = $request->file('ktp')->move('berkas_mahasiswa/ktp', $file_ktp);
                    $berkas2->id_auth    = $payload->id;
                    $berkas2->nama_file  = $file_ktp;
                    $berkas2->tipe_file  = $type_ktp;
                    $berkas2->save();
                }
                if($request->has('kk')){
                    $type_kk = $request->file('kk')->getClientMimeType();
                    $file_kk = $mahasiswa->nama."_kk.".$request->file('kk')->getClientOriginalExtension();
                    
                    $berkas3             = BerkasMahasiswa::where('id_auth',$payload->id)->first();
                    if($berkas3!=null && file_exists(public_path('berkas_mahasiswa/kk/'.$berkas3->nama_file))){
                        unlink(public_path('berkas_mahasiswa/kk/'.$berkas3->nama_file));
                    }
                    if($berkas3==null){
                        $berkas3 = new BerkasMahasiswa();
                    }
                    $simpan_kk = $request->file('kk')->move('berkas_mahasiswa/kk', $file_kk);
                    $berkas3->id_auth    = $payload->id;
                    $berkas3->nama_file  = $file_kk;
                    $berkas3->tipe_file  = $type_kk;
                    $berkas3->save();
                }
                if($request->has('ijazah')){
                    $type_ijazah = $request->file('ijazah')->getClientMimeType();
                    $file_ijazah = $mahasiswa->nama."_ijazah.".$request->file('ijazah')->getClientOriginalExtension();
                    
                    $berkas4             = BerkasMahasiswa::where('id_auth',$payload->id)->first();
                    
                    if($berkas4!=null && file_exists(public_path('berkas_mahasiswa/ijazah/'.$berkas4->nama_file))){
                        unlink(public_path('berkas_mahasiswa/ijazah/'.$berkas4->nama_file));
                    }
                    if($berkas4==null){
                        $berkas4 = new BerkasMahasiswa();
                    }
                    $simpan_ijazah = $request->file('ijazah')->move('berkas_mahasiswa/ijazah', $file_ijazah);
                    $berkas4->id_auth    = $payload->id;
                    $berkas4->nama_file  = $file_ijazah;
                    $berkas4->tipe_file  = $type_ijazah;
                    $berkas4->save();
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
}
