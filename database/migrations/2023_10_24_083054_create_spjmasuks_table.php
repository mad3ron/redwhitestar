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
        Schema::create('spjmasuks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('nospj_id')->constrained('spjkeluars')->onDelete('cascade');
            $table->date('tgl_masuk')->nullable();
            $table->string('kmmasuk')->nullable();
            $table->unsignedDecimal('biaya_bbm', 8);
            $table->unsignedDecimal('uang_makan', 8);
            $table->unsignedDecimal('biaya_tol', 8);
            $table->unsignedDecimal('parkir', 8);
            $table->unsignedDecimal('biaya_lain', 8);
            $table->string('keterangan_spjmasuk')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('spjmasuks');
    }
};
