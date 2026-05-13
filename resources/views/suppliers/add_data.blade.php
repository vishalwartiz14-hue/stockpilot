
@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Add Supplier
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Create supplier profile, contracts & procurement settings
            </p>
        </div>

        <a href="{{ route('suppliers.viewData') }}"
           class="px-5 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white shadow-lg transition">
            ← Back to Suppliers
        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-2xl shadow border p-6">

        <form action="{{ route('suppliers.addData') }}" method="POST" class="space-y-8">

            <!-- BASIC DETAILS -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Supplier Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <!-- SUPPLIER NAME -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Supplier Name
                        </label>

                        <input type="text" name="supplier_name"
                               placeholder="Enter supplier name"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                @error('supplier_name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                                </div>

                                <!-- COMPANY -->
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-2">
                                        Company Name
                                    </label>

                                    <input type="text" name="company_name"
                                        placeholder="Enter company name"
                                        class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                                        @error('company_name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- EMAIL -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Email Address
                        </label>

                        <input type="email" name="email"
                               placeholder="supplier@email.com"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                               @error('email')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                    <!-- PHONE -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Phone Number
                        </label>

                        <input type="text" name="phone"
                               placeholder="+91 9876543210"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    @error('phone')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                            </div>


                            <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Status
                        </label>

                       <select name="status" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                         @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                            </div>

                </div>

            </div>

            <!-- CATEGORY & DELIVERY -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Supply Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <!-- CATEGORY -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Supplier Category
                        </label>

                        <select name="supplier_category_id" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option>Select Category</option>
                            <?php foreach($supplier_categories as $category): ?>
                                <option value="<?php echo $category->id ?>"><?php echo $category->name ?></option>
                            <?php endforeach; ?>
                        </select>
                         @error('supplier_category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                    <!-- DELIVERY SCHEDULE -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Delivery Schedule
                        </label>

                        <select name="delivery_schedule" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Select Schedule</option>
                            <option value="daily">Daily</option>
                            <option value="weekly">Weekly</option>
                            <option value="bi-weekly">Bi-Weekly</option>
                            <option value="monthly">Monthly</option>
                        </select>
                         @error('delivery_schedule')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                    <!-- PAYMENT TERMS -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Payment Terms
                        </label>

                        <select name="payment_terms" class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="">Select Terms</option>
                            <option value="advance">Advance Payment</option>
                            <option value="net-7">Net 7 Days</option>
                            <option value="net-15">Net 15 Days</option>
                            <option value="net-30">Net 30 Days</option>
                        </select>
                         @error('payment_terms')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                </div>

            </div>

            <!-- ADDRESS -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Address Details
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Street Address
                        </label>

                        <textarea rows="3" name="street_address"
                                  placeholder="Enter supplier address"
                                  class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                         @error('street_address')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            City
                        </label>

                        <input type="text" name="city"
                               placeholder="City"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                     @error('city')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                            </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            State
                        </label>

                        <input type="text" name="state"
                               placeholder="State"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                     @error('state')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                            </div>

                </div>

            </div>

            <!-- CONTRACT SETTINGS -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Contract & SLA
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Contract Start Date
                        </label>

                        <input type="date" name="contract_start_date"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                    @error('contract_start_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                            </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Contract End Date
                        </label>

                        <input type="date" name="contract_end_date"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                    @error('contract_end_date')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                            </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            SLA Level
                        </label>

                        <select name="sla_level" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                            <option>Standard</option>
                            <option>Premium</option>
                            <option>Enterprise</option>
                        </select>
                        @error('sla_level')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                </div>

            </div>

            <!-- SUPPLIER PORTAL -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Supplier Portal Access
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Portal Access
                            </span>

                            <input type="checkbox" name="portal_access" checked class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Allow supplier dashboard access
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-green-50 border-green-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Invoice Upload
                            </span>

                            <input type="checkbox" checked class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Enable invoice submission
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Inventory Updates
                            </span>

                            <input type="checkbox" name="inventory_updates" class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Share stock availability updates
                        </p>

                    </div>

                </div>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end gap-4 pt-4">

                <a href="{{ route('suppliers.viewData') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                    Cancel
                </a>

                <input type="submit" name="add_supplier_btn" value="Save Supplier"
                   class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white shadow-lg">
          
            </div>

        </form>

    </div>

</div>

@endsection