
@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Recipe & Menu Costing
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Manage recipes, food costs, profitability & ingredient optimization
            </p>
        </div>

        <div class="flex items-center gap-3">

            <button class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                Menu Analytics
            </button>

            <a href="{{ route('recipe-menucosting.addData') }}" class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg">
                + Create Recipe
            </a>

        </div>

    </div>

    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Total Recipes</p>
            <h2 class="text-3xl font-bold mt-2 text-slate-900">124</h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Avg Food Cost</p>
            <h2 class="text-3xl font-bold mt-2 text-orange-500">28%</h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Most Profitable Item</p>
            <h2 class="text-xl font-bold mt-2 text-green-600">
                Chicken Burger
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Waste Reduction</p>
            <h2 class="text-3xl font-bold mt-2 text-blue-600">18%</h2>
        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- RECIPE TABLE -->
        <div class="xl:col-span-2 bg-white rounded-2xl shadow border overflow-hidden">

            <div class="p-5 border-b flex items-center justify-between">

                <div>
                    <h3 class="font-semibold text-slate-900">
                        🍽 Recipe Management
                    </h3>

                    <p class="text-sm text-slate-500">
                        Recipes, yields & ingredient mapping
                    </p>
                </div>

                <input type="text"
                       placeholder="Search recipes..."
                       class="px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-blue-500 focus:outline-none">

            </div>

            <div class="overflow-x-auto">

                <table class="w-full text-sm">

                    <thead class="bg-slate-50 text-slate-600">
                        <tr>
                            <th class="text-left p-4">Recipe</th>
                            <th class="text-left p-4">Category</th>
                            <th class="text-left p-4">Yield</th>
                            <th class="text-left p-4">Food Cost</th>
                            <th class="text-left p-4">Profit Margin</th>
                            <th class="text-left p-4">Action</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">

                        <tr class="hover:bg-slate-50 transition">

                            <td class="p-4">
                                <div>
                                    <p class="font-medium">
                                        Chicken Burger
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Version 2.1
                                    </p>
                                </div>
                            </td>

                            <td class="p-4">
                                Fast Food
                            </td>

                            <td class="p-4">
                                1 Portion
                            </td>

                            <td class="p-4 text-orange-500 font-semibold">
                                ₹ 120
                            </td>

                            <td class="p-4 text-green-600 font-semibold">
                                62%
                            </td>

                            <td class="p-4">
                                <button class="px-3 py-1 rounded-lg bg-blue-100 text-blue-600">
                                    View
                                </button>
                            </td>

                        </tr>

                        <tr class="hover:bg-slate-50 transition">

                            <td class="p-4">
                                <div>
                                    <p class="font-medium">
                                        Alfredo Pasta
                                    </p>

                                    <p class="text-xs text-slate-500">
                                        Seasonal Menu
                                    </p>
                                </div>
                            </td>

                            <td class="p-4">
                                Italian
                            </td>

                            <td class="p-4">
                                2 Portions
                            </td>

                            <td class="p-4 text-orange-500 font-semibold">
                                ₹ 180
                            </td>

                            <td class="p-4 text-green-600 font-semibold">
                                54%
                            </td>

                            <td class="p-4">
                                <button class="px-3 py-1 rounded-lg bg-blue-100 text-blue-600">
                                    View
                                </button>
                            </td>

                        </tr>

                    </tbody>

                </table>

            </div>

        </div>

        <!-- COST ANALYTICS -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <h3 class="font-semibold text-slate-900 mb-5">
                📊 Menu Cost Analytics
            </h3>

            <div class="space-y-4">

                <div class="p-4 rounded-xl border bg-green-50 border-green-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            High Profit Items
                        </span>

                        <span class="text-green-600 font-bold">
                            18 Items
                        </span>
                    </div>

                </div>

                <div class="p-4 rounded-xl border bg-red-50 border-red-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            Low Margin Items
                        </span>

                        <span class="text-red-600 font-bold">
                            7 Items
                        </span>
                    </div>

                </div>

                <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            Ingredient Cost Impact
                        </span>

                        <span class="text-blue-600 font-bold">
                            +12%
                        </span>
                    </div>

                </div>

                <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            Waste Optimization
                        </span>

                        <span class="text-yellow-700 font-bold">
                            84%
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- SECOND GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- INGREDIENT UTILIZATION -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="font-semibold text-slate-900">
                        🥬 Ingredient Utilization
                    </h3>

                    <p class="text-sm text-slate-500">
                        Cross-menu ingredient optimization
                    </p>
                </div>

                <button class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm">
                    View Analysis
                </button>

            </div>

            <div class="space-y-4">

                <div class="border rounded-xl p-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h4 class="font-medium">
                                Tomato Usage
                            </h4>

                            <p class="text-sm text-slate-500">
                                Used in 14 menu items
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs">
                            Optimized
                        </span>

                    </div>

                </div>

                <div class="border rounded-xl p-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h4 class="font-medium">
                                Cheese Inventory
                            </h4>

                            <p class="text-sm text-slate-500">
                                Excess stock detected
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs">
                            Waste Risk
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- RECIPE VERSIONING -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="font-semibold text-slate-900">
                        📝 Recipe Versioning
                    </h3>

                    <p class="text-sm text-slate-500">
                        Recipe updates & historical tracking
                    </p>
                </div>

                <button class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">
                    New Version
                </button>

            </div>

            <div class="space-y-4">

                <div class="p-4 rounded-xl bg-slate-50 border">

                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium">
                            Chicken Burger v2.1
                        </h4>

                        <span class="text-xs text-slate-400">
                            Updated Today
                        </span>
                    </div>

                    <p class="text-sm text-slate-600">
                        Reduced mayonnaise quantity to improve margin.
                    </p>

                </div>

                <div class="p-4 rounded-xl bg-slate-50 border">

                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium">
                            Alfredo Pasta v1.8
                        </h4>

                        <span class="text-xs text-slate-400">
                            3 Days Ago
                        </span>
                    </div>

                    <p class="text-sm text-slate-600">
                        Seasonal pricing adjustment applied.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection