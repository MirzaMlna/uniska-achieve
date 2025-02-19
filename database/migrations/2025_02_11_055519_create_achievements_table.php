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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade');
            $table->string('nim', 50); // NIM mahasiswa
            $table->string('name', 255); // Nama mahasiswa
            $table->string('study_program', 255); // Program studi mahasiswa
            $table->enum('achievement_type', ['Akademik', 'Non Akademik']);
            $table->string('achievement_level', 100);
            $table->string('participation_type', 100);
            $table->string('execution_model', 100);
            $table->string('event_name', 255);
            $table->integer('participant_count');
            $table->string('achievement_title', 255);
            $table->date('start_date');
            $table->date('end_date');
            $table->string('news_link', 255)->nullable();
            $table->string('certificate_file', 255)->nullable();
            $table->string('award_photo_file', 255)->nullable();
            $table->string('student_assignment_letter', 255)->nullable();
            $table->string('supervisor_assignment_letter', 255)->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamp('verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
