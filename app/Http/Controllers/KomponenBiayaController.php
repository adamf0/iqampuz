<?php

namespace App\Http\Controllers;

use App\Models\KomponenBiaya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class KomponenBiayaController extends Controller
{
    public function index(){
        return view('komponen_biaya.index',["datas"=>KomponenBiaya::with(['master_komponen','kampus'])->get()]);
    }
    public function create(){
        return view('komponen_biaya.add');
    }
    public function edit($id){
        return view('komponen_biaya.edit',["komponen"=>KomponenBiaya::where('id_komponen_biaya',$id)->firstOrFail()]);
    }
    public function store(Request $request){
        if($request->has('biaya')){
            $request['biaya'] = str_replace('Rp', '', $request->biaya);
            $request['biaya'] = str_replace('.', '', $request->biaya);
            $request['biaya'] = str_replace(' ', '', $request->biaya);
        }
        $validasi = Validator::make($request->all(), [
            'id_kampus' => 'required',
            'biaya' => 'required|min:1',
            'id_komponen' => 'required'
        ]);

        if($validasi->fails()) return Redirect::back()->withErrors($validasi);

        $save = KomponenBiaya::insert($request->only('id_kampus','biaya','id_komponen'));
        if($save){
            return redirect("komponen_biaya")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
    public function update($id, Request $request){
        if($request->has('biaya')){
            $request['biaya'] = str_replace('Rp', '', $request->biaya);
            $request['biaya'] = str_replace('.', '', $request->biaya);
            $request['biaya'] = str_replace(' ', '', $request->biaya);
        }
        $validasi = Validator::make($request->all(), [
            'id_kampus'         => 'required',
            'biaya'             => 'required',
            'id_komponen'       => 'required'
        ]);

        if($validasi->fails()) return Redirect::back()->withErrors($validasi);

        $update = KomponenBiaya::where('id_komponen_biaya',$id)->update($request->only('id_kampus','biaya','id_komponen_biaya'));
        if($update){
            return redirect("komponen_biaya")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
    public function destroy($id){
        $delete = KomponenBiaya::where('id_komponen_biaya',$id)->delete();
        
        if($delete){
            return redirect("komponen_biaya")->with(['msg' => 'berhasil simpan']);
        }
        else{
            return Redirect::back()->withErrors(['msg' => 'gagal simpan']);
        }
    }
}
