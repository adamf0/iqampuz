<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HakAksesMenu extends Model
{
    protected $table = 'hak_akses_menu';
    public $timestamps = false;

    public function kampus(){
        return $this->hasOne(Kampus::class,'id','id_kampus');
    }
    public function role(){
        return $this->hasOne(Role::class,'id','id_role');
    }
    public function panel_menu(){
        return $this->hasOne(PanelMenu::class,'id_menu_panel','id_panel_menu');
    }
}
