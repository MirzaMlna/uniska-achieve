<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Beranda') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Card Section -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                <!-- Card untuk jumlah prestasi yang user masukkan (biru) -->
                <div class="bg-blue-700 overflow-hidden shadow-sm sm:rounded-lg p-6 text-white">
                    <h3 class="text-lg font-semibold mb-2">Total Prestasi Anda</h3>
                    <p class="text-2xl font-bold">45</p> <!-- Ganti dengan data dinamis jika ada -->
                </div>
                <!-- Card untuk jumlah prestasi yang diverifikasi (hijau) -->
                <div class="bg-yellow-500 overflow-hidden shadow-sm sm:rounded-lg p-6 text-gray-800">
                    <h3 class="text-lg font-semibold mb-2">Total Prestasi Terverifikasi di Aplikasi</h3>
                    <p class="text-2xl font-bold">120</p> <!-- Ganti dengan data dinamis jika ada -->
                </div>
            </div>

            <div class="w-full">
                <a href="{{ route('achievements.create') }}" type="submit"
                    class="w-full bg-green-700 text-white px-4 py-2 rounded-md hover:bg-green-800 block text-center">
                    Tambahkan Prestasi Anda
                </a>
            </div>

        </div>
    </div>
</x-app-layout>
