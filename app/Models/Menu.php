<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $table = 'm_menu';
    public $timestamps = false;

    public function panel_menu(){
        return $this->belongsTo(Menu::class,'id_menu','id_menu');
    }
}
