<?php

namespace App\Http\Controllers;

use App\Models\HakAksesMenu;
use App\Models\Menu;
use App\Models\Panel;
use App\Models\PanelMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManajemenUserController extends Controller
{
    public function index(){

        $manajemen = DB::table('auth')
                    ->join('kampus', 'kampus.id', '=', 'auth.id_kampus')
                    ->join('auth_role', 'auth_role.id_auth', '=', 'auth.id')
                   ->join('role', 'role.id', '=', 'auth_role.id_role')
                    ->select('auth.id','auth.email','kampus.nama_kampus','nama as role')
                    ->orderBy('auth.id','DESC')
                    ->get();
        
        return view('manajemen_user/index',['datas'=>$manajemen]);
    }

    function hakAkses($id){
        $auth = DB::table('auth')
        ->where('id',$id)
        ->select('id_kampus')
        ->first();
       

        $hak_kampus = DB::table('hak_akses_kampus')
        ->join('kampus', 'kampus.id', '=', 'hak_akses_kampus.id_kampus')
        ->join('m_panel', 'm_panel.id_panel', '=', 'hak_akses_kampus.id_panel')
        ->where('hak_akses_kampus.id_kampus',$auth->id_kampus)
        ->select('m_panel.nama_panel','m_panel.id_panel','kampus.nama_kampus')
        ->get();

        $hak_panel = DB::table('hak_akses_panel')
        ->join('m_panel', 'm_panel.id_panel', '=', 'hak_akses_panel.id_panel')
        ->join('auth', 'auth.id', '=', 'hak_akses_panel.id_auth')
        ->join('auth_role', 'auth_role.id_auth', '=', 'hak_akses_panel.id_auth')
        ->join('role', 'role.id', '=', 'hak_akses_panel.id_role')
        ->where('hak_akses_panel.id_auth',$id)
        ->select('m_panel.nama_panel','m_panel.id_panel','role.nama as role','hak_akses_panel.id_hak_akses_panel')
        ->get();


        $hak_akses = [];
        $hak = DB::table('hak_akses_panel')
                    ->orderBy('id_role','DESC')
                    ->get();
        foreach($hak as $s){
            $hak_akses[$s->id_panel][$s->id_auth][] = $s->id_role;
        }
        // dd($hak_akses,$hak_panel,$hak_kampus);

     

        $hak_menu = DB::table('hak_akses_menu')
        ->join('kampus', 'kampus.id', '=', 'hak_akses_menu.id_kampus')
        ->join('m_panel_menu', 'm_panel_menu.id_menu_panel', '=', 'hak_akses_menu.id_panel_menu')
        ->join('m_menu', 'm_menu.id_menu', '=', 'm_panel_menu.id_menu')
        ->join('m_panel', 'm_panel.id_panel', '=', 'm_panel_menu.id_panel')
        ->where('hak_akses_menu.id_kampus',$auth->id_kampus)        
        ->select('m_panel.id_panel','m_panel.nama_panel','m_panel_menu.id_menu','m_menu.nama_menu','m_panel_menu.to_menu')
        ->get();
        // dd($hak_menu);
         

        return view('manajemen_user/hakAkses',[
            'hak_kampus'=>$hak_kampus,
            'hak_panel'=>$hak_panel,
            'hak_menu'=>$hak_menu,
            'id_auth'=>$id,
        ]);
    }

    function tambah(){
        $kampus = DB::table('kampus')->get();
        $role = DB::table('role')->get();
       
        return view('manajemen_user/tambah',['kampus'=>$kampus,'role'=>$role]);
    }

    function insert(Request $req){
        $email = $req->email;
        $id_kampus = $req->id_kampus;
        $password = $req->password;
        $id_role = $req->id_role;

        $users =  DB::table('auth')->where('email',$email)->first();

        if($users){

				$data['status'] = 400;
				$data['message'] = "email sudah digunakan";
			}else{
				$values = array(
					'email'=>$email,
					'password'=>sha1(md5($password)),
                    'created_at'=>date('Y-m-d H:i:s'),
                    'updated_at'=>date('Y-m-d H:i:s'),
					'id_kampus'=>$id_kampus,
				);
			 $id_auth =  DB::table('auth')->insertGetId($values);


             $simpan_auth_role = array(
                'id_auth'=>$id_auth,
                'created_at'=>date('Y-m-d H:i:s'),
                'updated_at'=>date('Y-m-d H:i:s'),
                'id_role'=>$id_role,
            );

             DB::table('auth_role')->insert($simpan_auth_role);

        //    echo  "<pre>";
        //    print_r($insert);

            return redirect()->route('ManajemenUser.index');

		
            }
    }

    function update($id,Request $request){
        $update = DB::transaction(function() use($id,$request){
            $data = [];
            foreach($request->check_hak_akses_panel as $key => $val){
                foreach($val as $v){
                    array_push($data,["id_auth"=>$id,"id_role"=>$v,"id_panel"=>$key]);
                }
            }
            DB::table('hak_akses_panel')->where('id_auth',$id)->delete();
            DB::table('hak_akses_panel')->insert($data);
        });
        
        if($update){
            return redirect("ManajemenUser")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
}
