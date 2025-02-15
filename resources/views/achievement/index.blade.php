<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Prestasi Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <!-- Tabel Prestasi -->
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-gray-700">
                        <thead>
                            <tr>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    No</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Nama Mahasiswa</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    NIM</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Program Studi</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Jenis Prestasi</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Jenis Lomba</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Tingkat</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Capaian Prestasi</th>
                                <th
                                    class="px-6 py-3 border-b-2 border-gray-300 dark:border-gray-600 text-left text-sm font-semibold text-gray-700 dark:text-gray-200">
                                    Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($prestasi as $index => $item)
                                <tr class="hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $index + 1 }}</td>
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $item->user->name }}</td>
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $item->user->nim }}</td>
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $item->user->program_studi }}</td>
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $item->jenis_prestasi }}</td>
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $item->jenis_lomba }}</td>
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $item->tingkat }}</td>
                                    <td
                                        class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm text-gray-700 dark:text-gray-200">
                                        {{ $item->capaian_prestasi }}</td>
                                    <td class="px-6 py-4 border-b border-gray-300 dark:border-gray-600 text-sm">
                                        <a href="{{ route('achievement.edit', $item->id) }}"
                                            class="text-blue-500 hover:text-blue-700">Edit</a>
                                        <form action="{{ route('achievement.destroy', $item->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="text-red-500 hover:text-red-700 ml-2">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
