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
        Schema::create('buschecks', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_bischeck');
            $table->unsignedBigInteger('nokar_id');
            $table->unsignedBigInteger('bis_id');
            $table->unsignedBigInteger('posisi_id');
            $table->string('password')->nullable();
            $table->string('ket_posisi');
            $table->timestamps();

            $table->foreign('nokar_id')->references('id')->on('karyawans')->onDelete('cascade');
            $table->foreign('bis_id')->references('id')->on('bis')->onDelete('cascade');
            $table->foreign('posisi_id')->references('id')->on('posisis')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bischecks', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['nokar_id']);

            // Hapus kolom password
            $table->dropColumn('password');
        });
    }
};
