<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('izins', function (Blueprint $table) {
            $table->id();

            // Relasi ke siswa
            $table->foreignId('siswa_id')
                  ->constrained('siswas')
                  ->onDelete('cascade');

            // Relasi ke orang tua
                  $table->unsignedBigInteger('parent_id')->nullable();
                  $table->foreign('parent_id')->references('id')->on('orangtuas')->onDelete('cascade');


            // Detail izin
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->enum('jenis_izin', ['ijin', 'sakit', 'dispensasi']);
            $table->text('alasan');
            $table->string('bukti_foto')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('izins');
    }
};
