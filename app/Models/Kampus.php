<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kampus extends Model
{
    protected $table = 'kampus';

    public function hak_akses_menu(){
        return $this->belongsTo(HakAksesMenu::class,'id_kampus','id');
    }
}
