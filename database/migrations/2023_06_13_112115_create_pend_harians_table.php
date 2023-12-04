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
        Schema::create('pend_harians', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_pend')->nullable();
            $table->foreignId('rute_id')->constrained()->onDelete('cascade');
            $table->unsignedDecimal('ba', 8, 2);
            $table->unsignedDecimal('bo', 8, 2);
            $table->unsignedDecimal('setor', 8, 2);
            $table->unsignedDecimal('rit', 8, 2);
            $table->unsignedDecimal('pos1', 8, 2);
            $table->unsignedDecimal('pos2', 8, 2);
            $table->unsignedDecimal('pos3', 8, 2);
            $table->unsignedDecimal('pos4', 8, 2);
            $table->unsignedDecimal('pos5', 8, 2);
            $table->unsignedDecimal('pnpt1', 8, 2);
            $table->unsignedDecimal('pnpt2', 8, 2);
            $table->unsignedDecimal('pnpt3', 8, 2);
            $table->unsignedDecimal('pend_ops', 15, 2);
            $table->unsignedDecimal('ang_kwa', 15, 2);
            $table->unsignedDecimal('pend_bersih', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pend_harians');
    }
};
