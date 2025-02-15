<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Achievement extends Model
{
    protected $fillable = [
        'student_id',
        'nim',
        'name',
        'study_program',
        'achievement_type',
        'achievement_level',
        'participation_type',
        'execution_model',
        'event_name',
        'participant_count', // Sesuaikan dengan form
        'achievement_title',
        'start_date',
        'end_date',
        'news_link',
        'certificate_file',
        'award_photo_file', // Sesuaikan dengan form
        'student_assignment_letter',
        'supervisor_assignment_letter',
        'status',
        'verified_by',
        'verified_at'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($achievement) {
            if ($achievement->student_id) {
                $student = User::find($achievement->student_id);
                if ($student) {
                    $achievement->nim = $student->nim;
                    $achievement->name = $student->name;
                    $achievement->study_program = $student->study_program;
                }
            }
        });
    }
}
