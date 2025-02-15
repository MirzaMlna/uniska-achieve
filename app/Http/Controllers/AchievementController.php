<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $achievements = Achievement::where('student_id', auth()->id())->get();
        return view('achievement.index', compact('achievements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('achievement.achievement-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'achievement_type' => 'required|string',
            'achievement_level' => 'required|string',
            'participation_type' => 'required|string',
            'execution_model' => 'required|string',
            'event_name' => 'required|string|max:255',
            'participant_count' => 'required|integer|min:1',
            'achievement_title' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'news_link' => 'nullable|url',
            'certificate_file' => 'nullable|file|mimes:pdf|max:5120',
            'award_photo_file' => 'nullable|file|mimes:jpg,jpeg,png|max:5120',
            'student_assignment_letter' => 'nullable|file|mimes:pdf|max:5120',
            'supervisor_assignment_letter' => 'nullable|file|mimes:pdf|max:5120',
        ]);

        // Tambahkan student_id dari user yang login
        $validatedData['student_id'] = auth()->id();

        // Upload file ke storage/app/public/
        if ($request->hasFile('certificate_file')) {
            $validatedData['certificate_file'] = $request->file('certificate_file')->store('certificates', 'public');
        }
        if ($request->hasFile('award_photo_file')) {
            $validatedData['award_photo_file'] = $request->file('award_photo_file')->store('awards', 'public');
        }
        if ($request->hasFile('student_assignment_letter')) {
            $validatedData['student_assignment_letter'] = $request->file('student_assignment_letter')->store('assignment_letters', 'public');
        }
        if ($request->hasFile('supervisor_assignment_letter')) {
            $validatedData['supervisor_assignment_letter'] = $request->file('supervisor_assignment_letter')->store('assignment_letters', 'public');
        }


        // Simpan data ke database
        Achievement::create($validatedData);

        return redirect()->route('achievements.create')->with('success', 'Prestasi berhasil ditambahkan!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
