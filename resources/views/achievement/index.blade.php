<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Prestasi Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">

                <!-- Pesan Sukses -->
                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Tombol Tambah -->
                <div class="mb-4 flex justify-between">
                    <h3 class="text-lg font-semibold text-gray-700 dark:text-gray-300">Daftar Prestasi</h3>
                    <a href="{{ route('achievements.create') }}"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        + Tambah Prestasi
                    </a>
                </div>

                <!-- Tabel Prestasi -->
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300 dark:border-gray-700">
                        <thead class="bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300">
                            <tr>
                                <th class="border border-gray-300 px-4 py-2">No</th>
                                <th class="border border-gray-300 px-4 py-2">NIM</th>
                                <th class="border border-gray-300 px-4 py-2">Nama</th>
                                <th class="border border-gray-300 px-4 py-2">Program Studi</th>
                                <th class="border border-gray-300 px-4 py-2">Jenis Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Tingkat Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Judul Prestasi</th>
                                <th class="border border-gray-300 px-4 py-2">Tanggal Kegiatan</th>
                                <th class="border border-gray-300 px-4 py-2">Status</th>
                                <th class="border border-gray-300 px-4 py-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($achievements as $key => $achievement)
                                <tr class="text-gray-900 dark:text-gray-100">
                                    <td class="border border-gray-300 px-4 py-2">{{ $loop->iteration }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->nim }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->name }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->study_program }}</td>
                                    <td class="border border-gray-300 px-4 py-2">
                                        {{ ucfirst($achievement->achievement_type) }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->achievement_level }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->achievement_title }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2">{{ $achievement->start_date }} s/d
                                        {{ $achievement->end_date }}</td>
                                    <td class="border border-gray-300 px-4 py-2">{{ ucfirst($achievement->status) }}
                                    </td>
                                    <td class="border border-gray-300 px-4 py-2 flex space-x-2">
                                        <!-- Tombol Selengkapnya -->
                                        <button onclick="openModal('modal-{{ $achievement->id }}')"
                                            class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-3 rounded">
                                            🔍 Selengkapnya
                                        </button>

                                        <!-- Tombol Edit -->
                                        <a href="{{ route('achievements.edit', $achievement->id) }}"
                                            class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-3 rounded">
                                            ✏️ Edit
                                        </a>

                                        <!-- Tombol Hapus -->
                                        <form action="{{ route('achievements.destroy', $achievement->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded">
                                                🗑️ Hapus
                                            </button>
                                        </form>
                                    </td>
                                </tr>

                                <!-- Modal untuk Detail Prestasi -->
                                <div id="modal-{{ $achievement->id }}"
                                    class="fixed inset-0 z-50 hidden overflow-y-auto">
                                    <div
                                        class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                        <!-- Overlay -->
                                        <div class="fixed inset-0 transition-opacity bg-black bg-opacity-50"
                                            aria-hidden="true"></div>

                                        <!-- Modal Content -->
                                        <div
                                            class="inline-block overflow-hidden text-left align-bottom transition-all transform bg-white rounded-lg shadow-xl sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                                            <div class="px-4 pt-5 pb-4 bg-white sm:p-6 sm:pb-4">
                                                <h3 class="text-lg font-medium leading-6 text-gray-900">Detail Prestasi
                                                </h3>
                                                <div class="mt-4 space-y-4">
                                                    <p><strong>NIM:</strong> {{ $achievement->nim }}</p>
                                                    <p><strong>Nama:</strong> {{ $achievement->name }}</p>
                                                    <p><strong>Program Studi:</strong>
                                                        {{ $achievement->study_program }}</p>
                                                    <p><strong>Jenis Prestasi:</strong>
                                                        {{ ucfirst($achievement->achievement_type) }}</p>
                                                    <p><strong>Tingkat Prestasi:</strong>
                                                        {{ $achievement->achievement_level }}</p>
                                                    <p><strong>Jenis Partisipasi:</strong>
                                                        {{ $achievement->participation_type }}</p>
                                                    <p><strong>Model Pelaksanaan:</strong>
                                                        {{ $achievement->execution_model }}</p>
                                                    <p><strong>Nama Kegiatan:</strong> {{ $achievement->event_name }}
                                                    </p>
                                                    <p><strong>Jumlah Peserta:</strong>
                                                        {{ $achievement->participant_count }}</p>
                                                    <p><strong>Judul Prestasi:</strong>
                                                        {{ $achievement->achievement_title }}</p>
                                                    <p><strong>Tanggal Mulai:</strong> {{ $achievement->start_date }}
                                                    </p>
                                                    <p><strong>Tanggal Selesai:</strong> {{ $achievement->end_date }}
                                                    </p>
                                                    <p><strong>Link Berita:</strong>
                                                        @if ($achievement->news_link)
                                                            <a href="{{ $achievement->news_link }}" target="_blank"
                                                                class="text-blue-500 hover:underline">Buka Link</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                    <p><strong>Status:</strong> {{ ucfirst($achievement->status) }}</p>
                                                    <p><strong>File Sertifikat:</strong>
                                                        @if ($achievement->certificate_file)
                                                            <a href="{{ asset('storage/' . $achievement->certificate_file) }}"
                                                                target="_blank"
                                                                class="text-blue-500 hover:underline">Unduh</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                    <p><strong>Foto Penghargaan:</strong>
                                                        @if ($achievement->award_photo_file)
                                                            <a href="{{ asset('storage/' . $achievement->award_photo_file) }}"
                                                                target="_blank"
                                                                class="text-blue-500 hover:underline">Unduh</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                    <p><strong>Surat Tugas Mahasiswa:</strong>
                                                        @if ($achievement->student_assignment_letter)
                                                            <a href="{{ asset('storage/' . $achievement->student_assignment_letter) }}"
                                                                target="_blank"
                                                                class="text-blue-500 hover:underline">Unduh</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                    <p><strong>Surat Tugas Pembimbing:</strong>
                                                        @if ($achievement->supervisor_assignment_letter)
                                                            <a href="{{ asset('storage/' . $achievement->supervisor_assignment_letter) }}"
                                                                target="_blank"
                                                                class="text-blue-500 hover:underline">Unduh</a>
                                                        @else
                                                            -
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="px-4 py-3 bg-gray-50 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <button type="button"
                                                    onclick="closeModal('modal-{{ $achievement->id }}')"
                                                    class="w-full px-4 py-2 text-base font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700 focus:outline-none sm:ml-3 sm:w-auto sm:text-sm">
                                                    Tutup
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
