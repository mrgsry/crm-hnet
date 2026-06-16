<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Create your account</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-5">
            <label for="name" class="block mb-2 text-sm font-medium text-white">Full Name</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="Your full name">
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="name@company.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
            <input type="password" id="password" name="password" required autocomplete="new-password"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mb-6">
            <label for="password_confirmation" class="block mb-2 text-sm font-medium text-white">Confirm
                Password</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required
                autocomplete="new-password"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Submit Button -->
        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
            Create an account
        </button>
    </form>

    <div class="mt-6 text-center">
        <a href="{{ route('login') }}" class="text-sm text-blue-500 hover:underline">
            Already registered? Log in
        </a>
    </div>
</x-guest-layout>