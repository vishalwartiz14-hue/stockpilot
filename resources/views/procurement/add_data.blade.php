@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Create Purchase Order
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Generate supplier purchase orders for inventory procurement
            </p>
        </div>

        <a href="#"
           class="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition">
            ← Back to Orders
        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-2xl shadow border p-6">

        <form class="space-y-8">

            <!-- BASIC INFO -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Purchase Order Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <!-- PO NUMBER -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            PO Number
                        </label>

                        <input type="text"
                               value="PO-2045"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                    <!-- SUPPLIER -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Supplier
                        </label>

                        <select class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>Select Supplier</option>
                            <option>FreshFarm Foods</option>
                            <option>DairyPro Ltd</option>
                            <option>GrainHub</option>
                        </select>
                    </div>

                    <!-- DELIVERY DATE -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Expected Delivery
                        </label>

                        <input type="date"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>

                </div>

            </div>

            <!-- PROCUREMENT RULES -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    AI Procurement Settings
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                AI Auto Reorder
                            </span>

                            <input type="checkbox" checked class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Enable AI-generated reorder quantities
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-green-50 border-green-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Lowest Cost Vendor
                            </span>

                            <input type="checkbox" checked class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Auto-select cheapest approved vendor
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Emergency Procurement
                            </span>

                            <input type="checkbox" class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Override approval workflow if urgent
                        </p>

                    </div>

                </div>

            </div>

            <!-- ORDER ITEMS -->
            <div>

                <div class="flex items-center justify-between mb-5">

                    <h3 class="text-lg font-semibold text-slate-900">
                        Order Items
                    </h3>

                    <button type="button"
                            class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">
                        + Add Item
                    </button>

                </div>

                <div class="overflow-x-auto border rounded-2xl">

                    <table class="w-full text-sm">

                        <thead class="bg-slate-50 text-slate-600">
                            <tr>
                                <th class="text-left p-4">Item</th>
                                <th class="text-left p-4">Unit</th>
                                <th class="text-left p-4">Quantity</th>
                                <th class="text-left p-4">Unit Price</th>
                                <th class="text-left p-4">Total</th>
                                <th class="text-left p-4">Action</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y">

                            <tr>
                                <td class="p-4">
                                    <select class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                        <option>Chicken Breast</option>
                                    </select>
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="KG"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="number"
                                           value="40"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="₹ 320"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4 font-semibold">
                                    ₹ 12,800
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
                                        <option>Milk</option>
                                    </select>
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="L"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="number"
                                           value="25"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4">
                                    <input type="text"
                                           value="₹ 55"
                                           class="w-full rounded-lg border border-slate-300 px-3 py-2">
                                </td>

                                <td class="p-4 font-semibold">
                                    ₹ 1,375
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

            <!-- SUMMARY -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="bg-slate-50 rounded-2xl border p-5">
                    <p class="text-sm text-slate-500">Subtotal</p>
                    <h2 class="text-2xl font-bold mt-2">₹ 14,175</h2>
                </div>

                <div class="bg-slate-50 rounded-2xl border p-5">
                    <p class="text-sm text-slate-500">Tax</p>
                    <h2 class="text-2xl font-bold mt-2">₹ 1,500</h2>
                </div>

                <div class="bg-blue-600 text-white rounded-2xl p-5 shadow-lg">
                    <p class="text-sm text-blue-100">Grand Total</p>
                    <h2 class="text-3xl font-bold mt-2">₹ 15,675</h2>
                </div>

            </div>

            <!-- NOTES -->
            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Notes / Instructions
                </label>

                <textarea rows="4"
                          placeholder="Add procurement instructions..."
                          class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end gap-4 pt-4">

                <button type="button"
                        class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                    Save Draft
                </button>

                <a href="{{ route('procurements.viewData') }}"
                class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium shadow-lg transition duration-200">

                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2">

                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M5 13l4 4L19 7" />

                    </svg>

                    Submit Purchase Order
                </a>

            </div>

        </form>

    </div>

</div>

@endsection