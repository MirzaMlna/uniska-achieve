<x-guest-layout>

    <x-auth-session-status class="mb-4" :status="session('status')" />
    <div class="text-center text-gray-900 dark:text-white mb-5">
        <img src="{{ asset('images/uniska_logo.png') }}" alt="uniska_logo" class="w-32 h-32 mx-auto">
        <p class="text-xl">Selamat Datang di <span class="font-bold">UNISKA Achieve</span></p>
        <p class="font-light italic">Tempat untuk prestasi terbaikmu!</p>
    </div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NIM -->
        <div class="mt-4">
            <x-input-label for="nim" :value="__('NIM')" />
            <x-text-input id="nim" class="block mt-1 w-full" type="number" name="nim" :value="old('nim')"
                required autocomplete="username" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="phone" :value="__('No. Telepon')" />
            <x-text-input id="phone" class="block mt-1 w-full" type="text" name="phone" :value="old('phone')"
                required autofocus autocomplete="phone" />
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        {{-- Study Program --}}
        <div class="mt-4">
            <label for="study_program" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                Program Studi
            </label>
            <select id="study_program" name="study_program"
                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200">
                <option value="">Pilih Program Studi</option>
                <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                <option value="Ilmu Administrasi Publik">Ilmu Administrasi Publik</option>
                <option value="Pendidikan Bahasa Inggris">Pendidikan Bahasa Inggris</option>
                <option value="Bimbingan dan Konseling">Bimbingan dan Konseling</option>
                <option value="Pendidikan Kimia">Pendidikan Kimia</option>
                <option value="Pendidikan Olahraga">Pendidikan Olahraga</option>
                <option value="Manajemen">Manajemen</option>
                <option value="Peternakan">Peternakan</option>
                <option value="Agribisnis">Agribisnis</option>
                <option value="Hukum Ekonomi Syari’ah">Hukum Ekonomi Syari’ah</option>
                <option value="Ekonomi Syari’ah">Ekonomi Syari’ah</option>
                <option value="Pendidikan Guru Madrasah Ibtidaiyah">Pendidikan Guru Madrasah Ibtidaiyah
                </option>
                <option value="Teknik Mesin">Teknik Mesin</option>
                <option value="Teknik Sipil">Teknik Sipil</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
                <option value="Teknik Industri">Teknik Industri</option>
                <option value="Kesehatan Masyarakat">Kesehatan Masyarakat</option>
                <option value="Ilmu Hukum">Ilmu Hukum</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Farmasi">Farmasi</option>
            </select>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center mt-4">
            <p class="text-white text-sm me-auto">Sudah Punya akun? <span>
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('login') }}">
                        {{ __('Klik disini') }}
                    </a>
                </span>
            </p>
            <x-primary-button class="ms-auto">
                {{ __('Buat Akun') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
