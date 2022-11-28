<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Panel;
use App\Models\PanelMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ManajemenUserController extends Controller
{
    // public function getAvailableMenus(Request $request){
    //     $panel_menu = PanelMenu::select('id_menu');
    //     if($request->has('id_panel')) $panel_menu->where('id_panel',$request->id_panel)->get();

    //     $datas = Menu::whereNotIn('id_menu',$panel_menu)->get();
    //     return response()->json($datas);
    // }
    public function index(){

        $manajemen = DB::table('auth')
                    ->join('kampus', 'kampus.id', '=', 'auth.id_kampus')
                    ->join('auth_role', 'auth_role.id_auth', '=', 'auth.id')
                   ->join('role', 'role.id', '=', 'auth_role.id_role')
                    ->select('auth.id','auth.email','kampus.nama_kampus','nama as role')
                    ->get();
        
        return view('manajemen_user/index',['datas'=>$manajemen]);
    }

    function hakAkses($id){

        // echo $id;
        // die;

        $auth = DB::table('auth')
        ->where('id',$id)
        ->select('id_kampus')
        ->first();
       

        $hak_kampus = DB::table('hak_akses_kampus')
        ->join('kampus', 'kampus.id', '=', 'hak_akses_kampus.id_kampus')
        ->join('m_panel', 'm_panel.id_panel', '=', 'hak_akses_kampus.id_panel')
        ->where('hak_akses_kampus.id_kampus',$auth->id_kampus)
        ->select('m_panel.nama_panel','kampus.nama_kampus')
        ->get();

        $hak_panel = DB::table('hak_akses_panel')
        ->join('m_panel', 'm_panel.id_panel', '=', 'hak_akses_panel.id_panel')
        ->join('auth', 'auth.id', '=', 'hak_akses_panel.id_auth')
        ->join('auth_role', 'auth_role.id_auth', '=', 'hak_akses_panel.id_auth')
        ->join('role', 'role.id', '=', 'hak_akses_panel.id_role')
        ->where('hak_akses_panel.id_auth',$id)
        ->select('m_panel.nama_panel','role.nama as role','hak_akses_panel.id_hak_akses_panel')
        ->get();

        $hak_menu = DB::table('hak_akses_menu')
        ->join('kampus', 'kampus.id', '=', 'hak_akses_menu.id_kampus')
        ->join('m_panel_menu', 'm_panel_menu.id_menu_panel', '=', 'hak_akses_menu.id_panel_menu')
        ->join('m_menu', 'm_menu.id_menu', '=', 'm_panel_menu.id_menu')
        ->join('m_panel', 'm_panel.id_panel', '=', 'm_panel_menu.id_panel')
        ->where('hak_akses_menu.id_kampus',$auth->id_kampus)        
        ->select('m_panel.nama_panel','m_menu.nama_menu','m_panel_menu.to_menu')
        ->get();

      
      

        return view('manajemen_user/hakAkses',[
            'hak_kampus'=>$hak_kampus,
            'hak_panel'=>$hak_panel,
            'hak_menu'=>$hak_menu
        ]);
    }
   // public function create(){
    //     return view('panel_menu/add',["panels"=>Panel::all()]);
    // }
    // public function edit($id){
    //     $panel_menu = PanelMenu::with(['panel','menu'])->where('id_menu_panel',$id)->firstOrFail();
    //     return view('panel_menu/edit',["panels"=>Panel::all(),"data"=>$panel_menu]);
    // }
    // public function store(Request $request){
    //     $validasi = Validator::make($request->all(), [
    //         'id_panel'      => 'required',
    //         'id_menu'       => 'required',
    //         'to_menu'       =>'required'
    //     ]);

    //     if($validasi->fails()){
    //         return Redirect::back()->withErrors($validasi);
    //     }
    //     $update = DB::table('m_panel_menu')->insert($request->only('id_panel','id_menu','to_menu'));
        
    //     if($update){
    //         return redirect("panel_menu")->with(['msg' => 'berhasil simpan']);
    //     }
    //     else{
    //         return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
    //     }
    // }
    // public function update($id, Request $request){
    //     $validasi = Validator::make($request->all(), [
    //         'id_panel'      => 'required',
    //         'id_menu'       => 'required',
    //         // 'id_menu'       => 'required|array|min:1',
    //         // 'id_menu.*.'    => 'required|string|min:1',
    //         'to_menu'       =>'required'
    //     ]);

    //     if($validasi->fails()){
    //         return Redirect::back()->withErrors($validasi);
    //     }

    //     $update = DB::table('m_panel_menu')->where('id_menu_panel',$id)->update($request->only('id_panel','id_menu','to_menu'));
    //     if($update){
    //         return redirect("panel_menu")->with(['msg' => 'berhasil ubah']);
    //     }
    //     else{
    //         return Redirect::back()->withErrors(['msg' => 'gagal ubah']);
    //     }
    // }
    // public function destroy($id){
    //     $delete = DB::table('m_panel_menu')->where('id_menu_panel',$id)->delete();
    //     if($delete){
    //         return redirect("panel_menu")->with(['msg' => 'berhasil hapus']);
    //     }
    //     else{
    //         return Redirect::back()->withErrors(['msg' => 'gagal hapus']);
    //     }
    // }
}
