{{-- resources/views/procurement/single_data.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="max-w-7xl mx-auto py-8 px-4">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold text-gray-800">
                Procurement Details
            </h1>

            <p class="text-gray-500 mt-1">
                Complete procurement information overview
            </p>
        </div>

        <div class="mt-4 md:mt-0 flex gap-3">

            <a href="{{ route('procurements.viewData') }}"
                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg shadow">
                All Procurements
            </a>

        </div>
    </div>

    <!-- Main Card -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">

        <!-- Banner -->
        <div class="bg-gradient-to-r from-indigo-500 to-blue-600 h-36 relative">

            <!-- ID Badge -->
            <div
                class="absolute left-8 -bottom-10 bg-white shadow-lg rounded-xl px-6 py-4 border">

                <p class="text-sm text-gray-500">
                    Procurement ID
                </p>

                <h2 class="text-2xl font-bold text-indigo-600">
                    #<?php echo $procurement->id; ?>
                </h2>
            </div>
        </div>

        <!-- Content -->
        <div class="pt-20 px-8 pb-8">

            <!-- Title & Status -->
            <div class="flex flex-col md:flex-row md:items-center md:justify-between">

                <div>

                    <h2 class="text-3xl font-bold text-gray-800">
                        Procurement Overview
                    </h2>

                    <p class="text-gray-500 mt-2">
                        Procurement Management Information
                    </p>

                </div>

                <!-- Status -->
                <div class="mt-4 md:mt-0">
                    <!-- status -->
                    
                </div>
            </div>

            <!-- Divider -->
            <hr class="my-8">

            <!-- Details Table -->
            <div class="overflow-x-auto">

                <table class="w-full border border-gray-200 rounded-lg overflow-hidden">

                    <tbody>

                        <tr class="border-b">
                            <th
                                class="bg-gray-100 text-left px-6 py-4 w-1/3 font-semibold text-gray-700">
                                Supplier Name
                            </th>

                            <td class="px-6 py-4 text-gray-800">
                                <?php echo $supplier->name ?? 'N/A'; ?>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th
                                class="bg-gray-100 text-left px-6 py-4 font-semibold text-gray-700">
                                Grand Total Amount
                            </th>

                            <td class="px-6 py-4 text-green-600 font-bold">
                                ₹ <?php echo number_format($procurement->grand_total, 2); ?>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th
                                class="bg-gray-100 text-left px-6 py-4 font-semibold text-gray-700">
                                Sub Total Amount
                            </th>

                            <td class="px-6 py-4 text-blue-600 font-bold">
                                ₹ <?php echo number_format($procurement->subtotal, 2); ?>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th
                                class="bg-gray-100 text-left px-6 py-4 font-semibold text-gray-700">
                                Expected Delivery Date
                            </th>

                            <td class="px-6 py-4 text-gray-800">
                                <?php echo print_date($procurement->expected_delivery_date); ?>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th
                                class="bg-gray-100 text-left px-6 py-4 font-semibold text-gray-700">
                                Created At
                            </th>

                            <td class="px-6 py-4 text-gray-800">
                                <?php echo print_date($procurement->created_at); ?>
                            </td>
                        </tr>

                        <tr class="border-b">
                            <th
                                class="bg-gray-100 text-left px-6 py-4 font-semibold text-gray-700">
                                Last Updated
                            </th>

                            <td class="px-6 py-4 text-gray-800">
                                <?php echo print_date($procurement->updated_at); ?>
                            </td>
                        </tr>

                        <tr>
                            <th
                                class="bg-gray-100 text-left px-6 py-4 font-semibold text-gray-700 align-top">
                                Description
                            </th>

                            <td class="px-6 py-4 text-gray-700 leading-relaxed">

                                <?php
                                    if(!empty($procurement->notes)){
                                        echo $procurement->notes;
                                    } else {
                                        echo "No description available.";
                                    }
                                ?>

                            </td>
                        </tr>

                    </tbody>

                </table>

            </div>

            <!-- Procurement Items Table -->
            <div class="mt-10">

                <h3 class="text-2xl font-bold text-gray-800 mb-5">
                    Procurement Items
                </h3>

                <div class="overflow-x-auto">

                    <table class="w-full border border-gray-200 rounded-lg overflow-hidden">

                        <thead class="bg-gray-100 text-gray-700">

                            <tr>
                                <th class="px-6 py-4 text-left">#</th>
                                <th class="px-6 py-4 text-left">Item Name</th>
                                <th class="px-6 py-4 text-left">Quantity</th>
                                <th class="px-6 py-4 text-left">Unit Price</th>
                                <th class="px-6 py-4 text-left">Total</th>
                            </tr>

                        </thead>

                        <tbody>

                            <?php if(!empty($items)){ ?>

                                <?php $i = 1; ?>

                                <?php foreach($items as $item){ 
                                   $itemDetails = DB::table('items')->where('id', $item->item_id)->first();   
                                    ?>

                                <tr class="border-t hover:bg-gray-50">

                                    <td class="px-6 py-4">
                                        <?php echo $i++; ?>
                                    </td>

                                    <td class="px-6 py-4 font-medium text-gray-800">
                                        <?php echo $itemDetails->name; ?>
                                    </td>

                                    <td class="px-6 py-4">
                                        <?php echo $item->quantity; ?>
                                    </td>

                                    <td class="px-6 py-4 ">
                                        ₹ <?php echo number_format($item->unit_price, 2); ?>
                                    </td>

                                   

                                    <td class="px-6 py-4 font-semibold text-green-600">
                                        ₹ <?php echo number_format($item->total, 2); ?>
                                    </td>

                                </tr>

                                <?php } ?>

                            <?php } else { ?>

                                <tr>
                                    <td colspan="6"
                                        class="text-center px-6 py-6 text-gray-500">
                                        No procurement items found.
                                    </td>
                                </tr>

                            <?php } ?>

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- Action Buttons -->
            <div class="flex flex-wrap gap-4 mt-10">

               

                <a href="{{ route('procurements.viewData') }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg shadow">
                    Back to List
                </a>

            </div>

        </div>
    </div>
</div>

@endsection