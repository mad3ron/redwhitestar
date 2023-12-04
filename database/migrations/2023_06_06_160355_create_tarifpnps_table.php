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
        Schema::create('tarifpnps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rute_id')->constrained()->onDelete('cascade');
            $table->foreignId('poschecker_id')->constrained()->onDelete('cascade');
            $table->foreignId('kota_id')->constrained()->onDelete('cascade');
            $table->decimal('tarif', 10);
            $table->decimal('tabri', 10);
            $table->string('status');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tarifpnps');
    }
};
