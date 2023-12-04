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
        Schema::create('jadwal_armadas', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->unsignedBigInteger('bis_id');
            $table->unsignedBigInteger('posisi_id');
            $table->unsignedBigInteger('pemesanan_id')->nullable();
            $table->string('keterangan')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->timestamps();

            $table->foreign('bis_id')->references('id')->on('bis');
            $table->foreign('posisi_id')->references('id')->on('posisis');
            $table->foreign('pemesanan_id')->references('id')->on('pemesanans');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_armadas');
    }
};
