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
        Schema::create('spjkeluars', function (Blueprint $table) {
            $table->id();
            $table->string('nomorspj');
            $table->date('tgl_klr')->nullable();
            $table->foreignId('nopesan_id')->constrained('pemesanans')->onDelete('restrict');
            $table->foreignId('posisi_id')->constrained('posisis')->onDelete('cascade');
            $table->foreignId('bis_id')->constrained('bis')->onDelete('cascade');
            $table->string('nopolisi')->nullable();
            $table->foreignId('rute_id')->constrained('rutes')->onDelete('cascade');
            $table->foreignId('pool_id')->constrained('pools')->onDelete('cascade');
            $table->foreignId('nopengemudi_id')->constrained('pengemudis')->onDelete('cascade');
            $table->foreignId('nokondektur_id')->constrained('kondekturs')->onDelete('cascade');
            $table->string('uang_jalan')->nullable();
            $table->string('kmkeluar')->nullable();
            $table->string('keterangan_spjklr')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spjkeluars');
    }
};
