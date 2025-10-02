<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'QR Code Maker') }} - Create QR Codes Instantly</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700&display=swap" rel="stylesheet" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body
    class="antialiased bg-gradient-to-br from-blue-50 via-white to-purple-50 dark:from-gray-900 dark:via-gray-800 dark:to-gray-900">
    <!-- Navigation -->
    <nav
        class="fixed top-0 left-0 right-0 z-50 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-200 dark:border-gray-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center gap-3">
                    <div
                        class="w-10 h-10 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-white" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                        </svg>
                    </div>
                    <span
                        class="text-xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                        QR Code Maker
                    </span>
                </div>

                @if (Route::has('login'))
                    <div class="flex items-center gap-3">
                        @auth
                            <a href="{{ url('/dashboard') }}" class="btn btn-primary btn-sm">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-ghost btn-sm">
                                Log in
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="btn btn-primary btn-sm">
                                    Get Started
                                </a>
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-4">
        <div class="max-w-7xl mx-auto">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left Content -->
                <div class="space-y-8">
                    <div
                        class="inline-flex items-center gap-2 px-4 py-2 bg-blue-100 dark:bg-blue-900/30 rounded-full text-blue-700 dark:text-blue-300 text-sm font-medium">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z"
                                clip-rule="evenodd" />
                        </svg>
                        Fast & Free QR Code Generator
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 dark:text-white leading-tight">
                        Create QR Codes
                        <span class="bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">
                            In Seconds
                        </span>
                    </h1>

                    <p class="text-xl text-gray-600 dark:text-gray-300 leading-relaxed">
                        Generate custom QR codes for your business, events, or personal use. Simple, fast, and
                        completely free. No design skills required.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4">
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"
                                        clip-rule="evenodd" />
                                </svg>
                                Start Creating Free
                            </a>
                        @endif
                        <a href="#features" class="btn btn-outline btn-lg gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Learn More
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-8 pt-8 border-t border-gray-200 dark:border-gray-700">
                        <div>
                            <div class="text-3xl font-bold text-gray-900 dark:text-white">100%</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Free Forever</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900 dark:text-white">∞</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Unlimited QR Codes</div>
                        </div>
                        <div>
                            <div class="text-3xl font-bold text-gray-900 dark:text-white">&lt;1s</div>
                            <div class="text-sm text-gray-600 dark:text-gray-400">Generation Time</div>
                        </div>
                    </div>
                </div>

                <!-- Right Content - QR Code Preview -->
                <div class="relative">
                    <div
                        class="relative z-10 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl p-8 border border-gray-200 dark:border-gray-700">
                        <div class="space-y-6">
                            <div class="flex items-center justify-between">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Live Preview</h3>
                                <div class="badge badge-success badge-sm">Active</div>
                            </div>

                            <div
                                class="aspect-square bg-gradient-to-br from-gray-50 to-gray-100 dark:from-gray-700 dark:to-gray-800 rounded-xl flex items-center justify-center p-8">
                                <!-- Sample QR Code SVG -->
                                <svg viewBox="0 0 100 100" class="w-full h-full">
                                    <rect width="100" height="100" fill="white" />
                                    <g fill="black">
                                        <rect x="10" y="10" width="25" height="25" />
                                        <rect x="15" y="15" width="15" height="15" fill="white" />
                                        <rect x="65" y="10" width="25" height="25" />
                                        <rect x="70" y="15" width="15" height="15" fill="white" />
                                        <rect x="10" y="65" width="25" height="25" />
                                        <rect x="15" y="70" width="15" height="15" fill="white" />
                                        <rect x="40" y="10" width="5" height="5" />
                                        <rect x="50" y="10" width="5" height="5" />
                                        <rect x="40" y="20" width="5" height="5" />
                                        <rect x="55" y="20" width="5" height="5" />
                                        <rect x="40" y="40" width="5" height="5" />
                                        <rect x="50" y="40" width="5" height="5" />
                                        <rect x="60" y="40" width="5" height="5" />
                                        <rect x="70" y="40" width="5" height="5" />
                                        <rect x="40" y="50" width="5" height="5" />
                                        <rect x="60" y="50" width="5" height="5" />
                                        <rect x="80" y="50" width="5" height="5" />
                                        <rect x="40" y="60" width="5" height="5" />
                                        <rect x="50" y="60" width="5" height="5" />
                                        <rect x="70" y="60" width="5" height="5" />
                                        <rect x="50" y="70" width="5" height="5" />
                                        <rect x="60" y="70" width="5" height="5" />
                                        <rect x="80" y="70" width="5" height="5" />
                                        <rect x="40" y="80" width="5" height="5" />
                                        <rect x="60" y="80" width="5" height="5" />
                                        <rect x="70" y="80" width="5" height="5" />
                                    </g>
                                </svg>
                            </div>

                            <div class="space-y-3">
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    High-resolution output
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Customizable design
                                </div>
                                <div class="flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20"
                                        fill="currentColor">
                                        <path fill-rule="evenodd"
                                            d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    Instant download
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Decorative Elements -->
                    <div
                        class="absolute -top-4 -right-4 w-72 h-72 bg-purple-300 dark:bg-purple-900 rounded-full blur-3xl opacity-20">
                    </div>
                    <div
                        class="absolute -bottom-4 -left-4 w-72 h-72 bg-blue-300 dark:bg-blue-900 rounded-full blur-3xl opacity-20">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 px-4 bg-white dark:bg-gray-800">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Everything You Need
                </h2>
                <p class="text-xl text-gray-600 dark:text-gray-300">
                    Powerful features to create professional QR codes
                </p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature 1 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div
                            class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600 dark:text-blue-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 10V3L4 14h7v7l9-11h-7z" />
                            </svg>
                        </div>
                        <h3 class="card-title">Lightning Fast</h3>
                        <p class="text-gray-600 dark:text-gray-400">Generate QR codes instantly with our optimized
                            engine. No waiting, no delays.</p>
                    </div>
                </div>

                <!-- Feature 2 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div
                            class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-purple-600 dark:text-purple-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                            </svg>
                        </div>
                        <h3 class="card-title">Fully Customizable</h3>
                        <p class="text-gray-600 dark:text-gray-400">Add titles, descriptions, and customize your QR
                            codes to match your brand.</p>
                    </div>
                </div>

                <!-- Feature 3 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div
                            class="w-12 h-12 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600 dark:text-green-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="card-title">Secure & Private</h3>
                        <p class="text-gray-600 dark:text-gray-400">Your data is safe with us. We don't track or store
                            your QR code content.</p>
                    </div>
                </div>

                <!-- Feature 4 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div
                            class="w-12 h-12 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-orange-600 dark:text-orange-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="card-title">High Quality</h3>
                        <p class="text-gray-600 dark:text-gray-400">Download high-resolution PNG images perfect for
                            print and digital use.</p>
                    </div>
                </div>

                <!-- Feature 5 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div
                            class="w-12 h-12 bg-pink-100 dark:bg-pink-900/30 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600 dark:text-pink-400"
                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                            </svg>
                        </div>
                        <h3 class="card-title">Manage All Codes</h3>
                        <p class="text-gray-600 dark:text-gray-400">Keep track of all your QR codes in one organized
                            dashboard.</p>
                    </div>
                </div>

                <!-- Feature 6 -->
                <div class="card bg-base-100 shadow-xl hover:shadow-2xl transition-shadow">
                    <div class="card-body">
                        <div
                            class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="h-6 w-6 text-indigo-600 dark:text-indigo-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="card-title">Forever Free</h3>
                        <p class="text-gray-600 dark:text-gray-400">Unlimited QR code generation. No hidden fees, no
                            subscriptions required.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 px-4">
        <div class="max-w-4xl mx-auto">
            <div class="card bg-gradient-to-br from-blue-600 to-purple-600 text-white shadow-2xl">
                <div class="card-body items-center text-center p-12">
                    <h2 class="card-title text-4xl font-bold mb-4">Ready to Get Started?</h2>
                    <p class="text-xl mb-8 opacity-90">
                        Join thousands of users creating professional QR codes every day
                    </p>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="btn btn-lg bg-white text-blue-600 hover:bg-gray-100 border-none">
                            Create Your First QR Code
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path fill-rule="evenodd"
                                    d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12 px-4">
        <div class="max-w-7xl mx-auto text-center">
            <div class="flex items-center justify-center gap-3 mb-4">
                <div
                    class="w-8 h-8 bg-gradient-to-br from-blue-600 to-purple-600 rounded-lg flex items-center justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" />
                    </svg>
                </div>
                <span class="text-xl font-bold">QR Code Maker</span>
            </div>
            <p class="text-gray-400 mb-6 max-w-md mx-auto">
                The easiest way to create professional QR codes for your business, marketing campaigns, and personal
                projects.
            </p>
            <div class="flex justify-center gap-6 text-sm mb-8">
                <a href="#features" class="hover:text-blue-400 transition-colors">Features</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Terms of Service</a>
                <a href="#" class="hover:text-blue-400 transition-colors">Contact</a>
            </div>
            <div class="pt-6 border-t border-gray-800">
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} QR Code Maker. Built with Laravel & DaisyUI. All rights reserved.
                </p>
            </div>
        </div>
    </footer>

    <style>
        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-20px);
            }
        }

        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
    </style>

    <script>
        // Smooth scroll for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Add animation class to QR code preview
        const qrPreview = document.querySelector('.aspect-square');
        if (qrPreview) {
            qrPreview.classList.add('animate-float');
        }
    </script>
</body>

</html>
