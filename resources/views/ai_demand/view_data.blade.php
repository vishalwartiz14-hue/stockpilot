@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- HEADER -->
    <div>
        <h1 class="text-2xl font-bold text-slate-900">AI Demand Forecasting</h1>
        <p class="text-sm text-slate-500">Predict inventory demand using AI, sales data & external signals</p>
    </div>

    <!-- TOP METRICS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Forecast Accuracy</p>
            <h2 class="text-2xl font-bold text-green-600">92%</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Predicted Orders</p>
            <h2 class="text-2xl font-bold text-blue-600">128 Items</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Stock Risk Items</p>
            <h2 class="text-2xl font-bold text-red-600">7 Items</h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">AI Confidence</p>
            <h2 class="text-2xl font-bold text-indigo-600">High</h2>
        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- FORECAST CHART -->
        <div class="lg:col-span-2 bg-white p-6 rounded-2xl shadow border">
            <h3 class="font-semibold text-slate-800 mb-4">📈 Sales Forecast Trend</h3>

            <div class="h-64 flex items-center justify-center text-slate-400 border-2 border-dashed rounded-xl">
                Chart Area (AI Forecast Graph)
            </div>
        </div>

        <!-- INSIGHTS PANEL -->
        <div class="bg-white p-6 rounded-2xl shadow border">

            <h3 class="font-semibold text-slate-800 mb-4">🧠 AI Insights</h3>

            <div class="space-y-3 text-sm">

                <div class="p-3 rounded-xl bg-blue-50 border border-blue-100">
                    📊 Demand increase expected in <b>Lunch hours</b> (+18%)
                </div>

                <div class="p-3 rounded-xl bg-yellow-50 border border-yellow-100">
                    🌧 Rain forecast → Beverage sales may drop
                </div>

                <div class="p-3 rounded-xl bg-red-50 border border-red-100">
                    ⚠ Tomato stock will run out in 2.3 days
                </div>

                <div class="p-3 rounded-xl bg-green-50 border border-green-100">
                    📦 Recommended reorder: Chicken 25kg
                </div>

            </div>

        </div>

    </div>

    <!-- PREDICTION TABLE -->
    <div class="bg-white rounded-2xl shadow border overflow-hidden">

        <div class="p-4 border-b">
            <h3 class="font-semibold">📦 AI Reorder Recommendations</h3>
        </div>

        <table class="w-full text-sm">

            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="text-left p-3">Item</th>
                    <th class="text-left p-3">Current Stock</th>
                    <th class="text-left p-3">Predicted Demand</th>
                    <th class="text-left p-3">Suggested Order</th>
                    <th class="text-left p-3">Risk</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <tr>
                    <td class="p-3 font-medium">Chicken</td>
                    <td class="p-3">12 KG</td>
                    <td class="p-3">45 KG</td>
                    <td class="p-3 text-blue-600 font-semibold">+35 KG</td>
                    <td class="p-3 text-red-500">High</td>
                </tr>

                <tr>
                    <td class="p-3 font-medium">Milk</td>
                    <td class="p-3">20 L</td>
                    <td class="p-3">50 L</td>
                    <td class="p-3 text-blue-600 font-semibold">+30 L</td>
                    <td class="p-3 text-yellow-500">Medium</td>
                </tr>

                <tr>
                    <td class="p-3 font-medium">Tomato</td>
                    <td class="p-3">5 KG</td>
                    <td class="p-3">25 KG</td>
                    <td class="p-3 text-blue-600 font-semibold">+20 KG</td>
                    <td class="p-3 text-red-500">Critical</td>
                </tr>

            </tbody>

        </table>

    </div>

</div>

@endsection