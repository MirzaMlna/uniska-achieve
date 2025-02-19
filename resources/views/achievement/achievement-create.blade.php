<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Tambah Data Prestasi') }}
        </h2>
    </x-slot>
    @if ($errors->any())
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-md">
            <div class="flex items-center">
                <svg class="w-6 h-6 text-red-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m0 0l-2 2m0 0l-2-2"></path>
                </svg>
                <span class="font-semibold">Oops! Ada beberapa kesalahan:</span>
            </div>
            <ul class="mt-2 pl-6 list-disc text-sm">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- Form Input Prestasi --}}
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('achievements.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- Jenis Lomba -->
                    <div class="mb-4">
                        <label for="achievement_type"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                            Lomba</label>
                        <select id="achievement_type" name="achievement_type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Pilih Jenis Kegiatan</option>
                            <option value="Akademik">Akademik</option>
                            <option value="Non Akademik">Non Akademik</option>
                        </select>
                    </div>

                    <!-- Tingkat -->
                    <div class="mb-4">
                        <label for="achievement_level"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat</label>
                        <select id="achievement_level" name="achievement_level"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Pilih Tingkatan Kegiatan</option>
                            <option value="Wilayah">Wilayah</option>
                            <option value="Provinsi">Provinsi</option>
                            <option value="Nasional">Nasional</option>
                            <option value="Internasional">Internasional</option>
                        </select>
                    </div>

                    <!-- Jenis Kepesertaan -->
                    <div class="mb-4">
                        <label for="participation_type"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis
                            Kepesertaan</label>
                        <select id="participation_type" name="participation_type"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Pilih Jenis Kepesertaan</option>
                            <option value="Individu">Individu</option>
                            <option value="Kelompok">Kelompok</option>
                        </select>
                    </div>

                    <!-- Model Pelaksanaan -->
                    <div class="mb-4">
                        <label for="execution_model"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model
                            Pelaksanaan</label>
                        <select id="execution_model" name="execution_model"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Pilih Model Pelaksanaan</option>
                            <option value="Daring">Daring</option>
                            <option value="Luring">Luring</option>
                        </select>
                    </div>

                    <!-- Nama Kegiatan -->
                    <div class="mb-4">
                        <label for="event_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama
                            Kegiatan</label>
                        <input type="text" id="event_name" name="event_name"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="mb-4">
                        <label for="participant_count"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah
                            Peserta</label>
                        <input type="number" id="participant_count" name="participant_count"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Capaian Prestasi -->
                    <div class="mb-4">
                        <label for="achievement_title"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Capaian
                            Prestasi</label>
                        <select id="achievement_title" name="achievement_title"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="">Pilih Capaian Prestasi</option>
                            <option value="Juara 1">Juara 1</option>
                            <option value="Juara 2">Juara 2</option>
                            <option value="Juara 3">Juara 3</option>
                            <option value="Harapan 1">Harapan 1</option>
                            <option value="Harapan 2">Harapan 2</option>
                            <option value="Harapan 3">Harapan 3</option>
                            <option value="Peserta">Peserta</option>
                        </select>
                    </div>

                    <!-- Tanggal Mulai Pelaksanaan -->
                    <div class="mb-4">
                        <label for="start_date"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                            Mulai
                            Pelaksanaan</label>
                        <input type="date" id="start_date" name="start_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Tanggal Selesai Pelaksanaan -->
                    <div class="mb-4">
                        <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal
                            Selesai
                            Pelaksanaan</label>
                        <input type="date" id="end_date" name="end_date"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Link Berita -->
                    <div class="mb-4">
                        <label for="news_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link
                            Berita</label>
                        <input type="url" id="news_link" name="news_link"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Sertifikat (Upload) -->
                    <div class="mb-4">
                        <label for="certificate_file"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sertifikat
                            <span class="text-gray-500">.pdf</span></label>
                        <input type="file" id="certificate_file" name="certificate_file"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- photo Penyerahan Penghargaan (Upload) -->
                    <div class="mb-4">
                        <label for="award_photo_file"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto
                            Penyerahan
                            Penghargaan <span class="text-gray-500">.jpg</span></label>
                        <input type="file" id="award_photo_file" name="award_photo_file"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Surat Tugas Mahasiswa (Upload) -->
                    <div class="mb-4">
                        <label for="student_assignment_letter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surat Tugas
                            Mahasiswa <span class="text-gray-500">.pdf</span></label>
                        <input type="file" id="student_assignment_letter" name="student_assignment_letter"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Surat Tugas Dospem (Upload) -->
                    <div class="mb-4">
                        <label for="supervisor_assignment_letter"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surat Tugas
                            Dosen Pembimbing <span class="text-gray-500">.pdf</span></label>
                        <input type="file" id="supervisor_assignment_letter" name="supervisor_assignment_letter"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Tombol Submit -->
                    <div class="flex justify-end">
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
