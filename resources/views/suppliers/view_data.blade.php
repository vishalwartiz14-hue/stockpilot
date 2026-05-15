@extends('layouts.app')

@section('content')
<?php
$UserLogindetails = auth()->user();
$supplier_add               =   DB::table('access')->where('module_name','suppliers')->where('role', $UserLogindetails->type)->where('add','1')->count();
$supplier_edit              =   DB::table('access')->where('module_name','suppliers')->where('role', $UserLogindetails->type)->where('edit','1')->count();
$supplier_delete            =   DB::table('access')->where('module_name','suppliers')->where('role', $UserLogindetails->type)->where('delete','1')->count();
?>

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Supplier & Vendor Management
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Manage supplier relationships, contracts, pricing & procurement performance
            </p>
        </div>
    <?php if($supplier_add != 0){?>
        <a href="{{ route('suppliers.addData') }}" class="px-5 py-3 rounded-xl bg-blue-600 hover:bg-blue-700 text-white shadow-lg">
            + Add Supplier
        </a>
<?php } ?>
    </div>
@include('components.flash_message')
    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Active Suppliers</p>
            <h2 class="text-3xl font-bold mt-2 text-slate-900"><?php echo $active_suppliers_count ?></h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Pending Deliveries</p>
            <h2 class="text-3xl font-bold mt-2 text-orange-500">9</h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Contract Renewals</p>
            <h2 class="text-3xl font-bold mt-2 text-red-500">4</h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">Avg Supplier Rating</p>
            <h2 class="text-3xl font-bold mt-2 text-green-600">4.8</h2>
        </div>

    </div>

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

        <!-- SUPPLIER TABLE -->
     <div class="xl:col-span-2 bg-white rounded-2xl shadow border overflow-hidden">

    <div class="p-5 border-b flex items-center justify-between">

        <div>
            <h3 class="font-semibold text-slate-900">
                🏢 Supplier Directory
            </h3>

            <p class="text-sm text-slate-500">
                Supplier database & procurement contacts
            </p>
        </div>

    </div>

    <div class="overflow-x-auto">

        <table id="manage_suppliers" class="display w-full text-sm">

            <thead class="bg-slate-50 text-slate-600">
                <tr>
                    <th class="text-left p-4">Supplier</th>
                    <th class="text-left p-4">Category</th>
                    <th class="text-left p-4">Delivery</th>
                    <th class="text-left p-4">Payment Terms</th>
                    <th class="text-left p-4">Status</th>
                    <th class="text-left p-4">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y">

                <?php foreach($suppliers as $supplier) {

                    $category_detail = DB::table('categories')
                                        ->where('id', $supplier->category_id)
                                        ->first();
                ?>

                <tr class="hover:bg-slate-50 transition">

                    <td class="p-4">
                        <div>
                            <p class="font-medium">
                                <?php echo $supplier->name; ?>
                            </p>

                            <p class="text-xs text-slate-500">
                                <?php echo $supplier->email; ?>
                            </p>
                        </div>
                    </td>

                    <td class="p-4">
                        <?php echo $category_detail ? $category_detail->name : ''; ?>
                    </td>

                    <td class="p-4 text-green-600 font-medium">
                        <?php echo $supplier->delivery_schedule; ?>
                    </td>

                    <td class="p-4">
                        <?php echo $supplier->payment_terms; ?>
                    </td>

                    <td class="p-4">
                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs">
                            Active
                        </span>
                    </td>

                    <td class="p-4">
                        <?php if($supplier_edit != 0){ ?>
                        <a href="{{ route('suppliers.edit-supplier', ['id' => urlencode(base64_encode($supplier->id))]) }}"
                        class="px-3 py-1 rounded-lg bg-blue-100 text-blue-600 mr-2">
                            Edit
                        </a>
                        <?php } ?>
                        <?php if($supplier_delete != 0){ ?>
                        <a href="{{ route('suppliers.viewData', ['delete_supplier' => base64_encode($supplier->id)]) }}"
                           onclick="return confirm('Are you sure you want to delete this supplier <?php echo $supplier->name; ?>?')"
                           class="px-3 py-1 rounded-lg bg-red-100 text-red-600">
                            Delete
                        </a>
                        <?php } ?>

                    </td>

                </tr>

                <?php } ?>

            </tbody>

        </table>

    </div>

</div>

<!-- DataTable Script -->
<script>
$(document).ready(function () {

    $('#manage_suppliers').DataTable({

        responsive: true,

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],

        columnDefs: [
            {
                orderable: false,
                targets: [5]
            }
        ]

    });

});
</script>


        <!-- ANALYTICS PANEL -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <h3 class="font-semibold text-slate-900 mb-5">
                📊 Supplier Performance
            </h3>

            <div class="space-y-4">

                <div class="p-4 rounded-xl border bg-green-50 border-green-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            Delivery Accuracy
                        </span>

                        <span class="text-green-600 font-bold">
                            96%
                        </span>
                    </div>

                </div>

                <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            Fulfillment Rate
                        </span>

                        <span class="text-blue-600 font-bold">
                            92%
                        </span>
                    </div>

                </div>

                <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            Avg Delivery Delay
                        </span>

                        <span class="text-yellow-700 font-bold">
                            1.2 Days
                        </span>
                    </div>

                </div>

                <div class="p-4 rounded-xl border bg-red-50 border-red-100">

                    <div class="flex items-center justify-between">
                        <span class="font-medium text-slate-800">
                            Contract Expiry Alerts
                        </span>

                        <span class="text-red-600 font-bold">
                            4 Contracts
                        </span>
                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- CONTRACTS + COMMUNICATION -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- CONTRACT MANAGEMENT -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="font-semibold text-slate-900">
                        📄 Contract Management
                    </h3>

                    <p class="text-sm text-slate-500">
                        Supplier agreements & SLA monitoring
                    </p>
                </div>

                <button class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm">
                    Manage Contracts
                </button>

            </div>

            <div class="space-y-4">

                <div class="border rounded-xl p-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h4 class="font-medium">FreshFarm Annual Contract</h4>
                            <p class="text-sm text-slate-500">
                                Renewal: 12 Aug 2026
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-green-100 text-green-600 text-xs">
                            Active
                        </span>

                    </div>

                </div>

                <div class="border rounded-xl p-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h4 class="font-medium">DairyPro Pricing Agreement</h4>
                            <p class="text-sm text-slate-500">
                                Renewal: 2 Jun 2026
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs">
                            Expiring Soon
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- SUPPLIER COMMUNICATION -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="font-semibold text-slate-900">
                        💬 Supplier Communication
                    </h3>

                    <p class="text-sm text-slate-500">
                        Messages, delivery updates & notifications
                    </p>
                </div>

                <button class="px-4 py-2 rounded-lg bg-blue-600 hover:bg-blue-700 text-white text-sm">
                    New Message
                </button>

            </div>

            <div class="space-y-4">

                <div class="p-4 rounded-xl bg-slate-50 border">

                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium">FreshFarm Foods</h4>
                        <span class="text-xs text-slate-400">
                            10 mins ago
                        </span>
                    </div>

                    <p class="text-sm text-slate-600">
                        Delivery truck dispatched successfully.
                    </p>

                </div>

                <div class="p-4 rounded-xl bg-slate-50 border">

                    <div class="flex items-center justify-between mb-2">
                        <h4 class="font-medium">DairyPro Ltd</h4>
                        <span class="text-xs text-slate-400">
                            1 hour ago
                        </span>
                    </div>

                    <p class="text-sm text-slate-600">
                        Updated milk pricing shared with procurement team.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>

@endsection