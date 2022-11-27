<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    public $timestamps = false;

    public function hak_akses_menu(){
        return $this->belongsTo(HakAksesMenu::class,'id_role','id');
    }
}
