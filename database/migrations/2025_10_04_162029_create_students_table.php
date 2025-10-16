<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration {
        public function up(): void
        {
                Schema::create('students', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('user_id'); // user with role 'siswa'
                $table->unsignedBigInteger('parent_id'); // user with role 'orang_tua'
                $table->unsignedBigInteger('classroom_id');
                $table->string('name');
                $table->string('nis')->nullable();
                $table->timestamps();


                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('parent_id')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('classroom_id')->references('id')->on('classrooms')->onDelete('cascade');
            });
        }


        public function down(): void
        {
            Schema::dropIfExists('students');
        }
};
