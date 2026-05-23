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
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('booking_id');
            $table->string('kode_booking', 20)->unique();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('layanan_id');
            $table->date('tanggal_booking');
            $table->date('tanggal_pengiriman')->nullable();
            $table->string('asal', 150);
            $table->string('tujuan', 150);
            $table->text('detail_barang')->nullable();
            $table->decimal('berat_barang', 8, 2)->nullable();
            $table->enum('status', ['Menunggu', 'Diproses', 'Dijadwalkan', 'Selesai', 'Dibatalkan'])->default('Menunggu');
            $table->timestamps();

            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('layanan_id')->references('layanan_id')->on('layanan')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
