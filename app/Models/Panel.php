<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Panel extends Model
{
    protected $table = 'm_panel';
    public $timestamps = false;

    public function hak_akses_panel(){
        return $this->belongsTo(HakAksesPanel::class,'id_panel','id_panel');
    }

    public function panel_menu(){
        return $this->belongsTo(Panel::class,'id_panel','id_panel');
    }
}
