
@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Create Recipe
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Add recipe details, ingredients, costing & preparation workflow
            </p>
        </div>

        <a href="{{ route('recipe-menucosting.viewData') }}"
           class="px-5 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white shadow-lg transition">
            ← Back to Recipes
        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-2xl shadow border p-6">

        <form class="space-y-8">

            <!-- BASIC DETAILS -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Recipe Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <!-- RECIPE NAME -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Recipe Name
                        </label>

                        <input type="text"
                               placeholder="Chicken Burger"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- CATEGORY -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Category
                        </label>

                        <select class="w-full rounded-xl border border-slate-300 px-4 py-3">
                            <option>Select Category</option>
                            <option>Fast Food</option>
                            <option>Italian</option>
                            <option>Beverages</option>
                            <option>Desserts</option>
                        </select>
                    </div>

                    <!-- MENU TYPE -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Menu Type
                        </label>

                        <select class="w-full rounded-xl border border-slate-300 px-4 py-3">
                            <option>Regular Menu</option>
                            <option>Seasonal Menu</option>
                            <option>Limited Offer</option>
                        </select>
                    </div>

                </div>

            </div>

            <!-- YIELD & PORTION -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Yield & Portion Control
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Yield Quantity
                        </label>

                        <input type="number"
                               placeholder="1"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Portion Size
                        </label>

                        <input type="text"
                               placeholder="250g"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Preparation Time
                        </label>

                        <input type="text"
                               placeholder="20 Minutes"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                    </div>

                </div>

            </div>

            <!-- INGREDIENTS -->
            <div>

                <div class="flex items-center justify-between mb-5">

                    <h3 class="text-lg font-semibold text-slate-900">
                        Ingredient Mapping
                    </h3>

                    <button type="button"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">
                        + Add Ingredient
                    </button>

                </div>

                <div class="overflow-x-auto border rounded-2xl">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="text-left p-4">Ingredient</th>
                                <th class="text-left p-4">Unit</th>
                                <th class="text-left p-4">Quantity</th>
                                <th class="text-left p-4">Cost</th>
                                <th class="text-left p-4">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            <tr>

                                <td class="p-4">
                                    <select class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                        <option>Chicken Patty</option>
                                    </select>
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="PCS"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="number"
                                           value="1"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="₹ 60"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <button class="px-3 py-1 rounded-lg bg-red-100 text-red-600">
                                        Remove
                                    </button>
                                </td>

                            </tr>

                            <tr>

                                <td class="p-4">
                                    <select class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                        <option>Burger Bun</option>
                                    </select>
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="PCS"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="number"
                                           value="1"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="₹ 18"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <button class="px-3 py-1 rounded-lg bg-red-100 text-red-600">
                                        Remove
                                    </button>
                                </td>

                            </tr>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- COSTING -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Costing & Profitability
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                    <div class="bg-slate-50 rounded-2xl border p-5">
                        <p class="text-sm text-slate-500">
                            Ingredient Cost
                        </p>

                        <h2 class="text-2xl font-bold mt-2">
                            ₹ 120
                        </h2>
                    </div>

                    <div class="bg-slate-50 rounded-2xl border p-5">
                        <p class="text-sm text-slate-500">
                            Selling Price
                        </p>

                        <input type="text"
                               value="₹ 320"
                               class="mt-3 w-full rounded-lg border border-slate-300 px-3 py-2">
                    </div>

                    <div class="bg-green-50 rounded-2xl border border-green-100 p-5">
                        <p class="text-sm text-slate-500">
                            Profit Margin
                        </p>

                        <h2 class="text-2xl font-bold mt-2 text-green-600">
                            62%
                        </h2>
                    </div>

                    <div class="bg-blue-50 rounded-2xl border border-blue-100 p-5">
                        <p class="text-sm text-slate-500">
                            Food Cost %
                        </p>

                        <h2 class="text-2xl font-bold mt-2 text-blue-600">
                            38%
                        </h2>
                    </div>

                </div>

            </div>

            <!-- PREPARATION -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Preparation Instructions
                </h3>

                <textarea rows="6"
                          placeholder="Enter step-by-step preparation instructions..."
                          class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>

            </div>

            <!-- SETTINGS -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Recipe Settings
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div class="p-4 rounded-xl border bg-green-50 border-green-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Active Menu Item
                            </span>

                            <input type="checkbox" checked class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Show item in restaurant menu
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Seasonal Recipe
                            </span>

                            <input type="checkbox" class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Available for seasonal menu
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Waste Tracking
                            </span>

                            <input type="checkbox" checked class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Enable ingredient waste analysis
                        </p>

                    </div>

                </div>

            </div>

            <!-- BUTTONS -->
            <div class="flex justify-end gap-4 pt-4">

                <a href="{{ route('recipe-menucosting.viewData') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                    Cancel
                </a>

                <a href="{{ route('recipe-menucosting.viewData') }}"
                   class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white shadow-lg">
                    Save Recipe
                </a>

            </div>

        </form>

    </div>

</div>

@endsection