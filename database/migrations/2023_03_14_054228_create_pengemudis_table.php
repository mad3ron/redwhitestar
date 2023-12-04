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
        Schema::create('pengemudis', function (Blueprint $table) {
            $table->id();
            $table->string('nopengemudi')->unique();
            $table->string('nik');
            $table->foreign('nik')->references('nik')->on('biodatas')->onDelete('cascade');
            $table->foreignId('rute_id')->constrained()->onDelete('cascade');
            $table->date('tgl_kp')->nullable();
            $table->string('nosim')->unique();
            $table->string('jenis_sim')->nullable();
            $table->date('tgl_sim')->nullable();
            $table->string('nojamsostek')->unique();
            $table->date('tgl_jamsos')->nullable();
            $table->string('keterangan')->nullable();
            $table->string('status')->nullable();
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
