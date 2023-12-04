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
        Schema::create('checkbis', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_checkbis');
            $table->string('password');
            $table->foreignId('userapp_id')->constrained('userapps')->onDelete('cascade');
            $table->foreignId('bis_id')->constrained('bis')->onDelete('cascade');
            $table->foreignId('posisi_id')->constrained('posisis')->onDelete('cascade');
            $table->string('ket_posisi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkbis');
    }
};
