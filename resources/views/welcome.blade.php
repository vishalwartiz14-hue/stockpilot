<!DOCTYPE html>
<html lang="en">
@vite(['resources/css/app.css', 'resources/js/app.js'])
<head>
    <meta charset="UTF-8">
    <title>AI Restaurant Inventory System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet"> -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>
<body class="bg-slate-50">

<!-- NAVBAR -->
<header class="bg-white border-b shadow-sm">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">

        <div class="flex items-center gap-2">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600"></div>
            <h1 class="text-lg font-bold text-slate-800">
                AI Inventory System
            </h1>
        </div>

        <div class="flex gap-3">
            <a href="{{ route('login') }}" class="px-4 py-2 text-sm rounded-lg border hover:bg-slate-100">
                Login
            </a>

            <a href="{{ route('register') }}" class="px-4 py-2 text-sm rounded-lg bg-blue-600 text-white hover:bg-blue-700">
                Register
            </a>
        </div>

    </div>
</header>

<!-- HERO -->
<section class="max-w-7xl mx-auto px-6 py-20 grid md:grid-cols-2 gap-12 items-center">

    <div>

        <h2 class="text-4xl md:text-5xl font-extrabold text-slate-900 leading-tight">
            AI-Powered <br>
            Restaurant Inventory <br>
            Ordering System 🍽️
        </h2>

        <p class="text-slate-600 mt-5 text-lg">
            Automate procurement, track inventory, and generate smart purchase orders using AI-driven analytics for restaurants.
        </p>

        <div class="mt-8 flex gap-4">

            <a href="{{ route('procurements.viewData') }}"
               class="px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-xl shadow-lg hover:opacity-90">
                Open Dashboard
            </a>

            <a href="#features"
               class="px-6 py-3 border rounded-xl hover:bg-white">
                Explore Features
            </a>

        </div>

        <!-- badges -->
        <div class="mt-6 flex gap-3 text-xs text-slate-500">
            <span class="px-3 py-1 bg-slate-100 rounded-full">AI Auto Reorder</span>
            <span class="px-3 py-1 bg-slate-100 rounded-full">Smart Procurement</span>
            <span class="px-3 py-1 bg-slate-100 rounded-full">Real-time Inventory</span>
        </div>

    </div>

    <!-- RIGHT CARD -->
    <div class="bg-white rounded-2xl shadow-xl border p-6">

        <h3 class="text-lg font-semibold text-slate-800 mb-4">
            Live System Overview
        </h3>

        <div class="grid grid-cols-2 gap-4">

            <div class="p-4 rounded-xl bg-blue-50">
                <p class="text-sm text-slate-500">Total Items</p>
                <h2 class="text-2xl font-bold text-blue-600">1,240</h2>
            </div>

            <div class="p-4 rounded-xl bg-green-50">
                <p class="text-sm text-slate-500">Orders</p>
                <h2 class="text-2xl font-bold text-green-600">320</h2>
            </div>

            <div class="p-4 rounded-xl bg-yellow-50">
                <p class="text-sm text-slate-500">Pending</p>
                <h2 class="text-2xl font-bold text-yellow-600">18</h2>
            </div>

            <div class="p-4 rounded-xl bg-red-50">
                <p class="text-sm text-slate-500">Low Stock</p>
                <h2 class="text-2xl font-bold text-red-600">7</h2>
            </div>

        </div>

        <div class="mt-6 p-4 bg-slate-900 text-white rounded-xl">

            <p class="text-sm text-slate-300">
                AI Suggestion
            </p>

            <p class="mt-1 font-semibold">
                “Tomatoes & Oil stock low — reorder recommended in 2 days”
            </p>

        </div>

    </div>

</section>

<!-- FEATURES -->
<section id="features" class="max-w-7xl mx-auto px-6 pb-20">

    <h3 class="text-3xl font-bold text-slate-900 text-center mb-10">
        Core Features
    </h3>

    <div class="grid md:grid-cols-3 gap-6">

        <div class="bg-white p-6 rounded-2xl shadow border hover:shadow-lg transition">
            <h4 class="font-semibold text-slate-800">🤖 AI Auto Reorder</h4>
            <p class="text-slate-500 mt-2 text-sm">
                Automatically generate purchase orders based on stock usage trends.
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border hover:shadow-lg transition">
            <h4 class="font-semibold text-slate-800">📦 Inventory Tracking</h4>
            <p class="text-slate-500 mt-2 text-sm">
                Real-time item tracking with stock alerts and reports.
            </p>
        </div>

        <div class="bg-white p-6 rounded-2xl shadow border hover:shadow-lg transition">
            <h4 class="font-semibold text-slate-800">🚚 Smart Procurement</h4>
            <p class="text-slate-500 mt-2 text-sm">
                Optimize supplier selection based on price and availability. 
            </p>
        </div>

    </div>

</section>

<!-- CTA -->
<section class="bg-gradient-to-r from-blue-600 to-indigo-600 py-16 text-center text-white">

    <h2 class="text-3xl font-bold">
        Ready to automate your restaurant inventory?
    </h2>

    <p class="mt-3 text-blue-100">
        Save time, reduce waste, and improve efficiency with AI-driven procurement.
    </p>

    <a href="{{ route('procurements.viewData') }}"
       class="mt-6 inline-block px-6 py-3 bg-white text-blue-600 font-semibold rounded-xl shadow hover:bg-slate-100">
        Get Started Now
    </a>

</section>

<!-- FOOTER -->
<footer class="bg-white border-t py-6 text-center text-sm text-slate-500">
    © {{ date('Y') }} AI Restaurant Inventory Ordering System. All rights reserved.
</footer>

</body>
</html>