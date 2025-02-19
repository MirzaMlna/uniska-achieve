<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Data Pengguna') }}
        </h2>
    </x-slot>

    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Filter Form -->
                <form method="GET" action="{{ route('users.index') }}" class="mb-4 flex space-x-4">
                    <input type="text" name="nim" placeholder="Cari NIM" class="px-2 py-1 border rounded"
                        value="{{ request('nim') }}">
                    <input type="text" name="study_program" placeholder="Filter Program Studi"
                        class="px-2 py-1 border rounded" value="{{ request('study_program') }}">
                    <select name="is_approved" class="px-2 py-1 pr-8 border rounded appearance-none">
                        <option value="">Filter Verifikasi</option>
                        <option value="1" {{ request('is_approved') == '1' ? 'selected' : '' }}>Sudah</option>
                        <option value="0" {{ request('is_approved') == '0' ? 'selected' : '' }}>Belum</option>
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Filter</button>
                </form>

                <!-- Tabel Data Pengguna -->
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white text-start">
                            <th class="border border-gray-300 px-4 py-2 text-start">NIM</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Nama</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Program Studi</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Role</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Verifikasi</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Mendaftar Pada</th>
                            <th class="border border-gray-300 px-4 py-2 text-start" rowspan="2">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-gray-800 dark:text-gray-200">
                                <td class="border border-gray-300 px-4 py-2">{{ $user->nim }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->study_program }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($user->role) }}</td>
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
                                        <form action="{{ route('user.verify', $user->id) }}" method="POST"
                                            class="w-full">
                                            @csrf
                                            <button type="submit"
                                                class="{{ $user->is_approved ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} w-full text-white py-1 px-3 rounded-lg">
                                                {{ $user->is_approved ? 'Hapus Verifikasi' : 'Verifikasi' }}
                                            </button>
                                        </form>
                                        <button onclick="confirmDelete({{ $user->id }})"
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
                @if ($users->isEmpty())
                    <p class="text-center text-gray-500 mt-4">Tidak ada pengguna yang terdaftar.</p>
                @endif
                <!-- Pagination -->
                {{ $users->links() }}
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
