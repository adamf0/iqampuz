<?php

namespace App\Http\Controllers;

use App\Models\MasterKomponen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MasterKomponenController extends Controller
{
    public function index(){
        return view('master_komponen.index',["datas"=>MasterKomponen::all()]);
    }
    public function create(){
        return view('master_komponen.add');
    }
    public function edit($id){
        return view('master_komponen.edit',["komponen"=>MasterKomponen::where('id_komponen',$id)->firstOrFail()]);
    }
    public function store(Request $request){
        $validasi = Validator::make($request->all(), [
            'nama_komponen' => 'required'
        ]);

        if($validasi->fails()) return Redirect::back()->withErrors($validasi);

        $master_komponen = new MasterKomponen();
        $master_komponen->nama_komponen = $request->nama_komponen;

        if($master_komponen->save()){
            return redirect("master_komponen")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
    public function update($id, Request $request){
        $validasi = Validator::make($request->all(), [
            'nama_komponen' => 'required'
        ]);

        if($validasi->fails()) return Redirect::back()->withErrors($validasi);

        $update = MasterKomponen::where('id_komponen',$id)->update($request->only('nama_komponen'));

        if($update){
            return redirect("master_komponen")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
    public function destroy($id){
        $delete = MasterKomponen::where('id_komponen',$id)->delete();
        
        if($delete){
            return redirect("master_komponen")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
}
