<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'FixMyUtility') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#7C5C3E',
                        secondary: '#C49A72',
                        accent: '#E8A87C',
                        background: '#FAF6F0',
                        dark: '#3D2B1F',
                    },
                    fontFamily: {
                        sans: ['Inter', 'sans-serif'],
                        heading: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        body { background-color: #FAF6F0; color: #3D2B1F; font-family: 'Inter', sans-serif; }
        h1, h2, h3, h4, h5, h6 { font-family: 'Plus Jakarta Sans', sans-serif; font-weight: 700; }
        .btn-primary { background-color: #7C5C3E; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; transition: all 0.3s; }
        .btn-primary:hover { background-color: #3D2B1F; }
    </style>
    @livewireStyles
</head>
<body class="antialiased">
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="bg-white border-b border-secondary/20 sticky top-0 z-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between h-20">
                    <div class="flex items-center">
                        <a href="{{ route('home') }}" class="flex items-center gap-2">
                            <span class="text-2xl font-extrabold text-primary tracking-tight">FixMyUtility</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-8">
                        <a href="{{ route('home') }}" class="font-medium hover:text-primary transition">Home</a>
                        <a href="{{ route('services.index') }}" class="font-medium hover:text-primary transition">Services</a>
                        <a href="{{ route('pricing') }}" class="font-medium hover:text-primary transition">Pricing</a>
                        <a href="{{ route('blog.index') }}" class="font-medium hover:text-primary transition">Blog</a>
                        @auth
                            <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="font-medium hover:text-primary transition">Login</a>
                            <a href="{{ route('register') }}" class="btn-primary">Get Started</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="flex-grow">
            {{ $slot ?? '' }}
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-dark text-white py-12 mt-20">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-12">
                    <div class="col-span-1 md:col-span-2">
                        <span class="text-2xl font-extrabold text-accent">FixMyUtility</span>
                        <p class="mt-4 text-white/70 max-w-sm">Saving homeowners and businesses money by auditing utility bills for errors and overcharges across the USA, UK, and Canada.</p>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Quick Links</h4>
                        <ul class="space-y-2 text-white/70">
                            <li><a href="{{ route('about') }}" class="hover:text-accent transition">About Us</a></li>
                            <li><a href="{{ route('contact') }}" class="hover:text-accent transition">Contact</a></li>
                            <li><a href="{{ route('pricing') }}" class="hover:text-accent transition">Pricing</a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="text-lg font-bold mb-4">Support</h4>
                        <ul class="space-y-2 text-white/70">
                            <li><a href="#" class="hover:text-accent transition">FAQ</a></li>
                            <li><a href="#" class="hover:text-accent transition">Privacy Policy</a></li>
                            <li><a href="#" class="hover:text-accent transition">Terms of Service</a></li>
                        </ul>
                    </div>
                </div>
                <div class="border-t border-white/10 mt-12 pt-8 text-center text-white/50">
                    <p>&copy; {{ date('Y') }} FixMyUtility. All rights reserved.</p>
                </div>
            </div>
        </footer>
    </div>

    @livewireScripts
</body>
</html>
