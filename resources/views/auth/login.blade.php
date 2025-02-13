<x-guest-layout>

    <div class="text-center text-gray-900 dark:text-white mb-5">
        <img src="{{ asset('images/uniska_logo.png') }}" alt="uniska_logo" class="w-32 h-32 mx-auto">
        <p class="text-xl">Selamat Datang di <span class="font-bold">UNISKA Achieve</span></p>
        <p class="font-light italic">Tempat untuk prestasi terbaikmu!</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4 text-center" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- NIM -->
        <div>
            <x-input-label for="nim" :value="__('NIM')" />
            <x-text-input id="nim" class="block mt-1 w-full" type="number" name="nim" :value="old('nim')"
                required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                    name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Ingat Saya') }}</span>
            </label>
        </div>

        <div class="flex items-center mt-4">
            <p class="text-white text-sm me-auto">Belum Punya akun? <span>
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                        href="{{ route('register') }}">
                        {{ __('Klik disini') }}
                    </a>
                </span>
            </p>
            <x-primary-button class="ms-auto">
                {{ __('Masuk') }}
            </x-primary-button>
        </div>

    </form>
</x-guest-layout>
