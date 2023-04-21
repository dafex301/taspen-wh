<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_pengadaan_lists', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('realisasi_pengadaan_id')->constrained('realisasi_pengadaans')->cascadeOnDelete();
            $table->foreignId('pengadaan_id')->constrained('pengadaans')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('realisasi_pengadaan_lists');
    }
};
