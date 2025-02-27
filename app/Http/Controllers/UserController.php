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
        // Validasi input request
        $request->validate([
            'nim' => 'nullable|string',
            'name' => 'nullable|string',
            'study_program' => 'nullable|string',
            'phone' => 'nullable|string',
            'role' => 'nullable|string|in:Admin,Student', // Sesuaikan dengan role yang valid
            'is_approved' => 'nullable|boolean',
            'sort' => 'nullable|in:asc,desc', // Pastikan hanya menerima 'asc' atau 'desc'
        ]);

        // Menghitung jumlah pengguna yang sudah dan belum diverifikasi
        $verifiedCount = User::where('is_approved', true)->count();
        $unverifiedCount = User::where('is_approved', false)->count();

        // Query dasar
        $query = User::query();

        // Filter berdasarkan NIM
        $query->when($request->filled('nim'), function ($q) use ($request) {
            $q->where('nim', 'like', '%' . $request->nim . '%');
        });

        // Filter berdasarkan Nama
        $query->when($request->filled('name'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->name . '%');
        });

        // Filter berdasarkan program studi
        $query->when($request->filled('study_program'), function ($q) use ($request) {
            $q->where('study_program', 'like', '%' . $request->study_program . '%');
        });

        // Filter berdasarkan Role
        $query->when($request->filled('role'), function ($q) use ($request) {
            $q->where('role', $request->role);
        });

        // Filter berdasarkan status verifikasi
        $query->when($request->filled('is_approved'), function ($q) use ($request) {
            $q->where('is_approved', $request->is_approved);
        });

        // Sorting berdasarkan tanggal mendaftar
        $sortOrder = $request->get('sort', 'desc'); // Default ke descending
        $query->orderBy('created_at', $sortOrder);

        // Mengambil data pengguna dengan hasil filter dan sorting
        $users = $query->paginate(10);

        // Mengirim data ke view
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
        if ($user->delete()) {
            return redirect()->route('users.index')->with('success', 'Pengguna berhasil dihapus.');
        } else {
            return redirect()->route('users.index')->with('error', 'Gagal menghapus pengguna.');
        }
    }

    /**
     * Mengubah status verifikasi pengguna.
     */
    public function verify($id)
    {
        $user = User::findOrFail($id);
        // dd(vars: $user); // Debugging sebelum update

        $user->update([
            'is_approved' => !$user->is_approved,
        ]);

        return redirect()->route('users.index')->with('success', 'Status verifikasi berhasil diperbarui.');
    }
}
