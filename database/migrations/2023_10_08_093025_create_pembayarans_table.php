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
        Schema::create('pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nopesan_id')->constrained('pemesanans')->onDelete('cascade');
            $table->string('nomorPembayaran')->nullable();
            $table->date('tgl_bayar');
            $table->string('kode_pembayaran')->nullable();
            $table->string('jml_bayar')->nullable();
            $table->string('discount')->nullable();
            $table->enum('jenis_bayar', ['cash', 'transfer', 'qris', 'ewalet']);
            $table->string('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayarans');
    }
};
