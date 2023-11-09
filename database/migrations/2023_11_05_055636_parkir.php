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
        Schema::create('parkir', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_polisi');
            $table->string('slug');
            $table->time('jam_masuk');
            $table->time('jam_keluar')->nullable();
            $table->date('tanggal_masuk');
            $table->date('tanggal_keluar')->nullable();
            $table->string('gambar')->nullable();
            $table->double('harga')->nullable();
            $table->foreignId('kendaraan_id');
            $table->foreignId('user_id');
            $table->enum('status',['Masuk','Keluar']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('parkir');
    }
};
