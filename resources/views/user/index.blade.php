<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Pengguna') }}
        </h2>
    </x-slot>

    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <div class="py-6">
        <div class="sm:px-6 lg:px-8">
            <!-- Card Statistik Verifikasi -->
            <div class="flex space-x-4 mb-6">
                <div class="flex-1 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                    <div class="text-green-600 text-lg font-semibold">Diverifikasi</div>
                    <div class="text-gray-900 dark:text-gray-100 text-2xl font-bold">{{ $verifiedCount }}</div>
                </div>
                <div class="flex-1 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                    <div class="text-red-400 text-lg font-semibold">Belum Diverifikasi</div>
                    <div class="text-gray-900 dark:text-gray-100 text-2xl font-bold">{{ $unverifiedCount }}</div>
                </div>
            </div>

            <div class="">
                <a href="{{ route('users.create') }}"
                    class="bg-blue-700 hover:bg-blue-900 text-white font-bold py-2 px-4 rounded w-full block text-center">
                    Tambahkan Admin
                </a>
            </div>


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6 mt-6">
                <!-- Tabel Data Pengguna dengan Filter -->
                <div class="overflow-x-auto">
                    <form method="GET" action="{{ route('users.index') }}">
                        <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                            <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white">
                                <tr>
                                    <th class="border px-4 py-2 text-start">NIM</th>
                                    <th class="border px-4 py-2 text-start">Nama</th>
                                    <th class="border px-4 py-2 text-start">Program Studi</th>
                                    <th class="border px-4 py-2 text-start">Sebagai</th>
                                    <th class="border px-4 py-2 text-start">No.Telp</th>
                                    <th class="border px-4 py-2 text-center">Verifikasi</th>
                                    <th class="border px-4 py-2 text-start">Mendaftar Pada</th>
                                    <th class="border px-4 py-2 text-start">Aksi</th>
                                </tr>
                                <!-- Baris Filter -->
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                        <input type="text" name="nim" placeholder="Filter NIM"
                                            class="w-full px-2 py-1 border rounded" value="{{ request('nim') }}">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                        <input type="text" name="name" placeholder="Filter Nama"
                                            class="w-full px-2 py-1 border rounded" value="{{ request('name') }}">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                        <input type="text" name="study_program" placeholder="Filter Prodi"
                                            class="w-full px-2 py-1 border rounded"
                                            value="{{ request('study_program') }}">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700 ">
                                        <select name="role"
                                            class="w-full px-2 py-1 pr-8 border rounded appearance-none">
                                            <option value="">Semua</option>
                                            <option value="Admin" {{ request('role') == 'Admin' ? 'selected' : '' }}>
                                                Admin</option>
                                            <option value="Student"
                                                {{ request('role') == 'Student' ? 'selected' : '' }}>Mahasiswa</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                        <input type="text" name="phone" placeholder="Filter No.Telp"
                                            class="w-full px-2 py-1 border rounded" value="{{ request('phone') }}">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700">
                                        <select name="is_approved"
                                            class="w-full px-2 py-1 pr-8 border rounded appearance-none">
                                            <option value="">Semua</option>
                                            <option value="1"
                                                {{ request('is_approved') == '1' ? 'selected' : '' }}>Sudah</option>
                                            <option value="0"
                                                {{ request('is_approved') == '0' ? 'selected' : '' }}>Belum</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-700 text-center">
                                        <a href="{{ route('users.index', array_merge(request()->query(), ['sort' => request('sort') == 'asc' ? 'desc' : 'asc'])) }}"
                                            class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-700">
                                            @if (request('sort') == 'asc')
                                                Terbaru
                                            @else
                                                Terdahulu
                                            @endif
                                        </a>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded w-full">
                                            Filter
                                        </button>
                                        <a href="{{ route('users.index') }}"
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded w-full block mt-1 text-center">
                                            Reset
                                        </a>
                                    </td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr class="text-gray-800 dark:text-gray-200">
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->nim }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $user->study_program }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($user->role) }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($user->phone) }}</td>
                                        <td class="border border-gray-300 px-4 py-2 text-center">
                                            @if ($user->is_approved)
                                                <span class="px-3 py-1 text-green-500 rounded-lg">Sudah</span>
                                            @else
                                                <span class="px-3 py-1 text-red-500 rounded-lg">Belum</span>
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ $user->created_at->translatedFormat('d F Y') }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2 flex items-end justify-end">
                                            <div class="flex flex-col items-center space-y-2 w-full">
                                                <form action=""></form>
                                                <form action="{{ route('user.verify', $user->id) }}" method="POST"
                                                    class="w-full">
                                                    @csrf
                                                    <button type="submit"
                                                        class="{{ $user->is_approved ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} w-full text-white py-1 px-3 rounded-lg">
                                                        {{ $user->is_approved ? 'Hapus Verifikasi' : 'Verifikasi' }}
                                                    </button>
                                                </form>
                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>

                                                <button type="button" onclick="confirmDelete({{ $user->id }})"
                                                    class="w-full px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                                                    Hapus
                                                </button>

                                                <form id="delete-form-{{ $user->id }}"
                                                    action="{{ route('users.destroy', $user->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                </div>

                @if ($users->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif

                <!-- Pagination -->
                <div class="mt-5">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(userId) {
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data yang dihapus tidak bisa dikembalikan!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#d33",
                cancelButtonColor: "#3085d6",
                confirmButtonText: "Ya, Hapus!",
                cancelButtonText: "Batal"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('delete-form-' + userId).submit();
                }
            });
        }
    </script>
</x-app-layout>
