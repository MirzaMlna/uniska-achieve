<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:10', 'unique:' . User::class],
            'study_program' => ['required', 'string'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // dd($request->all());

        $user = User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'study_program' => $request->study_program,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect(route('login', absolute: false))->with('status', 'Akun berhasil didaftarkan! Harap tunggu verifikasi dari admin sebelum bisa masuk.');
    }
}
