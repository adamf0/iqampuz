<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Panel;
use App\Models\PanelMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PanelMenuController extends Controller
{
    public function getAvailableMenus(Request $request){
        $panel_menu = PanelMenu::select('id_menu');
        if($request->has('id_panel')) $panel_menu->where('id_panel',$request->id_panel)->get();

        $datas = Menu::whereNotIn('id_menu',$panel_menu)->get();
        return response()->json($datas);
    }
    public function index(){
        return view('panel_menu/index',['datas'=>PanelMenu::with(['panel','menu'])->get()]);
    }
    public function create(){
        return view('panel_menu/add',["panels"=>Panel::all()]);
    }
    public function edit($id){
        $panel_menu = PanelMenu::with(['panel','menu'])->where('id_menu_panel',$id)->firstOrFail();
        return view('panel_menu/edit',["panels"=>Panel::all(),"data"=>$panel_menu]);
    }
    public function store(Request $request){
        $validasi = Validator::make($request->all(), [
            'id_panel'      => 'required',
            'id_menu'       => 'required',
            'to_menu'       =>'required'
        ]);

        if($validasi->fails()){
            return Redirect::back()->withErrors($validasi);
        }
        $update = DB::table('m_panel_menu')->insert($request->only('id_panel','id_menu','to_menu'));
        
        if($update){
            return redirect("panel_menu")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
    public function update($id, Request $request){
        $validasi = Validator::make($request->all(), [
            'id_panel'      => 'required',
            'id_menu'       => 'required',
            // 'id_menu'       => 'required|array|min:1',
            // 'id_menu.*.'    => 'required|string|min:1',
            'to_menu'       =>'required'
        ]);

        if($validasi->fails()){
            return Redirect::back()->withErrors($validasi);
        }

        $update = DB::table('m_panel_menu')->where('id_menu_panel',$id)->update($request->only('id_panel','id_menu','to_menu'));
        if($update){
            return redirect("panel_menu")->with(['msg' => 'berhasil ubah']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal ubah']);
        }
    }
    public function destroy($id){
        $delete = DB::table('m_panel_menu')->where('id_menu_panel',$id)->delete();
        if($delete){
            return redirect("panel_menu")->with(['msg' => 'berhasil hapus']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal hapus']);
        }
    }
}
