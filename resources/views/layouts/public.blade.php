<!DOCTYPE html>
<html lang="en" class="h-full scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', 'GM Code Lab — Custom Software & Digital Solutions')</title>
    <meta name="description" content="@yield('meta_description', 'GM Code Lab engineers custom web applications, mobile apps, LMS platforms, healthcare software, and enterprise solutions for ambitious organizations.')">
    <link rel="canonical" href="@yield('canonical', request()->url())">
    
    <!-- Open Graph Metadata -->
    <meta property="og:title" content="@yield('og_title', 'GM Code Lab — Custom Software & Digital Solutions')">
    <meta property="og:description" content="@yield('og_description', 'Engineering high-performance web apps, mobile solutions, LMS platforms, and custom enterprise software.')">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->url() }}">
    
    <!-- Twitter Metadata -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="@yield('og_title', 'GM Code Lab — Custom Software & Digital Solutions')">
    <meta name="twitter:description" content="@yield('og_description', 'Engineering high-performance web apps, mobile solutions, LMS platforms, and custom enterprise software.')">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    @if(file_exists(public_path('build/manifest.json')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endif

    <link rel="stylesheet" href="{{ asset('css/public.css') }}" onerror="this.onerror=null;">
    <style>
        @import url('/resources/css/public.css');
    </style>
</head>
<body class="flex flex-col min-h-screen bg-slate-50 text-slate-900 font-sans antialiased selection:bg-blue-600 selection:text-white">
    <!-- Skip to Content Accessibility Link -->
    <a href="#main-content" class="sr-only focus:not-sr-only focus:absolute focus:top-4 focus:left-4 bg-blue-600 text-white px-4 py-2 rounded-md z-50">
        Skip to main content
    </a>

    <!-- Navbar Header -->
    <x-navbar />

    <!-- Main Page Body -->
    <main id="main-content" class="flex-grow">
        @yield('content')
    </main>

    <!-- Footer Component -->
    <x-footer />

    <!-- Mobile Drawer & Interactivity Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');

            if (mobileMenuBtn && mobileMenu) {
                mobileMenuBtn.addEventListener('click', function() {
                    const isExpanded = mobileMenuBtn.getAttribute('aria-expanded') === 'true';
                    mobileMenuBtn.setAttribute('aria-expanded', !isExpanded);
                    mobileMenu.classList.toggle('hidden');
                });
            }
        });
    </script>
</body>
</html>
