@extends('layouts.app')

@section('content')
<?php 
$UserLogindetails = auth()->user();
$total_procurements = DB::table('procurements')->count();
$total_suppliers = DB::table('suppliers')->count(); 
$active_suppliers = DB::table('suppliers')->where('status', 'Active')->count();
$pending_suppliers = DB::table('suppliers')->where('status', 'Inactive')->count();
?>
<div class="min-h-screen bg-slate-50 p-6">

    <!-- HEADER -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-slate-900">
                Dashboard
            </h1>

            <p class="text-slate-500 mt-1">
                AI Restaurant Inventory & Procurement Overview
            </p>
        </div>

        <div class="mt-4 md:mt-0 flex gap-3">

            <a href="{{ route('procurements.addData') }}"
               class="px-5 py-2 bg-blue-600 text-white rounded-xl shadow hover:bg-blue-700">
                + New Order
            </a>

            <a href="{{ route('procurements.viewData') }}"
               class="px-5 py-2 bg-slate-900 text-white rounded-xl shadow hover:bg-slate-800">
                View Orders
            </a>

        </div>

    </div>
    
    <!-- STATS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Total Orders</p>
            <h2 class="text-2xl font-bold text-blue-600 mt-1"><?php echo $total_procurements; ?></h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Total Suppliers</p>
            <h2 class="text-2xl font-bold text-yellow-600 mt-1"><?php echo $total_suppliers; ?></h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Active Suppliers</p>
            <h2 class="text-2xl font-bold text-green-600 mt-1"><?php echo $active_suppliers; ?></h2>
        </div>

        <div class="bg-white p-5 rounded-2xl shadow border">
            <p class="text-sm text-slate-500">Inactive Suppliers</p>
            <h2 class="text-2xl font-bold text-red-600 mt-1"><?php echo $pending_suppliers; ?></h2>
        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: RECENT ORDERS -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow border p-5">

        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        <!-- LEFT: RECENT ORDERS -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow border p-5">

            <h3 class="text-lg font-semibold text-slate-900 mb-4">
                Recent Purchase Orders
            </h3>

            <table class="w-full text-sm">

                <thead class="text-left text-slate-500 border-b">
                    <tr>
                        <th class="py-2">PO Number</th>
                        <th>Supplier</th>
                        <th>Status</th>
                        <th>Total</th>
                    </tr>
                </thead>

                <tbody>

                    <tr class="border-b">
                        <td class="py-3">PO-1001</td>
                        <td>Fresh Foods Ltd</td>
                        <td><span class="text-green-600">Completed</span></td>
                        <td>₹ 12,500</td>
                    </tr>

                    <tr class="border-b">
                        <td class="py-3">PO-1002</td>
                        <td>ABC Suppliers</td>
                        <td><span class="text-yellow-600">Pending</span></td>
                        <td>₹ 8,200</td>
                    </tr>

                    <tr>
                        <td class="py-3">PO-1003</td>
                        <td>Global Foods</td>
                        <td><span class="text-red-600">Cancelled</span></td>
                        <td>₹ 5,400</td>
                    </tr>

                </tbody>

            </table>

        </div>

        <!-- RIGHT: AI PANEL -->
        <div class="bg-slate-900 text-white rounded-2xl shadow p-6">

            <h3 class="text-lg font-semibold mb-4">
                🤖 AI Insights
            </h3>

            <div class="space-y-4 text-sm text-slate-300">

                <div class="p-4 bg-slate-800 rounded-xl">
                    Tomatoes stock low — reorder recommended in 2 days
                </div>

                <div class="p-4 bg-slate-800 rounded-xl">
                    Oil consumption increased by 18% this week
                </div>

                <div class="p-4 bg-slate-800 rounded-xl">
                    Supplier "Fresh Foods" has best price trend
                </div>

            </div>

        </div>

    </div>

    <!-- FOOTER -->
    <div class="text-center text-sm text-slate-500 mt-10">
        © {{ date('Y') }} AI Restaurant Inventory System
    </div>

</div>

@endsection