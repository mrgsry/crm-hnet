<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hnet Solution - Integrated IT & Network Solutions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .glass {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .hero-slide {
        transition: opacity 1.5s ease-in-out;
    }

    .active-dot {
        width: 2rem !important;
        background-color: #2563eb !important;
    }
    </style>
</head>

<body class="bg-gray-50 text-gray-800">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 glass shadow-sm">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <div class="text-2xl font-bold text-blue-700 flex items-center">
                <i class="fas fa-network-wired mr-2"></i>
                Hnet<span class="text-gray-700">Solution</span>
            </div>
            <div class="hidden md:flex space-x-8 font-medium items-center">
                <a href="#home" class="hover:text-blue-600 transition">Beranda</a>
                <a href="#services" class="hover:text-blue-600 transition">Layanan</a>
                <a href="#packages" class="hover:text-blue-600 transition">Paket</a>
                <a href="#clients" class="hover:text-blue-600 transition">Klien</a>
                <a href="#gallery" class="hover:text-blue-600 transition">Galeri</a>
                <a href="#contact"
                    class="px-5 py-2 bg-blue-600 text-white rounded-full hover:bg-blue-700 transition shadow-md">Kontak</a>
            </div>
            <button class="md:hidden text-2xl" id="menu-btn"><i class="fas fa-bars"></i></button>
        </div>
        <div id="mobile-menu" class="hidden md:hidden bg-white border-t p-6 space-y-4 shadow-xl">
            <a href="#home" class="block hover:text-blue-600">Beranda</a>
            <a href="#services" class="block hover:text-blue-600">Layanan</a>
            <a href="#packages" class="block hover:text-blue-600">Paket</a>
            <a href="#clients" class="block hover:text-blue-600">Klien</a>
            <a href="#gallery" class="block hover:text-blue-600">Galeri</a>
            <a href="#contact" class="block text-blue-600 font-bold">Kontak Kami</a>
        </div>
    </nav>

    @php
    $hero = json_decode($pages['hero-banner']->content ?? '{}');
    $clients = json_decode($pages['clients']->content ?? '{}');
    $services = json_decode($pages['services']->content ?? '{}');
    $packages = json_decode($pages['packages']->content ?? '{}');
    $gallery = json_decode($pages['gallery']->content ?? '{}');
    $contact = json_decode($pages['contact']->content ?? '{}');
    @endphp

    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center overflow-hidden">
        <div id="slider" class="absolute inset-0 z-0">
            @if(isset($hero->slides) && count($hero->slides) > 0)
            @foreach($hero->slides as $index => $slide)
            <div class="hero-slide absolute inset-0 {{ $index === 0 ? 'opacity-100' : 'opacity-0' }} bg-cover bg-center"
                style="background-image: linear-gradient({{ $slide->overlay ?? 'rgba(0,0,0,0.5)' }}, {{ $slide->overlay ?? 'rgba(0,0,0,0.5)' }}), url('{{ $slide->image }}');">
            </div>
            @endforeach
            @else
            <div class="hero-slide absolute inset-0 opacity-100 bg-cover bg-center"
                style="background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.75)), url('https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1920&q=80');">
            </div>
            @endif
        </div>

        <div class="container mx-auto px-6 relative z-10 text-white">
            <div class="md:w-2/3 lg:w-1/2">
                @if(isset($hero->subheading))
                <span
                    class="bg-blue-600 px-4 py-1 rounded-full text-sm font-bold mb-4 inline-block uppercase tracking-widest">
                    {{ $hero->subheading }}
                </span>
                @endif
                <h1 class="text-4xl md:text-6xl font-bold leading-tight mb-6">
                    {!! str_replace(['Handal', 'IT'], ['<span class="text-blue-400">Handal</span>', '<span
                        class="text-blue-400">IT</span>'], $hero->heading ?? 'Infrastruktur IT Handal & Aplikasi
                    Custom') !!}
                </h1>
                <p class="text-lg mb-8 opacity-90 leading-relaxed">
                    {{ $hero->description ?? 'Hnet Solution menghadirkan solusi integrasi sistem, jaringan berkecepatan tinggi, keamanan CCTV, dan pembuatan aplikasi bisnis kustom.' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ $hero->button_primary_link ?? '#packages' }}"
                        class="bg-blue-600 text-white px-8 py-4 rounded-xl font-bold hover:bg-blue-700 transition shadow-xl flex items-center">
                        {{ $hero->button_primary_text ?? 'Mulai Sekarang' }} <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                    <a href="{{ $hero->button_secondary_link ?? 'https://wa.me/6287781466447' }}"
                        class="bg-white/10 backdrop-blur-md border border-white/30 text-white px-8 py-4 rounded-xl font-bold hover:bg-white/20 transition">
                        {{ $hero->button_secondary_text ?? 'Konsultasi Gratis' }}
                    </a>
                </div>
            </div>
        </div>

        <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 flex space-x-3 z-20">
            @if(isset($hero->slides))
            @foreach($hero->slides as $index => $slide)
            <div
                class="dot w-3 h-3 rounded-full bg-white/40 transition-all duration-500 {{ $index === 0 ? 'active-dot' : '' }} cursor-pointer">
            </div>
            @endforeach
            @else
            <div class="dot w-3 h-3 rounded-full bg-white/40 transition-all duration-500 active-dot cursor-pointer">
            </div>
            <div class="dot w-3 h-3 rounded-full bg-white/40 transition-all duration-500 cursor-pointer"></div>
            <div class="dot w-3 h-3 rounded-full bg-white/40 transition-all duration-500 cursor-pointer"></div>
            @endif
        </div>
    </section>

    <!-- Clients Section -->
    <section id="clients" class="py-16 bg-white border-b">
        <div class="container mx-auto px-6">
            <div class="text-center mb-10">
                <p class="text-gray-400 font-bold uppercase tracking-widest text-sm">
                    {{ $clients->heading ?? 'Dipercaya oleh Perusahaan Terkemuka' }}
                </p>
            </div>
            <div class="flex flex-wrap justify-center items-center gap-12 md:gap-20">
                @if(isset($clients->items))
                @foreach($clients->items as $client)
                <div class="h-20 w-auto max-h-full bg-gray-100 rounded-lg flex items-center justify-center p-4">
                    @if(isset($client->image) && $client->image)
                    <img src="{{ asset('storage/' . $client->image) }}" alt="{{ $client->name ?? 'Client' }}"
                        class="max-h-full max-w-full object-contain">
                    @else
                    <span class="text-gray-400 font-bold text-sm">{{ $client->name ?? 'Client' }}</span>
                    @endif
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-24 px-6 bg-gray-50">
        <div class="container mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                    {{ $services->heading ?? 'Layanan Unggulan Kami' }}
                </h2>
                <div class="w-24 h-1.5 bg-blue-600 mx-auto mt-6 rounded-full"></div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @if(isset($services->items))
                @foreach($services->items as $service)
                <div
                    class="group p-10 rounded-3xl bg-white hover:bg-blue-600 transition-all duration-500 shadow-sm hover:shadow-2xl">
                    <div
                        class="w-16 h-16 bg-blue-100 rounded-2xl flex items-center justify-center text-blue-600 text-3xl mb-8 group-hover:bg-white/20 group-hover:text-white transition">
                        <i class="{{ $service->icon ?? 'fas fa-code' }}"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 group-hover:text-white transition">
                        {{ $service->title }}
                    </h3>
                    <p class="text-gray-600 group-hover:text-white/80 transition leading-relaxed">
                        {{ $service->description }}
                    </p>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Activity Insights Section -->
    <section id="activity-insights" class="py-24 px-6 bg-gray-50">
        <div class="container mx-auto">
            <div class="text-center mb-10">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900">Aktivitas Pengunjung</h2>
                <p class="text-gray-600 mt-2">Ringkasan perangkat dan perilaku pengunjung situs.</p>
            </div>
            <div class="flex justify-center">
                <div class="relative w-full max-w-xs h-[250px]">
                    <canvas id="landingActivityChart"></canvas>
                </div>
            </div>
        </div>
    </section>

    <!-- Packages Section -->
    <section id="packages" class="py-24 px-6 bg-white">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900">
                    {{ $packages->heading ?? 'Pilihan Paket Kategori' }}
                </h2>
                <p class="text-gray-500 mt-4">
                    {{ $packages->subheading ?? 'Pilih solusi yang paling tepat untuk skala bisnis Anda' }}
                </p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 items-start">
                @if(isset($packages->items))
                @foreach($packages->items as $package)
                <div
                    class="border rounded-3xl p-8 hover:shadow-2xl transition duration-500 flex flex-col {{ $package->is_popular ? 'border-4 border-blue-600 shadow-2xl bg-blue-600 text-white transform md:scale-105' : '' }}">
                    @if($package->is_popular)
                    <span
                        class="bg-white text-blue-600 text-xs font-bold px-3 py-1 rounded-full mb-4 w-fit">POPULER</span>
                    @endif
                    <h3 class="text-xl font-bold mb-4">{{ $package->title }}</h3>
                    <ul class="space-y-4 mb-8 flex-grow">
                        @foreach($package->features as $feature)
                        <li class="flex items-center">
                            <i
                                class="fas fa-check {{ $package->is_popular ? 'text-blue-200' : 'text-green-500' }} mr-2"></i>
                            {{ $feature }}
                        </li>
                        @endforeach
                    </ul>
                    <a href="{{ $package->button_link }}"
                        class="block text-center py-3 {{ $package->is_popular ? 'bg-white text-blue-600 hover:bg-gray-100' : 'bg-gray-100 hover:bg-blue-600 hover:text-white' }} rounded-xl font-bold transition">
                        {{ $package->button_text }}
                    </a>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-24 px-6 bg-gray-50">
        <div class="container mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold">
                    {{ $gallery->heading ?? 'Galeri Portofolio' }}
                </h2>
                <div class="w-20 h-1 bg-blue-600 mx-auto mt-4"></div>
            </div>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                @php
                $galleryItems = $gallery->items ?? [];
                @endphp

                @if(count($galleryItems) > 0)
                @foreach($galleryItems as $item)
                @if(isset($item->image) && $item->image)
                <img src="{{ asset('storage/' . $item->image) }}" alt="Project"
                    class="rounded-2xl h-64 w-full object-cover hover:opacity-80 cursor-pointer transition shadow-md">
                @else
                <div
                    class="rounded-2xl h-64 w-full object-cover bg-gray-200 flex items-center justify-center text-gray-400 shadow-md">
                    <i class="fas fa-image text-5xl"></i>
                </div>
                @endif
                @endforeach
                @endif
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 px-6 bg-blue-900 text-white">
        <div class="container mx-auto flex flex-col lg:flex-row gap-16">
            <div class="lg:w-1/2">
                <h2 class="text-4xl font-bold mb-8 italic">
                    {{ $contact->heading ?? 'Hnet Solution' }}
                </h2>
                <p class="text-blue-200 mb-10 text-lg leading-relaxed">
                    {{ $contact->description ?? 'Hubungi kami hari ini untuk mendapatkan solusi infrastruktur IT dan aplikasi terbaik yang dirancang khusus untuk kebutuhan bisnis Anda.' }}
                </p>
                <div class="space-y-6">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-envelope w-8 text-xl text-blue-300"></i>
                        <span>{{ $contact->email ?? 'muhamadhabib.work@gmail.com' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-phone w-8 text-xl text-blue-300"></i>
                        <span>{{ $contact->phone ?? '+62 877-8146-6447' }}</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-map-marker-alt w-8 text-xl text-blue-300"></i>
                        <span>{{ $contact->address ?? 'Jakarta, Indonesia' }}</span>
                    </div>
                </div>
            </div>
            <div class="lg:w-1/2 bg-white rounded-3xl p-10 text-gray-900 shadow-2xl">
                <h3 class="text-2xl font-bold mb-6 text-gray-800">Kirim Pesan</h3>
                <form action="#" class="space-y-4">
                    <input type="text" placeholder="Nama Lengkap"
                        class="w-full px-5 py-4 bg-gray-100 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none">
                    <input type="email" placeholder="Email"
                        class="w-full px-5 py-4 bg-gray-100 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none">
                    <textarea rows="4" placeholder="Detail Kebutuhan..."
                        class="w-full px-5 py-4 bg-gray-100 rounded-xl focus:ring-2 focus:ring-blue-600 outline-none"></textarea>
                    <button
                        class="w-full py-4 bg-blue-600 text-white font-bold rounded-xl hover:bg-blue-700 transition shadow-lg">
                        Kirim Pesan Sekarang
                    </button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-10 bg-gray-950 text-gray-500 text-center border-t border-gray-900">
        <p>&copy; {{ date('Y') }} Hnet Solution. Integrated IT Excellence.</p>
    </footer>

    <script>
    // Hero Slider
    const slides = document.querySelectorAll('.hero-slide');
    const dots = document.querySelectorAll('.dot');
    let current = 0;

    function updateSlider(index) {
        if (slides.length === 0) return;
        slides.forEach(s => s.style.opacity = '0');
        dots.forEach(d => d.classList.remove('active-dot'));
        slides[index].style.opacity = '1';
        dots[index].classList.add('active-dot');
    }

    dots.forEach((dot, i) => {
        dot.addEventListener('click', () => {
            current = i;
            updateSlider(current);
        });
    });

    if (slides.length > 1) {
        setInterval(() => {
            current = (current + 1) % slides.length;
            updateSlider(current);
        }, 5000);
    }

    // Mobile Menu
    const menuBtn = document.getElementById('menu-btn');
    const mobileMenu = document.getElementById('mobile-menu');
    menuBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Close mobile menu on link click
    document.querySelectorAll('#mobile-menu a').forEach(link => {
        link.addEventListener('click', () => {
            mobileMenu.classList.add('hidden');
        });
    });
    // Activity Monitoring Donut Chart
    const activityCtx = document.getElementById('landingActivityChart').getContext('2d');
    const activityData = JSON.parse('{!! json_encode($activityData ?? []) !!}');
    new Chart(activityCtx, {
        type: 'doughnut',
        data: {
            labels: activityData.map(item => item.label),
            datasets: [{
                data: activityData.map(item => item.count),
                backgroundColor: [
                    'rgba(255, 99, 132, 0.8)',
                    'rgba(54, 162, 235, 0.8)',
                    'rgba(255, 206, 86, 0.8)',
                    'rgba(75, 192, 192, 0.8)',
                    'rgba(153, 102, 255, 0.8)',
                    'rgba(255, 159, 64, 0.8)'
                ],
                hoverOffset: 4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
    </script>
</body>

</html>