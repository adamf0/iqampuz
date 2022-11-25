<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('master_kampus', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kampus', 50);
            $table->string('kode_kampus', 10);
            $table->text('logo_kampus');
            $table->string('alamat_kampus');
            $table->text('foto_kampus');
            $table->string('profil_kampus');
            $table->string('warna_kampus', 50);
            $table->string('nama_rektor', 50);
            $table->text('foto_rektor');
            $table->date('tgl_kerjasama');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('master_kampus');
    }
};
