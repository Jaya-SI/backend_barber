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
        Schema::create('antrians', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('barber_id');
            $table->unsignedBigInteger('layanan_id');
            $table->integer('no_antrian');
            $table->enum('status', ['menunggu', 'diproses', 'selesai', 'lewati']);
            $table->string('tanggal');
            $table->timestamps();

            //relasi ke table user
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //relasi ke table barber
            $table->foreign('barber_id')->references('id')->on('barbers')->onDelete('cascade');

            //relasi ke table layanan
            $table->foreign('layanan_id')->references('id')->on('layanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('antrians');
    }
};
