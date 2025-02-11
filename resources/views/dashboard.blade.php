<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Section -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                <!-- Card untuk jumlah prestasi yang user masukkan (biru) -->
                <div class="bg-blue-700 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Total Prestasi Anda</h3>
                    <p class="text-2xl font-bold">45</p> <!-- Ganti dengan data dinamis jika ada -->
                </div>
                <!-- Card untuk jumlah prestasi yang diverifikasi (hijau) -->
                <div class="bg-green-700 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Total Prestasi Diverifikasi</h3>
                    <p class="text-2xl font-bold">120</p> <!-- Ganti dengan data dinamis jika ada -->
                </div>
                <!-- Card untuk jumlah prestasi yang belum diverifikasi (kuning) -->
                <div class="bg-yellow-700 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Total Prestasi Belum Diverifikasi</h3>
                    <p class="text-2xl font-bold">20</p> <!-- Ganti dengan data dinamis jika ada -->
                </div>
            </div>

            <!-- Form Input Prestasi -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4 text-gray-800 dark:text-gray-200">Tambah Prestasi</h3>
                <form>
                    <!-- Nama Mahasiswa -->
                    <div class="mb-4">
                        <label for="nama_mahasiswa"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Mahasiswa</label>
                        <input type="text" id="nama_mahasiswa" name="nama_mahasiswa"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- NIM -->
                    <div class="mb-4">
                        <label for="nim"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">NIM</label>
                        <input type="number" id="nim" name="nim"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Program Studi -->
                    <div class="mb-4">
                        <label for="program_studi"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Program Studi <span
                                class="text-gray-500">(Contoh : Teknik Informatika)</span></label>
                        <input type="text" id="program_studi" name="program_studi"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Jenis Prestasi -->
                    <div class="mb-4">
                        <label for="jenis_prestasi"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Prestasi</label>
                        <input type="text" id="jenis_prestasi" name="jenis_prestasi"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Jenis Lomba -->
                    <div class="mb-4">
                        <label for="jenis_lomba"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Lomba</label>
                        <select id="jenis_lomba" name="jenis_lomba"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="akademik">Akademik</option>
                            <option value="non_akademik">Non Akademik</option>
                        </select>
                    </div>

                    <!-- Tingkat -->
                    <div class="mb-4">
                        <label for="tingkat"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tingkat</label>
                        <select id="tingkat" name="tingkat"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="provinsi">Provinsi</option>
                            <option value="nasional">Nasional</option>
                            <option value="internasional">Internasional</option>
                        </select>
                    </div>

                    <!-- Jenis Kepesertaan -->
                    <div class="mb-4">
                        <label for="jenis_kepesertaan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jenis Kepesertaan</label>
                        <select id="jenis_kepesertaan" name="jenis_kepesertaan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="individu">Individu</option>
                            <option value="kelompok">Kelompok</option>
                        </select>
                    </div>

                    <!-- Model Pelaksanaan -->
                    <div class="mb-4">
                        <label for="model_pelaksanaan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Model Pelaksanaan</label>
                        <select id="model_pelaksanaan" name="model_pelaksanaan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="daring">Daring</option>
                            <option value="luring">Luring</option>
                        </select>
                    </div>

                    <!-- Nama Kegiatan -->
                    <div class="mb-4">
                        <label for="nama_kegiatan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nama Kegiatan</label>
                        <input type="text" id="nama_kegiatan" name="nama_kegiatan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Jumlah Peserta -->
                    <div class="mb-4">
                        <label for="jumlah_peserta"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Jumlah Peserta</label>
                        <input type="number" id="jumlah_peserta" name="jumlah_peserta"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Capaian Prestasi -->
                    <div class="mb-4">
                        <label for="capaian_prestasi"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Capaian Prestasi</label>
                        <select id="capaian_prestasi" name="capaian_prestasi"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                            <option value="juara1">Juara 1</option>
                            <option value="juara2">Juara 2</option>
                            <option value="juara3">Juara 3</option>
                            <option value="harapan1">Harapan 1</option>
                            <option value="harapan2">Harapan 2</option>
                            <option value="harapan3">Harapan 3</option>
                            <option value="peserta">Peserta</option>
                        </select>
                    </div>

                    <!-- Tanggal Mulai Pelaksanaan -->
                    <div class="mb-4">
                        <label for="tanggal_mulai"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Mulai
                            Pelaksanaan</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Tanggal Selesai Pelaksanaan -->
                    <div class="mb-4">
                        <label for="tanggal_selesai"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Tanggal Selesai
                            Pelaksanaan</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Link Berita -->
                    <div class="mb-4">
                        <label for="link_berita"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Link Berita</label>
                        <input type="url" id="link_berita" name="link_berita"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Sertifikat (Upload) -->
                    <div class="mb-4">
                        <label for="sertifikat"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sertifikat <span
                                class="text-gray-500">.pdf</span></label>
                        <input type="file" id="sertifikat" name="sertifikat"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Foto Penyerahan Penghargaan (Upload) -->
                    <div class="mb-4">
                        <label for="foto_penyerahan"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Foto Penyerahan
                            Penghargaan <span class="text-gray-500">.jpg</span></label>
                        <input type="file" id="foto_penyerahan" name="foto_penyerahan"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Surat Tugas Mahasiswa (Upload) -->
                    <div class="mb-4">
                        <label for="surat_tugas_mahasiswa"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surat Tugas
                            Mahasiswa <span class="text-gray-500">.pdf</span></label>
                        <input type="file" id="surat_tugas_mahasiswa" name="surat_tugas_mahasiswa"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                    </div>

                    <!-- Surat Tugas Dospem (Upload) -->
                    <div class="mb-4">
                        <label for="surat_tugas_dospem"
                            class="block text-sm font-medium text-gray-700 dark:text-gray-300">Surat Tugas
                            Dospem <span class="text-gray-500">.pdf</span></label>
                        <input type="file" id="surat_tugas_dospem" name="surat_tugas_dospem"
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

{{-- <div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                {{ __('Selamat Datang! ') }}
            </div>
        </div>
    </div>
</div> --}}
