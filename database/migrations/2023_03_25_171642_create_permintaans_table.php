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
        Schema::create('permintaans', function (Blueprint $table) {
            $table->id();
            $table->string('kegiatan');
            $table->foreignId('pemohon')->constrained('users')->onDelete('cascade');
            $table->foreignId('bidang')->constrained('bidangs')->onDelete('cascade');

            $table->foreignId('manager_bidang')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('status_manager_bidang')->nullable();
            $table->timestamp('waktu_manager_bidang')->nullable();
            $table->text('alasan_manager_bidang')->nullable();

            $table->foreignId('manager_umum')->nullable()->constrained('users')->onDelete('cascade');
            $table->boolean('status_manager_umum')->nullable();
            $table->timestamp('waktu_manager_umum')->nullable();
            $table->text('alasan_manager_umum')->nullable();

            $table->boolean('selesai')->default(false);
            $table->foreignId('aktor_selesai')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamp('waktu_selesai')->nullable();

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
        Schema::dropIfExists('permintaans');
    }
};
