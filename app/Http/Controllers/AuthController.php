<?php


namespace App\Http\Controllers;

use App\Models\MasterKampus;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Traits\utility;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Facades\JWTFactory;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;



class AuthController extends Controller
{
    use utility;
    protected $jwt;

    public function __construct(JWTAuth $jwt)
    {
        $this->jwt = $jwt;
    }

    // public function doLogin(Request $request){
    //     try {
    //         $validator = $this->validate($request, [
    //             'email'    => 'required|email',
    //             'password' => 'required',
    //         ]);
    //         if(!$validator){
    //             return response()->json($this->res_insert("required"));    
    //         }
            
    //         $kampus = $this->ambil_id_kampus($request->header('HTTP_FROM'));
    //         $auth = User::with(['user_role','user_role.role'])
    //                     ->where("email",$request->email)
    //                     ->where("password",$request->password)
    //                     ->where("id_kampus",$kampus->id)
    //                     ->first();
            
    //         if($auth==null){
    //             return response()->json($this->null_data());    
    //         }

    //         $data = $this->jwt->encode(JWTFactory::sub($auth->id)->data([
    //             "id"=>$auth->id,
    //             'id_kampus'=>$auth->master_kampus->id,
    //             "role"=>$auth->user_role->pluck('role.nama')
    //         ])->make())->get('value');

    //         return response()->json($this->show_data(0,0,0,0,$data));
    //     } catch (Exception $e) {
    //         dd($e->getMessage());
    //         return response()->json($this->res_insert("fatal"));
    //     }
    // }
    public function doLogin(Request $request){
        try {
            $validator = $this->validate($request, [
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            if(!$validator){
                return response()->json($this->res_insert("required"));
            }
            
            $kampus = $this->ambil_id_kampus($request->header('HTTP_FROM'));
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
            // dd($data);

            return response()->json($this->show_data(0,0,0,0,["token"=>$data,"role"=>$auth->user_role->pluck('role.nama')]));
        } catch (Exception $e) {
            // dd($e->getMessage());
            // return response()->json([
            //     "error"=>$e->getMessage(),
            //     "data"=>$this->ambil_subdomain(),
            //     "kampus"=>json_encode($kampus)
            // ]);
            return response()->json($this->res_insert("fatal"));
        }
    }

    public function decode(Request $request){
        try {
            $payload = JWTAuth::parseToken()->getPayload()->get('data');
            return response()->json($this->show_data(0,0,0,0,$payload));
        } catch (TokenExpiredException $e) {
            return response()->json($this->res_insert("token_expired"));
        } catch (TokenInvalidException $e) {
            return response()->json($this->res_insert("token_invalid"));
        } catch (JWTException $e) {
            return response()->json($this->res_insert("token_absent"));
        } catch (Exception $e) {
            return response()->json($this->res_insert("fatal"));
        }
    }
    public function init(Request $request){
        try {
            $x = $this->ambil_subdomain($request->header('HTTP_FROM'));
            $data = MasterKampus::where('kode_kampus',$x)->firstOrFail();
            $data->foto_kampus = "http://".$_SERVER['SERVER_NAME']."/public/images/".$data->foto_kampus;
            $data->foto_rektor = "http://".$_SERVER['SERVER_NAME']."/public/images/".$data->foto_rektor;
            $data->logo_kampus = "http://".$_SERVER['SERVER_NAME']."/public/images/".$data->logo_kampus;

            return response()->json($this->show_data_object($data));
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

            $kampus = $this->ambil_id_kampus($request->header('HTTP_FROM'));
            $check = User::where(["email"=>$request->email,"id_kampus"=>$kampus->id])->get()->count();
            if($check){
                return response()->json($this->res_insert("unique"));
            }

            DB::transaction(function() use($request,$kampus){
                $user = new User();
                $user->email = $request->email;
                $user->password = $request->password;
                $user->email = $request->email;
                $user->id_kampus = $kampus->id;
                $user->save();

                foreach(json_decode($request->roles,true) as $role){
                    $x = Role::select('id')->where('nama',$role)->firstOrFail();

                    $userRole = new UserRole();
                    $userRole->id_auth = $user->id;
                    $userRole->id_role = $x->id;  
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

            $kampus = $this->ambil_id_kampus($request->header('HTTP_FROM'));
            $check = User::where(["email"=>$request->email,"id_kampus"=>$kampus->id])->get()->count();
            if($check){
                return response()->json($this->res_insert("unique"));
            }

            DB::transaction(function() use($request,$kampus){
                $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()');
                shuffle($seed);
                $rand = '';
                foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];

                $user = new User();
                $user->email = $request->email;
                $user->password = $rand; //Str::random(6)
                $user->id_kampus = $kampus->id;
                $user->save();

                $x = Role::select('id')->where('nama','user')->firstOrFail();

                $userRole = new UserRole();
                $userRole->id_auth = $user->id;
                $userRole->id_role = $x->id;  
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
            $payload = JWTAuth::parseToken()->getPayload()->get('data');
            $user = User::where(["id"=>$payload->id,"id_kampus"=>$payload->id_kampus])->firstOrFail();
            $kampus = $this->ambil_id_kampus();
            
            DB::transaction(function() use($request,$kampus,$user){
                $user->email                = $request->has('email')? $request->email:$user->email;
                $user->nama_lengkap         = $request->has('nama_lengkap')? $request->nama_lengkap:$user->nama_lengkap;
                $user->email                = $request->has('email')? $request->email:$user->email;
                $user->nomor_wa             = $user->has('nomor_wa')? $user->nomor_wa:$request->nomor_wa;
                $user->asal_sekolah         = $user->has('asal_sekolah')? $user->asal_sekolah:$request->asal_sekolah;
                $user->jurusan_diminati1    = $user->has('jurusan_diminati1')? $user->jurusan_diminati1:$request->jurusan_diminati1;
                $user->foto                 = $user->has('foto')? $user->foto:$request->foto;
                if($request->has('jurusan_diminati2')){
                    $user->jurusan_diminati1 = $request->jurusan_diminati2;
                }
                $user->save();
            });

            return response()->json($this->res_insert("sukses"));
        } catch (Exception $e) {
            return response()->json($this->res_insert("fatal"));
        } catch (TokenExpiredException $e) {
            return response()->json($this->res_insert("token_expired"));
        } catch (TokenInvalidException $e) {
            return response()->json($this->res_insert("token_invalid"));
        } catch (JWTException $e) {
            return response()->json($this->res_insert("token_absent"));
        }
    }


    //
}
