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
        Schema::create('pemesanans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('paket_id')->constrained('paket_layanans')->onDelete('cascade');
            $table->date('tanggal_pesan');
            $table->date('tanggal_pengerjaan');
            $table->enum('status_pemesanan', ['pending', 'diproses', 'selesai', 'dibatalkan'])->default('pending');
            $table->decimal('total_harga', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pemesanans');
    }
};
