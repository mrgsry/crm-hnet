<x-guest-layout>
    <h2 class="text-2xl font-bold text-white mb-4 text-center">Verify Email</h2>

    <div class="mb-6 text-sm text-gray-300 text-center">
        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
    <div class="mb-6 font-medium text-sm text-green-400 text-center">
        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
    </div>
    @endif

    <div class="mt-6 flex flex-col gap-4 items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf

            <button type="submit"
                class="w-full text-white bg-blue-600 hover:bg-blue-700 focus:ring-4 focus:outline-none focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition duration-150">
                {{ __('Resend Verification Email') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full text-center">
            @csrf

            <button type="submit"
                class="underline text-sm text-gray-400 hover:text-white rounded-md focus:outline-none">
                {{ __('Log Out') }}
            </button>
        </form>
    </div>
</x-guest-layout>