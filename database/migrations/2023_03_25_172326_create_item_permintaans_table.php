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
        Schema::create('item_permintaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_permintaan')->constrained('permintaans')->onDelete('cascade');
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
        Schema::dropIfExists('item_permintaans');
    }
};
