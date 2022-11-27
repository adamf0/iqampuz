<?php

namespace App\Http\Controllers;

use App\Models\Panel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class PanelController extends Controller
{
    public function index(){
        return view('panel/index',['datas'=>Panel::all()]);
    }
    public function edit($id){
        $panel = Panel::where('id_panel',$id)->firstOrFail();
        return view('panel/edit',["panel"=>$panel]);
    }
    public function update($id, Request $request){
        $validasi = Validator::make($request->all(), [
            'nama_panel' => 'required',
            'status' =>'accepted'
        ]);

        if($validasi->fails()){
            return Redirect::back()->withErrors($validasi);
        }
        
        $logo = $request->file('logo');
        $update = DB::table('m_panel')->where('id_panel',$id)->update([
            'nama_panel'=>$request->nama_panel,
            'logo'=>$request->has('logo')? $logo->getClientOriginalName():$request->old_logo,
            'status'=>!$request->has('status')? 0:1
        ]);
        if($update){
            if($request->has('logo')) $logo->move('img_panel',$logo->getClientOriginalName());
            return redirect("panel")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
}
