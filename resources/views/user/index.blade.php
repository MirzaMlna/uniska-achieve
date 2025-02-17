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
                                        <span class="px-3 py-1 bg-green-700 text-white rounded-lg">Sudah</span>
                                    @else
                                        <span class="px-3 py-1 bg-red-700 text-white rounded-lg">Belum</span>
                                    @endif
                                </td>
                                <td class="border border-gray-300 px-4 py-2">
                                    {{ $user->created_at->translatedFormat('d F Y') }}
                                </td>
                                <td class="border border-gray-300 px-4 py-2  flex items-end justify-end">
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

        document.addEventListener("DOMContentLoaded", function() {
            const rowsPerPage = 10;
            let currentPage = 1;
            const table = document.querySelector("table tbody");
            const rows = Array.from(table.querySelectorAll("tr"));
            const totalRows = rows.length;
            const totalPages = Math.ceil(totalRows / rowsPerPage);

            function showPage(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                rows.forEach((row, index) => {
                    row.style.display = index >= start && index < end ? "table-row" : "none";
                });
            }

            function createPagination() {
                const paginationContainer = document.createElement("div");
                paginationContainer.className = "mt-4 flex justify-end space-x-2";
                paginationContainer.id = "pagination";

                for (let i = 1; i <= totalPages; i++) {
                    const button = document.createElement("button");
                    button.className = "px-3 py-1 bg-blue-500 text-white rounded-lg hover:bg-blue-700";
                    button.innerText = i;
                    button.addEventListener("click", function() {
                        currentPage = i;
                        showPage(currentPage);
                    });
                    paginationContainer.appendChild(button);
                }

                // Menambahkan pagination setelah tabel
                document.querySelector("table").after(paginationContainer);
            }

            function setupFilters() {
                const thead = document.querySelector("table thead");
                const filterRow = document.createElement("tr");

                thead.querySelectorAll("th").forEach((th, colIndex) => {
                    const filterCell = document.createElement("td");
                    if (colIndex !== 6) { // Kolom "Aksi" tidak difilter
                        const input = document.createElement("input");
                        input.type = "text";
                        input.placeholder = "Filter...";
                        input.className = "px-2 py-1 border rounded w-full text-gray-800";

                        input.addEventListener("keyup", function() {
                            const filterValue = input.value.toLowerCase();
                            rows.forEach(row => {
                                const cell = row.cells[colIndex];
                                if (cell) {
                                    row.style.display = cell.textContent.toLowerCase()
                                        .includes(filterValue) ? "table-row" : "none";
                                }
                            });
                        });

                        filterCell.appendChild(input);
                    }
                    filterRow.appendChild(filterCell);
                });

                thead.appendChild(filterRow);
            }

            showPage(currentPage);
            createPagination();
            setupFilters();
        });
    </script>

</x-app-layout>
