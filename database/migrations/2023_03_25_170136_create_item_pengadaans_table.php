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
        Schema::create('item_pengadaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_pengadaan')->constrained('pengadaans')->onDelete('cascade');
            $table->foreignId('id_item')->constrained('items')->onDelete('cascade');
            $table->integer('jumlah');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('item_pengadaans');
    }
};
