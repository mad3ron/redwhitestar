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
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('nokaryawan')->unique();
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('biodatas')->onDelete('cascade');
            $table->foreignId('jabatan_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('tgl_kp')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->string('pendidikan')->nullable();
            $table->string('gol_darah')->nullable();
            $table->string('tinggi')->nullable();
            $table->string('nojamsostek')->nullable();
            $table->date('tgl_jamsos')->nullable();
            $table->string('password')->nullable();
            $table->string('status')->nullable();
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengemudis');
    }
};
