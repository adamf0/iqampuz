<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(){
        return view('menu/index',['datas'=>Menu::all()]);
    }
    public function create(){
        return view('menu/add');
    }
    public function edit($id){
        $menu = Menu::where('id_menu',$id)->firstOrFail();
        return view('menu/edit',["menu"=>$menu]);
    }
    public function store(Request $request){
        $validasi = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'posisi' => 'required|string:Kiri,Kanan,Atas',
            'status' =>'accepted'
        ]);

        if($validasi->fails()){
            return Redirect::back()->withErrors($validasi);
        }

        $update = DB::table('m_menu')->insert([
            'nama_menu'=>$request->nama_menu,
            'posisi'=>$request->posisi,
            'status'=>!$request->has('status')? 0:1
        ]);
        if($update){
            return redirect("menu")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
    public function update($id, Request $request){
        $validasi = Validator::make($request->all(), [
            'nama_menu' => 'required',
            'posisi' => 'required|string:Kiri,Kanan,Atas',
            'status' =>'accepted'
        ]);

        if($validasi->fails()){
            return Redirect::back()->withErrors($validasi);
        }

        $update = DB::table('m_menu')->where('id_menu',$id)->update([
            'nama_menu'=>$request->nama_menu,
            'posisi'=>$request->posisi,
            'status'=>!$request->has('status')? 0:1
        ]);
        if($update){
            return redirect("menu")->with(['msg' => 'berhasil ubah']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal ubah']);
        }
    }

    public function destroy($id){
        $delete = DB::table('m_menu')->where('id_menu',$id)->delete();
        if($delete){
            return redirect("menu")->with(['msg' => 'berhasil hapus']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal hapus']);
        }
    }
}
