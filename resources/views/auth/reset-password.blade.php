<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-6 text-center">Reset Password</h2>

    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div class="mb-5">
            <label for="email" class="block mb-2 text-sm font-medium text-white">Your email</label>
            <input type="email" id="email" name="email" value="{{ old('email', $request->email) }}" required autofocus
                autocomplete="username"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none">
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

        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
            Reset Password
        </button>
    </form>
</x-guest-layout>