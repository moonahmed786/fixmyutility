<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'FixMyUtility') }} - Utility Bill Audit Experts</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="font-sans antialiased bg-background text-dark">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white/80 backdrop-blur-md sticky top-0 z-50 border-b border-secondary/10">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <span class="text-2xl font-extrabold tracking-tight text-primary">FixMy<span class="text-dark">Utility</span></span>
                        </a>
                        <div class="hidden md:ml-10 md:flex md:space-x-8">
                            <a href="{{ route('home') }}" class="text-dark/70 hover:text-primary font-semibold transition">Home</a>
                            <a href="{{ route('services.index') }}" class="text-dark/70 hover:text-primary font-semibold transition">Services</a>
                            <a href="{{ route('pricing') }}" class="text-dark/70 hover:text-primary font-semibold transition">Pricing</a>
                            <a href="{{ route('blog.index') }}" class="text-dark/70 hover:text-primary font-semibold transition">Blog</a>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-primary py-2 px-6">Dashboard</a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="text-dark/60 hover:text-dark font-bold text-sm">Logout</button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="text-dark/70 hover:text-primary font-bold transition">Login</a>
                            <a href="{{ route('register') }}" class="btn-primary py-2 px-6">Get Started</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            @if (isset($header))
                <header class="bg-white border-b border-secondary/10 py-6">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @yield('content')
            {{ $slot ?? '' }}
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="col-span-1 md:col-span-2">
                        <span class="text-2xl font-extrabold tracking-tight text-white mb-6 block">FixMyUtility</span>
                        <p class="text-white/60 max-w-sm mb-8">Professional utility bill auditing powered by AI. We help you find overcharges and recover money from your providers.</p>
                        <div class="flex gap-4">
                            <!-- Social Icons -->
                        </div>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-6">Company</h4>
                        <ul class="space-y-4 text-white/60">
                            <li><a href="{{ route('about') }}" class="hover:text-primary transition">About Us</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-primary transition">Contact</a></li>
                            <li><a href="{{ route('pricing') }}" class="hover:text-primary transition">Pricing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-lg mb-6">Support</h4>
                        <ul class="space-y-4 text-white/60">
                            <li><a href="#" class="hover:text-primary transition">Help Center</a></li>
                            <li><a href="#" class="hover:text-primary transition">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-primary transition">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-16 pt-8 border-t border-white/10 text-center text-white/40 text-sm">
                    &copy; {{ date('Y') }} FixMyUtility. All rights reserved.
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
