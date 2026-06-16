<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-6" :status="session('status')" />

    <h2 class="text-2xl font-bold text-white mb-6 text-center">Sign in to your account</h2>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                autocomplete="username"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="name@company.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
            <input type="password" id="password" name="password" required autocomplete="current-password"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me and Forgot Password -->
        <div class="flex items-center justify-between mb-6">
            <div class="flex items-center">
                <input id="remember_me" type="checkbox" name="remember"
                    class="w-4 h-4 border border-gray-600 rounded bg-gray-700 focus:ring-3 focus:ring-blue-300 focus:ring-offset-gray-800 text-blue-600">
                <label for="remember_me" class="ml-2 text-sm font-medium text-gray-300">Remember me</label>
            </div>

            <div class="text-sm">
                <a href="{{ route('password.request') }}" class="font-medium text-blue-500 hover:underline">
                    Forgot password?
                </a>
            </div>
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
            Log in to your account
        </button>
    </form>

    @if (Route::has('register'))
    <div class="mt-6 text-center">
        <a href="{{ route('register') }}" class="text-sm text-blue-500 hover:underline">
            Don't have an account?
        </a>
    </div>
    @endif
</x-guest-layout>