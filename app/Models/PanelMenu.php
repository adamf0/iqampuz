<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PanelMenu extends Model
{
    protected $table = 'm_panel_menu';
    public $timestamps = false;

    public function menu(){
        return $this->hasOne(Menu::class,'id_menu','id_menu');
    }

    public function panel(){
        return $this->hasOne(Panel::class,'id_panel','id_panel');
    }

    public function hak_akses_menu(){
        return $this->belongsTo(HakAksesMenu::class,'id_panel_menu','id_menu_panel');
    }
}
