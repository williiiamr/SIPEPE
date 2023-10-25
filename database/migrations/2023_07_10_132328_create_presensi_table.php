<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('presensi', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('nik');
            // Trial if error please delete
            $table->foreign('nik')->references('nik')->on('karyawan')->cascadeOnDelete();
            $table->date('tgl_presensi');
            $table->time('jam_in')->nullable();
            $table->time('jam_out')->nullable();
            $table->string('foto_in')->nullable();
            $table->string('foto_out')->nullable();
            $table->text('location')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presensi');
    }
};
