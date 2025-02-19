<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Prestasi Anda') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            @if (Auth::user()->role === 'admin')
                <div class="flex space-x-4 mb-6">
                    <!-- Diverifikasi -->
                    <div class="flex-1 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <div class="text-green-600 text-lg font-semibold">Diverifikasi</div>
                        <div class="text-gray-900 dark:text-gray-100 text-2xl font-bold">{{ $verifiedCount }}</div>
                    </div>

                    <!-- Pending -->
                    <div class="flex-1 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <div class="text-yellow-400 text-lg font-semibold">Pending</div>
                        <div class="text-gray-900 dark:text-gray-100 text-2xl font-bold">{{ $pendingCount }}</div>
                    </div>

                    <!-- Ditolak -->
                    <div class="flex-1 bg-white dark:bg-gray-800 p-4 rounded-lg shadow-md text-center">
                        <div class="text-red-600 text-lg font-semibold">Ditolak</div>
                        <div class="text-gray-900 dark:text-gray-100 text-2xl font-bold">{{ $rejectedCount }}</div>
                    </div>
                </div>
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
            @endif
            <!-- Pesan Sukses -->
            @if (session('success'))
                <div class="mb-4 text-green-600">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tombol Tambah -->
            <div class="mb-4 flex justify-between">
                <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Daftar Prestasi</h3>
                @if (Auth::user()->role === 'student')
                    <a href="{{ route('achievements.create') }}"
                        class="bg-green-700 hover:bg-green-900 text-white font-bold py-2 px-4 rounded">
                        + Tambah Prestasi
                    </a>
                @endif
            </div>

            <!-- Tabel Prestasi dengan Filter -->
            <div class="overflow-x-auto">
                <form action="{{ route('achievements.index') }}" method="GET">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">NIM</th>
                                <th class="border border-gray-300 px-4 py-2">Nama</th>
                                <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                                <th class="border border-gray-300 px-4 py-2">Jenis Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Tingkat Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Capaian Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Tanggal Kegiatan</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                            @if (Auth::user()->role === 'admin')
                                <!-- Baris Filter -->
                                <tr>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800"></td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <input type="text" name="filter[nim]" value="{{ request('filter.nim') }}"
                                            class="w-full px-2 py-1 border rounded" placeholder="Filter NIM">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <input type="text" name="filter[name]" value="{{ request('filter.name') }}"
                                            class="w-full px-2 py-1 border rounded" placeholder="Filter Nama">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <input type="text" name="filter[study_program]"
                                            value="{{ request('filter.study_program') }}"
                                            class="w-full px-2 py-1 border rounded" placeholder="Filter Prodi">
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <select name="filter[achievement_type]"
                                            class="px-2 py-1 pr-8 border rounded appearance-none">
                                            <option value="">Semua</option>
                                            <option value="Akademik"
                                                {{ request('filter.achievement_type') == 'Akademik' ? 'selected' : '' }}>
                                                Akademik</option>
                                            <option value="Non Akademik"
                                                {{ request('filter.achievement_type') == 'Non Akademik' ? 'selected' : '' }}>
                                                Non Akademik</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <select name="filter[achievement_level]"
                                            class="px-2 py-1 pr-8 border rounded appearance-none">
                                            <option value="">Semua</option>
                                            <option value="Internasional"
                                                {{ request('filter.achievement_level') == 'Internasional' ? 'selected' : '' }}>
                                                Internasional</option>
                                            <option value="Nasional"
                                                {{ request('filter.achievement_level') == 'Nasional' ? 'selected' : '' }}>
                                                Nasional</option>
                                            <option value="Provinsi"
                                                {{ request('filter.achievement_level') == 'Provinsi' ? 'selected' : '' }}>
                                                Provinsi</option>
                                            <option value="Wilayah"
                                                {{ request('filter.achievement_level') == 'Wilayah' ? 'selected' : '' }}>
                                                Wilayah</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <select name="filter[achievement_title]"
                                            class="px-2 py-1 pr-8 border rounded appearance-none">
                                            <option value="">Semua</option>
                                            <option value="Juara 1"
                                                {{ request('filter.achievement_title') == 'Juara 1' ? 'selected' : '' }}>
                                                Juara 1</option>
                                            <option value="Juara 2"
                                                {{ request('filter.achievement_title') == 'Juara 2' ? 'selected' : '' }}>
                                                Juara 2</option>
                                            <option value="Juara 3"
                                                {{ request('filter.achievement_title') == 'Juara 3' ? 'selected' : '' }}>
                                                Juara 3</option>
                                            <option value="Harapan 1"
                                                {{ request('filter.achievement_title') == 'Harapan 1' ? 'selected' : '' }}>
                                                Harapan 1</option>
                                            <option value="Harapan 2"
                                                {{ request('filter.achievement_title') == 'Harapan 2' ? 'selected' : '' }}>
                                                Harapan 2</option>
                                            <option value="Harapan 3"
                                                {{ request('filter.achievement_title') == 'Harapan 3' ? 'selected' : '' }}>
                                                Harapan 3</option>
                                            <option value="Peserta"
                                                {{ request('filter.achievement_title') == 'Peserta' ? 'selected' : '' }}>
                                                Peserta</option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <input type="number" name="filter[start_year]"
                                            value="{{ request('filter.start_year') }}"
                                            class="w-full px-2 py-1 border rounded" placeholder="Filter Tahun Mulai"
                                            min="2000" max="{{ date('Y') }}">
                                    </td>

                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <select name="filter[status]"
                                            class="px-2 py-1 pr-8 border rounded appearance-none">
                                            <option value="">Semua</option>
                                            <option value="pending"
                                                {{ request('filter.status') == 'pending' ? 'selected' : '' }}>
                                                Pending
                                            </option>
                                            <option value="approved"
                                                {{ request('filter.status') == 'approved' ? 'selected' : '' }}>
                                                Diverifikasi</option>
                                            <option value="rejected"
                                                {{ request('filter.status') == 'rejected' ? 'selected' : '' }}>
                                                Ditolak
                                            </option>
                                        </select>
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 text-gray-800">
                                        <button type="submit"
                                            class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-4 rounded w-full">
                                            Filter
                                        </button>
                                        <a href="{{ route('achievements.index') }}"
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-4 rounded w-full block mt-1 text-center">
                                            Reset
                                        </a>
                                    </td>
                                </tr>
                            @endif
                        </thead>
                        <tbody>
                            @forelse ($achievements as $key => $achievement)
                                <tr class="text-gray-900 dark:text-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->nim }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->study_program }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ ucfirst($achievement->achievement_type) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $achievement->achievement_level }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ $achievement->achievement_title }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ \Carbon\Carbon::parse($achievement->start_date)->translatedFormat('d F Y') }}
                                        <span class="text-gray-500">s/d</span>
                                        {{ \Carbon\Carbon::parse($achievement->end_date)->translatedFormat('d F Y') }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        @switch($achievement->status)
                                            @case('pending')
                                                <span class="text-yellow-500 font-semibold">Tunda</span>
                                            @break

                                            @case('approved')
                                                <span class="text-green-500 font-semibold">Diverifikasi</span>
                                            @break

                                            @case('rejected')
                                                <span class="text-red-500 font-semibold">Ditolak</span>
                                            @break

                                            @default
                                                <span>{{ ucfirst($achievement->status) }}</span>
                                        @endswitch
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        <div class="flex flex-col space-y-2 w-full">
                                            <!-- Tombol Selengkapnya -->
                                            <button onclick="openModal('modal-{{ $achievement->id }}')"
                                                class="bg-blue-700 hover:bg-blue-900 text-white py-1 px-3 rounded w-full">
                                                Selengkapnya
                                            </button>

                                            @if (Auth::user()->role === 'admin')
                                                <!-- Tombol Verifikasi/Tunda -->
                                                <form
                                                    action="{{ route('achievements.updateStatus', $achievement->id) }}"
                                                    method="POST" class="w-full">
                                                    @csrf
                                                    @method('PATCH')
                                                    @if ($achievement->status === 'approved')
                                                        <input type="hidden" name="status" value="pending">
                                                        <button type="submit"
                                                            class="bg-yellow-500 hover:bg-yellow-700 text-white py-1 px-3 rounded w-full">
                                                            Tunda
                                                        </button>
                                                    @else
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit"
                                                            class="bg-green-500 hover:bg-green-700 text-white py-1 px-3 rounded w-full">
                                                            Verifikasi
                                                        </button>
                                                    @endif
                                                </form>

                                                <!-- Tombol Tolak -->
                                                <form
                                                    action="{{ route('achievements.updateStatus', $achievement->id) }}"
                                                    method="POST" class="w-full">
                                                    @csrf
                                                    @method('PATCH')
                                                    <input type="hidden" name="status" value="rejected">
                                                    <button type="submit"
                                                        class="bg-red-500 hover:bg-red-700 text-white py-1 px-3 rounded w-full">
                                                        Tolak
                                                    </button>
                                                </form>
                                            @elseif (Auth::user()->role === 'student')
                                                {{-- <!-- Tombol Edit -->
                                                    <a href="{{ route('achievements.edit', $achievement->id) }}"
                                                        class="bg-yellow-500 hover:bg-yellow-700 text-black py-1 px-3 rounded text-center w-full">
                                                        Edit
                                                    </a> --}}

                                                <!-- Tombol Hapus -->
                                                <form action="{{ route('achievements.destroy', $achievement->id) }}"
                                                    method="POST" onsubmit="return confirm('Yakin ingin menghapus?')"
                                                    class="w-full">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <button type="submit"
                                                        class="bg-red-700 hover:bg-red-900 text-white py-1 px-3 rounded w-full">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td colspan="10"
                                            class="border border-gray-300 px-4 py-2 text-center text-gray-500 dark:text-gray-400">
                                            Tidak ada prestasi yang ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
        </div>

        <!-- JavaScript untuk Modal -->
        <script>
            function openModal(modalId) {
                document.getElementById(modalId).classList.remove('hidden');
            }

            function closeModal(modalId) {
                document.getElementById(modalId).classList.add('hidden');
            }
        </script>
    </x-app-layout>
