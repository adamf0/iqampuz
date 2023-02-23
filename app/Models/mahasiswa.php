<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    protected $table = 'mahasiswa';

    public function berkas_mahasiswa(){
        return $this->belongsToMany(BerkasMahasiswa::class,'id','id_mahasiswa');
    }
}
