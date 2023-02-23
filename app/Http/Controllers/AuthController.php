<?php


namespace App\Http\Controllers;

use App\Mail\FormEmail;
use App\Models\Jurusan;
use App\Models\KomponenBiaya;
use App\Models\mahasiswa;
use App\Models\MasterKampus;
use App\Models\MasterKomponen;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use App\Traits\utility;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
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

    public function doLogin(Request $request){
        try {
            $validator = $this->validate($request, [
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            if(!$validator){
                return response()->json($this->res_insert("required"));
            }
            
            $kampus = $this->ambil_id_kampus();
            $auth = User::with(['user_role','user_role.role'])
                        ->where("email",$request->email)
                        // ->where("password",$request->password)
                        ->where("id_kampus",$kampus->id)
                        // ->where("akses",null)
                        ->firstOrFail();
            
            if (!Hash::check($request->password, $auth->password)) {
                return response()->json($this->res_insert("fatal")); 
            }
                        
            $data = JWTAuth::encode(JWTFactory::sub($auth->id)->data([
                "id"=>$auth->id,
                'id_kampus'=>$auth->master_kampus->id,
                "role"=>$auth->user_role->pluck('role.nama')
            ])->make())->get('value');
            // dd($data);

            return response()->json($this->show_data(0,0,0,0,["token"=>$data,"role"=>$auth->user_role->pluck('role.nama')]));
        } catch (Exception $e) {
            dd($e);
            // return response()->json([
            //     "error"=>$e,
            //     "data"=>$this->ambil_subdomain(),
            //     "kampus"=>json_encode($kampus)
            // ]);
            return response()->json($this->res_insert("fatal"));
        }
    }

    //auth login pmb
    public function doLoginPmb(Request $request){
        try {
            $validator = $this->validate($request, [
                'email'    => 'required|email',
                'password' => 'required',
            ]);

            if(!$validator){
                return response()->json($this->res_insert("required"));
            }
            
            $kampus = $this->ambil_id_kampus();
            //$kampus = 4;
            $auth = User::with(['user_role','user_role.role'])
                        ->where("email",$request->email)
                        // ->where("password",$request->password)
                        //->where("id_kampus",$kampus->id)
                        ->where("id_kampus",$kampus->id)
                        ->where("akses",'pmb')
                        ->firstOrFail();
            
            if (!Hash::check($request->password, $auth->password)) {
                return response()->json($this->res_insert("fatal")); 
            }
                        
            $data = JWTAuth::encode(JWTFactory::sub($auth->id)->data([
                "id"=>$auth->id,
                'id_kampus'=>$auth->master_kampus->id,
                "role"=>$auth->user_role->pluck('role.nama')
            ])->make())->get('value');
            // dd($data);

            return response()->json($this->show_data(0,0,0,0,["token"=>$data,"role"=>$auth->user_role->pluck('role.nama'),"akses"=>$auth->akses]));
        } catch (Exception $e) {
            // echo "<pre>";
            // print_r($e->getMessage());
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
          // $x = $this->ambil_subdomain();
           $x = "utn.ai.web.id";
            $data = MasterKampus::where('subdomain',$x)->firstOrFail();
            $data->foto_kampus = "http://".$_SERVER['SERVER_NAME']."/public/images/".$data->foto_kampus;
           // $data->foto_kampus = "http://dev-api.ai.web.id/index.php/public/images/".$data->foto_kampus;
            $data->foto_rektor = "http://".$_SERVER['SERVER_NAME']."/public/images/".$data->foto_rektor;
            $data->logo_kampus = "http://".$_SERVER['SERVER_NAME']."/public/images/".$data->logo_kampus;

            //$data->logo_kampus = "http://dev-api.ai.web.id/index.php/public/images/".$data->logo_kampus;
            $data->keterangan =  json_decode($data->keterangan);
            $prodi =  json_decode($data->prodi);    

            if($prodi){

                foreach($prodi as $key => $p){
                    $ex_prod = explode("|", $p);
                    $akredit[$key] = $ex_prod[0];
                   $data_prod[] = DB::table('m_jurusan')
                        ->where('kode',$ex_prod[1])  
                        ->select('id','kode','nama','jenjang','gelar','karir','komp','youtube')
                        ->get();
                }
                foreach($data_prod as $key1 => $k){
                    $data_js[] = array(
                        'id'=>$k[0]->id,
                        'kode'=>$k[0]->kode,
                        'nama'=>$k[0]->nama,
                        'jenjang'=>$k[0]->jenjang,
                        'gelar'=>$k[0]->gelar,
                        'karir'=>$k[0]->karir,
                        'komp'=>$k[0]->komp,
                        'youtube'=>$k[0]->youtube,
                        'akreditasi'=>$akredit[$key1],
                    );
                }


               //$data->prodi2 =  $akredit;
                $data->prodi =  $data_js;
            }else{
                $data->prodi = [];
            }


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

            $kampus = $this->ambil_id_kampus();
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
                'jurusan'           => 'required'
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
            $check = User::where(["email"=>$request->email,"id_kampus"=>$kampus->id])->get()->count();
            if($check){
                return response()->json($this->res_insert("unique"));
            }

            DB::transaction(function() use($request,$kampus){
                $seed = str_split('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()');
                shuffle($seed);
                $rand = '';
                foreach (array_rand($seed, 6) as $k) $rand .= $seed[$k];

                $list_no_pendaftaran = DB::select( DB::raw("select pmb_no_pendaftaran from mahasiswa where id_auth in (select id from auth where akses='pmb' and id_kampus=:id_kampus)"),array('id_kampus'=>$kampus->id) );

                $user = new User();
                $user->email = $request->email;
                $user->password = sha1(md5($rand)); //Str::random(6)
                $user->id_kampus = $kampus->id;
                // $user->nama_lengkap = $request->nama_lengkap;
                $user->akses = "pmb";
                $user->save();

                $x = Role::select('id')->where('nama','user')->firstOrFail();

                $userRole = new UserRole();
                $userRole->id_auth = $user->id;
                $userRole->id_role = $x->id;  
                $userRole->save();

                $jurusan = Jurusan::where('kode',$request->jurusan)->firstOrFail();

                $mahasiswa                      = new mahasiswa();
                $mahasiswa->id_auth             = $user->id;
                $mahasiswa->pmb_no_pendaftaran  = $this->buat_nomor($list_no_pendaftaran);
                $mahasiswa->asal_sekolah        = $request->asal_sekolah;
                $mahasiswa->id_jurusan1         = $jurusan->id;

                $mahasiswa->nama            = $request->nama_lengkap;
                $mahasiswa->jenis_kelamin   = "";
                $mahasiswa->tanggal_lahir   = null;
                $mahasiswa->tempat_lahir    = "";
                $mahasiswa->nama_ibu        = "";
                $mahasiswa->agama           = "";
                $mahasiswa->kewarganegaraan = "";
                $mahasiswa->nik             = "";
                $mahasiswa->nisn            = "";
                $mahasiswa->telp            = $request->nomor_wa;
                $mahasiswa->kelurahan       = "";
                $mahasiswa->penerima_kps    = "";
                $mahasiswa->kecamatan       = "";
                $mahasiswa->save();

                DB::table('pmb_tahapan_pendaftaran')->insert([
                    "id_auth"=>$user->id,
                    "formulir_pendaftaran"=>0,
                    "info_pembayaran"=>0,
                    "lengkapi_berkas"=>0,
                    "jadwal_uji_seleksi"=>0,
                    "info_kelulusan"=>0
                ]);
                
                $komponen = KomponenBiaya::with( ['master_komponen'=>function($query){ $query->where('nama_komponen','formulir pendaftaran'); }] )->where('id_kampus',$kampus->id)->first();
                Mail::to($request->email)->send(new FormEmail(
                    $request->nama,
                    $kampus->nama_kampus,
                    $komponen->master_komponen->nama_komponen,
                    $kampus->subdomain,
                    $request->email,
                    $rand,
                    "Rp " . number_format($komponen->biaya,0,',','.')
                ));
            });

            return response()->json($this->res_insert("sukses"));
        } catch (Exception $e) {
            // dd($e);
            // return response()->json(["kampus"=>$this->ambil_id_kampus()->id,"log"=>$e->getMessage()]);
            return response()->json($this->res_insert("fatal"));
        }
    }
    public function update_auth_user(Request $request){
        try {
            $payload = JWTAuth::parseToken()->getPayload()->get('data');
            // $user = User::where(["id"=>$payload->id,"id_kampus"=>$payload->id_kampus])->firstOrFail();
            // $kampus = $this->ambil_id_kampus();
            
            DB::transaction(function() use($request,$payload){
                $mahasiswa                    = mahasiswa::where('id_auth',$payload->id)->first();
                if($request->type=="data_mahasiswa"){
                    $validator = $this->validate($request, [
                        'nama'          => 'required',
                        'jenis_kelamin' => 'required',
                        'tanggal_lahir' => 'required',
                        'tempat_lahir'  => 'required',
                        'nama_ibu'      => 'required',
                        'agama'         => 'required',
                    ]);
        
                    if(!$validator){
                        return response()->json($this->res_insert("required"));
                    }

                    $mahasiswa->nama              = $request->nama;
                    $mahasiswa->jenis_kelamin     = $request->jenis_kelamin;
                    $mahasiswa->tanggal_lahir     = $request->tanggal_lahir;
                    $mahasiswa->tempat_lahir      = $request->tempat_lahir;
                    $mahasiswa->nama_ibu          = $request->nama_ibu;
                    $mahasiswa->agama             = $request->agama;
                    $mahasiswa->save();

                    $auth               = User::find($payload->id);
                    $auth->nama_lengkap = $request->nama;
                    $auth->save();
                }
                else if($request->type=="info_alamat_mahasiswa"){
                    $validator = $this->validate($request, [
                        'kewarganegaraan'   => 'required',
                        'nik'               => 'required',
                        'nisn'              => 'required',
                        // 'npwp'              => 'required',
                        // 'jalan'             => 'required',
                        // 'telp'              => 'required',
                        // 'dusun'             => 'required',
                        // 'rt'                => 'required',
                        // 'rw'                => 'required',
                        // 'hp'                => 'required',
                        'kelurahan'         => 'required',
                        // 'kode_pos'          => 'required',
                        'penerima_kps'      => 'required',
                        'kecamatan'         => 'required',
                        // 'jenis_tinggal'     => 'required',
                        // 'alat_transformasi' => 'required'
                    ]);
        
                    if(!$validator){
                        return response()->json($this->res_insert("required"));
                    }

                    $mahasiswa->kewarganegaraan   = $request->kewarganegaraan;
                    $mahasiswa->nik               = $request->nik;
                    $mahasiswa->nisn              = $request->nisn;
                    $mahasiswa->npwp              = $request->has('npwp')? $request->npwp:$mahasiswa->npwp;
                    $mahasiswa->jalan             = $request->has('jalan')? $request->jalan:$mahasiswa->jalan;
                    $mahasiswa->telp              = $request->has('telp')? $request->telp:$mahasiswa->telp;
                    $mahasiswa->dusun             = $request->has('dusun')? $request->dusun:$mahasiswa->dusun;
                    $mahasiswa->rt                = $request->has('rt')? $request->rt:$mahasiswa->rt;
                    $mahasiswa->rw                = $request->has('rw')? $request->rw:$mahasiswa->rw;
                    $mahasiswa->hp                = $request->has('hp')? $request->hp:$mahasiswa->hp;
                    $mahasiswa->kelurahan         = $request->kelurahan;
                    $mahasiswa->kode_pos          = $request->has('kode_pos')? $request->kode_pos:$mahasiswa->kode_pos;
                    $mahasiswa->penerima_kps      = $request->penerima_kps;
                    $mahasiswa->kecamatan         = $request->kecamatan;
                    $mahasiswa->jenis_tinggal     = $request->has('jenis_tinggal')? $request->jenis_tinggal:$mahasiswa->jenis_tinggal;
                    $mahasiswa->id_alat_transport = $request->has('id_alat_transport')? $request->id_alat_transport:$mahasiswa->id_alat_transport;
                    $mahasiswa->save();
                }
                else if($request->type=="info_ortu_mahasiswa"){
                    $mahasiswa->nik_ayah            = $request->has('nik_ayah')? $request->nik_ayah:$mahasiswa->nik_ayah;
                    $mahasiswa->nama_ayah           = $request->has('nama_ayah')? $request->nama_ayah:$mahasiswa->nama_ayah;
                    $mahasiswa->tanggal_lahir_ayah  = $request->has('tanggal_lahir_ayah')? $request->tanggal_lahir_ayah:$mahasiswa->tanggal_lahir_ayah;
                    $mahasiswa->id_jenj_didik_ayah  = $request->has('id_jenj_didik_ayah')? $request->id_jenj_didik_ayah:$mahasiswa->id_jenj_didik_ayah;
                    $mahasiswa->id_pekerjaan_ayah   = $request->has('id_pekerjaan_ayah')? $request->id_pekerjaan_ayah:$mahasiswa->id_pekerjaan_ayah;
                    $mahasiswa->id_penghasilan_ayah = $request->has('id_penghasilan_ayah')? $request->id_penghasilan_ayah:$mahasiswa->id_penghasilan_ayah;
                    $mahasiswa->nik_ibu             = $request->has('nik_ibu')? $request->nik_ibu:$mahasiswa->nik_ibu;
                    $mahasiswa->nama_ibu            = $request->has('nama_ibu')? $request->nama_ibu:$mahasiswa->nama_ibu;
                    $mahasiswa->tanggal_lahir_ibu   = $request->has('tanggal_lahir_ibu')? $request->tanggal_lahir_ibu:$mahasiswa->tanggal_lahir_ibu;
                    $mahasiswa->id_jenj_didik_ibu   = $request->has('id_jenj_didik_ibu')? $request->id_jenj_didik_ibu:$mahasiswa->id_jenj_didik_ibu;
                    $mahasiswa->id_pekerjaan_ibu    = $request->has('id_pekerjaan_ibu')? $request->id_pekerjaan_ibu:$mahasiswa->id_pekerjaan_ibu;
                    $mahasiswa->id_penghasilan_ibu  = $request->has('id_penghasilan_ibu')? $request->id_penghasilan_ibu:$mahasiswa->id_penghasilan_ibu;
                    $mahasiswa->save();
                }
                else if($request->type=="info_wali_mahasiswa"){
                    $mahasiswa->nama_wali           = $request->has('nama_wali')? $request->nama_wali:$mahasiswa->nama_wali;
                    $mahasiswa->tanggal_lahir_wali  = $request->has('tanggal_lahir_wali')? $request->tanggal_lahir_wali:$mahasiswa->tanggal_lahir_wali;
                    $mahasiswa->id_jenj_didik_wali  = $request->has('id_jenj_didik_wali')? $request->id_jenj_didik_wali:$mahasiswa->id_jenj_didik_wali;
                    $mahasiswa->id_pekerjaan_wali   = $request->has('id_pekerjaan_wali')? $request->id_pekerjaan_wali:$mahasiswa->id_pekerjaan_wali;
                    $mahasiswa->id_penghasilan_wali = $request->has('id_penghasilan_wali')? $request->id_penghasilan_wali:$mahasiswa->id_penghasilan_wali;
                    $mahasiswa->save();
                }
                else if($request->type=="info_khusus_mahasiswa"){
                    $mahasiswa->nama_wali           = $request->has('nama_wali')? $request->nama_wali:$mahasiswa->nama_wali;
                    $mahasiswa->save();
                }
                else{
                    throw new Exception();
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
