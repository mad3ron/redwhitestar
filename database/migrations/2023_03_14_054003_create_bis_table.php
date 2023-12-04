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
        Schema::create('bis', function (Blueprint $table) {
            $table->id();
            $table->string('nobody')->unique();
            $table->string('nopolisi')->nullable();
            $table->string('nochassis')->nullable();
            $table->string('nomesin')->nullable();
            $table->foreignId('rute_id')->constrained('rutes')->onDelete('cascade');
            $table->foreignId('pool_id')->constrained('pools')->onDelete('cascade');
            $table->string('merk')->nullable();
            $table->string('tahun')->nullable();
            $table->string('jenis')->nullable();
            $table->string('seat')->nullable();
            $table->string('izintrayek')->nullable();
            $table->string('nomor_uji')->nullable();
            $table->string('tgl_stnk')->nullable();
            $table->string('tgl_kir')->nullable();
            $table->string('tgl_kps')->nullable();
            $table->string('kondisi')->nullable();
            $table->string('rasio')->nullable();
            $table->string('status_harga')->nullable();
            $table->string('status')->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bis');
    }
};
