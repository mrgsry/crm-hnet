<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-4 text-center">Confirm Password</h2>

    <div class="mb-6 text-sm text-gray-300 text-center">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="mb-6">
            <label for="password" class="block mb-2 text-sm font-medium text-white">Password</label>
            <input type="password" id="password" name="password" required autocomplete="current-password"
                class="bg-gray-700 border border-gray-600 text-white text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 placeholder-gray-400 focus:outline-none"
                placeholder="••••••••">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <button type="submit"
            class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
            Confirm Password
        </button>
    </form>
</x-guest-layout>