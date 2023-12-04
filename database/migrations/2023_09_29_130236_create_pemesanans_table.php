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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pesan');
            $table->string('nama_pemesan');
            $table->string('phone')->nullable();
            $table->foreignId('tujuan_id')->constrained('tujuans')->onDelete('cascade');
            $table->string('harga')->nullable();
            $table->date('tgl_brkt');
            $table->date('tgl_pulang');
            $table->string('alamat')->nullable();
            $table->time('jam_jemput')->nullable();
            $table->string('jml_bis')->nullable();
            $table->string('biaya_jemput')->nullable();
            $table->foreignId('armada_id')->constrained('armadas')->onDelete('cascade');
            $table->foreignId('pool_id')->constrained('pools')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->enum('status', ['belum lunas', 'lunas']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
