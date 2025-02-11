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
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // Foreign key ke users.id (mahasiswa)
            $table->enum('achievement_type', ['academic', 'non_academic']); // Jenis prestasi (akademik/non-akademik)
            $table->string('achievement_level', 100); // Tingkat prestasi (nasional, internasional, dll)
            $table->string('participation_type', 100); // Jenis kepesertaan (individu, tim, dll)
            $table->string('execution_model', 100); // Model pelaksanaan (online, offline, hybrid)
            $table->string('event_name', 255); // Nama kegiatan
            $table->integer('participant_count'); // Jumlah peserta
            $table->string('achievement_title', 255); // Capaian prestasi
            $table->date('start_date'); // Tanggal mulai pelaksanaan
            $table->date('end_date'); // Tanggal selesai pelaksanaan
            $table->string('news_link', 255)->nullable(); // Link berita atau sosial media
            $table->string('certificate_file', 255)->nullable(); // File sertifikat (path)
            $table->string('award_photo_file', 255)->nullable(); // Foto penyerahan penghargaan (path)
            $table->string('student_assignment_letter', 255)->nullable(); // Surat tugas mahasiswa (path)
            $table->string('supervisor_assignment_letter', 255)->nullable(); // Surat tugas dosen pembimbing (path)
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending'); // Status verifikasi prestasi
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null'); // Foreign key ke users.id (admin yang memverifikasi)
            $table->timestamp('verified_at')->nullable(); // Waktu verifikasi
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
