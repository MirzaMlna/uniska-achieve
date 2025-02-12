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
                <table class="w-full border-collapse border border-gray-300 dark:border-gray-600">
                    <thead>
                        <tr class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-white text-start">
                            <th class="border border-gray-300 px-4 py-2 text-start">NIM</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Nama</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Role</th>
                            <th class="border border-gray-300 px-4 py-2 text-center">Verifikasi</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Mendaftar Pada</th>
                            <th class="border border-gray-300 px-4 py-2 text-start">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="text-gray-800 dark:text-gray-200">
                                <td class="border border-gray-300 px-4 py-2">{{ $user->nim }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ $user->name }}</td>
                                <td class="border border-gray-300 px-4 py-2">{{ ucfirst($user->role) }}</td>
                                <td class="border border-gray-300 px-4 py-2 text-center">
                                    @if ($user->is_approved)
                                        <span class="px-3 py-1 text-white rounded-lg">✅</span>
                                    @else
                                        <span class="px-3 py-1 text-white rounded-lg">❌</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $user->created_at->translatedFormat('l, d-m-Y; H:i') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    <div class="flex items-center space-x-2">
                                        <form action="{{ route('user.verify', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit"
                                                class="{{ $user->is_approved ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white py-1 px-3 rounded-lg">
                                                {{ $user->is_approved ? 'Hapus Verifikasi' : 'Verifikasi' }}
                                            </button>
                                        </form>
                                        <button onclick="confirmDelete({{ $user->id }})"
                                            class="px-3 py-2 bg-red-500 text-white rounded-lg hover:bg-red-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                                            </svg>
                                        </button>
                                        <form id="delete-form-{{ $user->id }}"
                                            action="{{ route('user.destroy', $user->id) }}" method="POST"
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
