<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-4 text-center">Reset your password</h2>

    <div class="mb-6 text-sm text-gray-300 text-center">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div class="mb-6">
            <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="name@company.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex flex-col gap-4 items-center justify-between">
            <button type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
                {{ __('Email Password Reset Link') }}
            </button>

            <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">
                Back to Login
            </a>
        </div>
    </form>
</x-guest-layout>