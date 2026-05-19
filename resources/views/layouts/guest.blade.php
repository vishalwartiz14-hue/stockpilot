<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" type="image/svg+xml" href="/favicon.svg">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Instrument+Serif:ital@0;1&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="min-h-screen text-slate-100 antialiased" style="background-color: #0e1410; font-family: 'Inter', system-ui, sans-serif;">
        <div class="relative min-h-screen overflow-hidden px-4 py-10 sm:px-6 lg:px-8" style="background-image: radial-gradient(ellipse 80% 60% at 20% 0%, rgba(197,242,75,0.18), transparent 60%), radial-gradient(ellipse 70% 50% at 100% 100%, rgba(255,181,71,0.14), transparent 60%);">
            <div class="pointer-events-none absolute inset-0 opacity-80" style="background: linear-gradient(180deg, rgba(14,20,16,0.9) 0%, rgba(14,20,16,0.95) 100%);"></div>
            <div class="relative mx-auto flex min-h-screen w-full max-w-4xl items-center justify-center">
                <div class="w-full rounded-[2rem] border border-white/10 bg-slate-900/95 p-8 shadow-2xl shadow-slate-950/40 backdrop-blur-xl sm:p-10">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </body>
</html>
