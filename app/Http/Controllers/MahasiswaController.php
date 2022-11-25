<?php

namespace App\Http\Controllers;

use App\Jobs\SubmitEmailJob;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class MahasiswaController extends Controller
{
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function index(Request $req){
        return response()->json([
            "status"=>200,
            "message"=>"",
            "error"=>"",
            "data"=>\DB::table('mahasiswa')->where('id_kampus',$req->id_kampus)->get()
        ]);
    }

    public function store(Request $request){
        $validated = Validator::make($request->all(),[
            'nama_lengkap' => 'required',
            'email' => 'required|email',
            'nomor_wa' => 'required',
            'asal_sekolah' => 'required|email',
            'jurusan_diminati1' => 'required',
            // 'id_kampus' => 'required',
        ]);

        if($validated->fails()){
            return response()->json([
                "status"=>500,
                "message"=>"gagal",
                "error"=>$validated->errors(),
                "data"=>""
            ]);
        }
        $pass = Str::random(10);

        try {
            $id_kampus = array_shift((explode('.', $_SERVER['HTTP_HOST'])));
            $mahasiswa = \DB::table('mahasiswa')->insertGetId([
                "email" => $request->email,
                "password" => Hash::make($pass),
                "decode_password" => $pass,
                "nama_lengkap" => $request->nama_lengkap,
                "nomor_wa" => $request->nomor_wa,
                "asal_sekolah" => $request->asal_sekolah,
                "jurusan_diminati1" => $request->jurusan_diminati1,
                "jurusan_diminati2" => $request->has('jurusan_diminati2')? $request->jurusan_diminati2:null,
                "id_kampus" => $id_kampus
            ]);
            Log::info('mahasiswa success to save.', ['id' => $mahasiswa]);
            $emailJob = (new SubmitEmailJob($request->email, ["nama"=>$request->nama,"email"=>$request->email,"password"=>$pass]));
            dispatch($emailJob);
            
            return response()->json([
                "status"=>200,
                "message"=>"berhasil",
                "error"=>null,
                "data"=>$pass
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status"=>500,
                "message"=>"gagal",
                "error"=>$e->getMessage(),
                "data"=>""
            ]);
        }
    }

    public function update(Request $request){
        $validated = Validator::make($request->all(),[
            'nama_lengkap'          => 'required',
            'jenis_kelamin'         => 'required',
            'tanggal_lahir'         => 'required',
            'tempat_lahir'          => 'required',
            'agama'                 => 'required',
            'nomor_wa'              => 'required',
            'alamat'                => 'required',
            'asal_sekolah'          => 'required',
            'status_tes'            => 'required',
            'tanggal_lulus_tes'     => 'required',
            'status_mahasiswa'      => 'required',
            'jurusan_diminati1'     => 'required'
        ]);

        if($validated->fails()){
            return response()->json(["status"=>500,"message"=>"gagal","error"=>$validated->errors()]);
        }

        $data = [
            'nama_lengkap'          => $request->nama_lengkap,
            'jenis_kelamin'         => $request->jenis_kelamin,
            'tanggal_lahir'         => $request->tanggal_lahir,
            'tempat_lahir'          => $request->tempat_lahir,
            'agama'                 => $request->agama,
            'nomor_wa'              => $request->nomor_wa,
            'alamat'                => $request->alamat,
            'asal_sekolah'          => $request->asal_sekolah,
            'status_tes'            => $request->status_tes,
            'tanggal_lulus_tes'     => $request->tanggal_lulus_tes,
            'status_mahasiswa'      => $request->status_mahasiswa,
            'jurusan_diminati1'     => $request->jurusan_diminati1
        ];
        if($request->has('jurusan_diminati2')){
            $data['jurusan_diminati2'] = $request->jurusan_diminati2;
        }
    
        try {
            $payload = collect(JWTAuth::parseToken()->getPayload()->get('data'));
            \DB::table('mahasiswa')->where('id',$payload->id)->update($data);
            Log::info('mahasiswa success to update.', ['id' => $payload->id]);
            
            return response()->json([
                "status"=>200,
                "message"=>"berhasil",
                "error"=>null,  
                "data"=>""
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status"=>500,
                "message"=>"gagal",
                "error"=>$e->getMessage(),
                "data"=>""
            ]);
        }
    }
}
