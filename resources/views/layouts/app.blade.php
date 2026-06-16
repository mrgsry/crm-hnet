<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Title --}}
    <title>{{ config('app.name', 'Laravel') }}</title>
    <meta name="description" content="">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" type="image/png" href="{{ asset('storage/img/hnetlogo.png') }}">
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100">
        <div class="flex h-screen overflow-hidden">
            {{-- Sidebar --}}
            <aside x-data="{ open: false }"
                class="fixed inset-y-0 left-0 z-30 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 lg:static lg:inset-0"
                :class="{ '-translate-x-full': !open, 'translate-x-0': open }">
                <div class="flex flex-col h-full">
                    <!-- Logo / Brand -->
                    <div class="flex items-center gap-3 p-5 border-b border-gray-200">
                        <img src="{{ asset('storage/img/hnetlogo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        <h1 class="text-xl font-bold text-indigo-600">{{ config('app.name', 'HNet Solution CRM') }}</h1>
                        <!-- Close button for mobile -->
                        <button @click="open = false" class="lg:hidden p-2 text-gray-500 hover:text-gray-700 ml-auto">
                            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>

                    <!-- Navigation Menu -->
                    <div class="pt-4 pb-3 space-y-1 flex-grow overflow-auto">
                        <a href="{{ route('dashboard') }}"
                            class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                            {{ __('Dashboard') }}
                        </a>
                        <div class="pt-4 pb-3 border-t border-gray-200 space-y-1">
                            <!-- CRM Modules -->
                            <a href="{{ route('customers.index') }}"
                                class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('customers.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                                {{ __('Customer Management') }}
                            </a>
                            <a href="{{ route('quotations.index') }}"
                                class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('quotations.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                                {{ __('Quotation') }}
                            </a>
                            <a href="{{ route('invoices.index') }}"
                                class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('invoices.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                                {{ __('Invoice') }}
                            </a>
                            <a href="{{ route('berita-acara.index') }}"
                                class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('berita-acara.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                                {{ __('Berita Acara') }}
                            </a>
                        </div>
                        <div class="pt-4 pb-3 border-t border-gray-200 space-y-1">
                            <!-- CMS Module -->
                            <a href="{{ route('cms.index') }}"
                                class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('cms.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                                {{ __('CMS Landing Page') }}
                            </a>
                            <a href="{{ route('reports.index') }}"
                                class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('reports.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                                {{ __('Reports') }}
                            </a>
                        </div>

                        <!-- Settings -->
                        <div class="pt-4 pb-3 border-t border-gray-200 space-y-1">
                            <a href="{{ route('profile.edit') }}"
                                class="block px-5 py-2 text-sm font-medium rounded-md {{ request()->routeIs('profile.*') ? 'bg-indigo-50 text-indigo-600' : 'text-gray-700 hover:bg-indigo-50/50' }}">
                                {{ __('Profile') }}
                            </a>
                        </div>

                    </div>
                    <!-- Logout Section -->
                    <div class="p-5 border-t border-gray-200 bg-white">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit"
                                class="w-full text-left py-2 px-4 text-sm font-medium text-red-600 hover:bg-red-50/50 rounded-md">
                                {{ __('Log Out') }}
                            </button>
                        </form>
                    </div>

                </div>
            </aside>

            <!-- Main Content Area -->
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-100">
                <!-- Mobile Menu Button -->
                <div class="lg:hidden flex items-center justify-between p-4 bg-white border-b border-gray-200">
                    <div class="flex items-center gap-2">
                        <img src="{{ asset('storage/img/hnetlogo.png') }}" alt="Logo" class="w-8 h-8 object-contain">
                        <h1 class="text-xl font-bold text-indigo-600">{{ config('app.name', 'HNet Solution CRM') }}</h1>
                    </div>
                    <button @click="open = !open" class="p-2 text-gray-500 hover:text-gray-700">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>

                <div class="p-4 sm:p-6 lg:p-8">
                    @yield('content')
                </div>
            </main>
        </div>

        {{-- Mobile Sidebar Overlay --}}
        <div x-show="open" @click="open = false"
            class="fixed inset-0 z-20 bg-black/10 backdrop-blur-sm lg:hidden transition-opacity"
            x-transition:enter="transition-opacity ease-linear duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="transition-opacity ease-linear duration-300"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"></div>
    </div>

    @stack('scripts')
</body>

</html>