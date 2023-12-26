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
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('kode')->unique()->nullable();
            $table->string('nama');
            $table->integer('stok_bidang_layanan')->default(0);
            $table->integer('stok_bidang_keuangan')->default(0);
            $table->integer('stok_bidang_umum')->default(0);
            $table->integer('stok_bidang_pensiun')->default(0);
            $table->integer('harga')->default(0);
            $table->foreignId('kategori');
            $table->foreignId('satuan');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
