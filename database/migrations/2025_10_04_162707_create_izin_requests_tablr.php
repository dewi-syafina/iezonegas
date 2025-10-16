<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
        public function up(): void
        {
                Schema::create('izin_requests', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('student_id');
                $table->unsignedBigInteger('parent_id');
                $table->unsignedBigInteger('wali_kelas_id');
                $table->text('reason');
                $table->date('start_date')->nullable();
                $table->date('end_date')->nullable();
                $table->enum('status', ['pending','approved','rejected'])->default('pending');
                $table->text('teacher_comment')->nullable();
                $table->timestamps();


                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('wali_kelas_id')->references('id')->on('users')->onDelete('cascade');
            });
        }


        public function down(): void
        {
            Schema::dropIfExists('izin_requests');
        }
};
