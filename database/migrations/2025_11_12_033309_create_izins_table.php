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
        Schema::create('izins', function (Blueprint $table) {
    $table->id();

    // siswa_id boleh null, karena kalau siswa dihapus => null
    $table->foreignId('siswa_id')
        ->nullable()
        ->constrained('siswas')
        ->nullOnDelete();

    // orang_tua_id boleh null juga, biar aman
    $table->foreignId('orang_tua_id')
        ->nullable()
        ->constrained('orang_tuas')
        ->nullOnDelete();

    $table->date('tanggal');
    $table->enum('jenis_izin', ['izin', 'sakit']);
    $table->text('alasan');
    $table->string('bukti')->nullable();
    $table->enum('status', ['pending', 'diizinkan', 'tidak diizinkan'])->default('pending');
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('izins');
    }
};
