<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan daftar pengguna.
     */
    public function index(Request $request)
    {
        // Menghitung jumlah pengguna yang sudah dan belum diverifikasi
        $verifiedCount = User::where('is_approved', true)->count();
        $unverifiedCount = User::where('is_approved', false)->count();

        $query = User::query();

        // Filter berdasarkan NIM
        if ($request->has('nim') && $request->nim != '') {
            $query->where('nim', 'like', '%' . $request->nim . '%');
        }

        // Filter berdasarkan Nama
        if ($request->has('name') && $request->name != '') {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        // Filter berdasarkan program studi
        if ($request->has('study_program') && $request->study_program != '') {
            $query->where('study_program', 'like', '%' . $request->study_program . '%');
        }

        // Filter berdasarkan Role
        if ($request->has('role') && $request->role != '') {
            $query->where('role', $request->role);
        }

        // Filter berdasarkan status verifikasi
        if ($request->has('is_approved') && $request->is_approved != '') {
            $query->where('is_approved', $request->is_approved);
        }

        // **Sorting berdasarkan tanggal mendaftar**
        $sortOrder = $request->get('sort', 'desc'); // Default ke descending
        $query->orderBy('created_at', $sortOrder);

        // Mengambil data pengguna dengan hasil filter dan sorting
        $users = $query->paginate(10);

        return view('user.index', compact('users', 'verifiedCount', 'unverifiedCount', 'sortOrder'));
    }



    /**
     * Menampilkan form tambah pengguna.
     */
    public function create()
    {
        return view('user.create');
    }

    /**
     * Menyimpan pengguna baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|unique:users,nim',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:admin,mahasiswa,dosen'
        ]);

        User::create([
            'name' => $request->name,
            'nim' => $request->nim,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'email_verified_at' => null, // Default belum diverifikasi
        ]);

        return redirect()->route('users.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan form edit pengguna.
     */
    public function edit(User $user)
    {
        return view('user.edit', compact('user'));
    }

    /**
     * Mengupdate data pengguna.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'nim' => 'required|numeric|unique:users,nim,' . $user->id,
            'role' => 'required|in:admin,mahasiswa,dosen'
        ]);

        $user->update([
            'name' => $request->name,
            'nim' => $request->nim,
            'role' => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna.
     */
    public function destroy(User $user)
    {
        $user->delete();
        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->route('users.index')->with('error', 'Gagal');
        }
    }

    /**
     * Mengubah status verifikasi pengguna.
     */
    public function verify($id)
    {
        $user = User::findOrFail($id);
        $user->update([
            'is_approved' => !$user->is_approved,
        ]);
        return redirect()->route('users.index')->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
