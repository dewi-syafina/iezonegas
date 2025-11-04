<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('nama');
            $table->string('nis')->unique();
            $table->string('email')->unique();
            $table->enum('jenis_kelamin', ['L', 'P']); // wajib isi, tidak nullable
            $table->unsignedBigInteger('kelas_id'); // wajib isi
            $table->foreign('wali_kelas_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('jurusan'); // wajib isi
            $table->timestamps();

            // Relasi ke tabel wali_kelas
            $table->foreign('wali_kelas_id')->references('id')->on('wali_kelas')->onDelete('cascade');

            // Relasi ke tabel kelas (kalau sudah ada tabel kelas)
            $table->foreign('kelas_id')->references('id')->on('kelas')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('siswas');
    }
};
