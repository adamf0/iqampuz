<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Models\MasterKampus;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Traits\utility;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;

class AuthController extends Controller
{
    use utility;
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    public function doLogin(Request $request){
        try {
            $this->validate($request, [
                'email'    => 'required|email',
                'password' => 'required',
            ]);
            
            $kampus = $this->ambil_id_kampus($request->header('accessing_from'));
            $auth = User::with(['user_role','user_role.role'])
                        ->where("email",$request->email)
                        ->where("password",$request->password)
                        ->where("id_kampus",$kampus->id)
                        ->firstOrFail();

            $data = JWTAuth::encode(JWTFactory::sub($auth->id)->data([
                "id"=>$auth->id,
                'id_kampus'=>$auth->master_kampus->id,
                "role"=>$auth->user_role->pluck('role.nama')
            ])->make())->get('value');

            return response()->json($this->show_data(0,0,0,0,$data));
        } catch (Exception $e) {
            return response()->json($this->res_insert("fatal"));
        }
    }
    public function decode(){
        try {
            return response()->json($this->show_data(0,0,0,0,JWTAuth::parseToken()->getPayload()->get('data')));
        } catch (Exception $e) {
            return response()->json($this->res_insert("fatal"));
        }
    }
    public function init(Request $request){
        try {
            $x = $this->ambil_subdomain($request->header('accessing_from'));
            return response()->json($this->show_data(0,0,0,0,MasterKampus::where('kode_kampus',$x)->firstOrFail()));
        } catch (Exception $e) {
            return response()->json($this->null_data());
        }
    } 
    public function create_auth_admin(Request $request){
        try {
            $validator = $this->validate($request, [
                'email'     => 'required',
                'password'  => 'required',
                'roles'     => 'required',
                "roles.*"   => "required",
            ]);
            // $validator2 = $this->validate($request, [
            //     'email'     => 'email',
            //     'password'  => 'min:6',
            //     'roles'     => 'array|min:1',
            //     "roles.*"   => "string|in:".Role::select('nama')->get()->implode('nama', ', '),
            // ]);
            if(!$validator){
                return response()->json($this->res_insert("required"));
            }
            // if(!$validator2){
            //     return response()->json($this->res_insert("invalid"));
            // }

            $kampus = $this->ambil_id_kampus($request->header('accessing_from'));
            DB::transaction(function() use($request,$kampus){
                $user = new User();
                $user->email = $request->email;
                $user->password = $request->password;
                $user->email = $request->email;
                $user->id_kampus = $kampus->id;
                $user->save();

                foreach((array) $request->roles as $role){
                    $userRole = new UserRole();
                    $userRole->id_auth = $user->id;
                    $userRole->role = $role;  
                    $userRole->save(); 
                }
            });

            return response()->json($this->res_insert("sukses"));
        } catch (Exception $e) {
            // dd($e->getMessage());
            return response()->json($this->res_insert("fatal"));
        }
    }
    public function create_auth_user(Request $request){
        try {
            $validator = $this->validate($request, [
                'nama_lengkap'      => 'required',
                'email'             => 'required',
                'nomor_wa'          => 'required',
                'asal_sekolah'      => 'required',
                'jurusan_diminati1' => 'required'
            ]);
            // $validator2 = $this->validate($request, [
            //     'email'             => 'email',
            //     'nomor_wa'          => 'number'
            // ]);
            if(!$validator){
                return response()->json($this->res_insert("required"));
            }
            // if(!$validator2){
            //     return response()->json($this->res_insert("invalid"));
            // }

            $kampus = $this->ambil_id_kampus();
            DB::transaction(function() use($request,$kampus){
                $user = new User();
                $user->email = $request->email;
                $user->password = Str::random(6);
                $user->id_kampus = $kampus->id;
                $mahasiswa->nama_lengkap = $request->nama_lengkap;
                $mahasiswa->email = $request->email;
                $mahasiswa->nomor_wa = $request->nomor_wa;
                $mahasiswa->asal_sekolah = $request->asal_sekolah;
                $mahasiswa->jurusan_diminati1 = $request->jurusan_diminati1;
                if($request->has('jurusan_diminati2')){
                    $mahasiswa->jurusan_diminati1 = $request->jurusan_diminati2;
                }
                $user->save();

                $userRole = new UserRole();
                $userRole->id_auth = $user->id;
                $userRole->role = 'user';  
                $userRole->save();
            });

            return response()->json($this->res_insert("sukses"));
        } catch (Exception $e) {
            // dd($e->getMessage());
            return response()->json($this->res_insert("fatal"));
        }
    }
    public function update_auth_user(Request $request){
        try {
            // $validator = $this->validate($request, [
            //     'nama_lengkap'      => 'required',
            //     'email'             => 'required',
            //     'nomor_wa'          => 'required',
            //     'asal_sekolah'      => 'required',
            //     'jurusan_diminati1' => 'required'
            // ]);
            // $validator2 = $this->validate($request, [
            //     'email'             => 'email',
            //     'nomor_wa'          => 'number'
            // ]);
            if(!$validator){
                return response()->json($this->res_insert("required"));
            }
            // if(!$validator2){
            //     return response()->json($this->res_insert("invalid"));
            // }

            $kampus = $this->ambil_id_kampus();
            DB::transaction(function() use($request,$kampus){
                $user = new User();
                $user->email = $request->email;
                // $user->password = Str::random(6);
                // $user->id_kampus = $kampus->id;
                $user->nama_lengkap = $request->nama_lengkap;
                $user->email = $request->email;
                $user->nomor_wa = $request->nomor_wa;
                $user->asal_sekolah = $request->asal_sekolah;
                $user->jurusan_diminati1 = $request->jurusan_diminati1;
                if($request->has('jurusan_diminati2')){
                    $user->jurusan_diminati1 = $request->jurusan_diminati2;
                }
                $user->save();

                // $userRole = new UserRole();
                // $userRole->id_auth = $user->id;
                // $userRole->role = 'user';  
                // $userRole->save();
            });

            return response()->json($this->res_insert("sukses"));
        } catch (Exception $e) {
            // dd($e->getMessage());
            return response()->json($this->res_insert("fatal"));
        }
    }
}
