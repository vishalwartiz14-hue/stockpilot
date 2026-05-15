@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Waste Management & Food Loss Analytics
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Track spoilage, kitchen waste, sustainability metrics & AI waste reduction
            </p>
        </div>

        <div class="flex items-center gap-3">

            <!-- <button class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                Export Report
            </button> -->

            <a href="{{ route('waste-management.addData') }}" class="px-5 py-3 rounded-xl bg-red-600 hover:bg-red-700 text-white shadow-lg">
                + Record Waste
            </a>

        </div>

    </div>
@include('components.flash_message')
    <!-- KPI CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">
                Total Waste This Month
            </p>

            <h2 class="text-3xl font-bold mt-2 text-red-600">
               ₹ <?php echo $totalWasteThisMonth; ?>
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">
                Waste Cost
            </p>

            <h2 class="text-3xl font-bold mt-2 text-orange-500">
                ₹ <?php echo $total_waste_cost?>
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">
                Waste Reduction
            </p>

            <h2 class="text-3xl font-bold mt-2 text-green-600">
                <?php echo $wasteReduction; ?>%
            </h2>
        </div>

        <div class="bg-white rounded-2xl shadow border p-5">
            <p class="text-sm text-slate-500">
                Sustainability Score
            </p>

            <h2 class="text-3xl font-bold mt-2 text-blue-600">
                <?php echo $sustainabilityScore; ?>%
            </h2>
        </div>

    </div>

   <!-- MAIN GRID -->
<div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

    <!-- WASTE TRACKING TABLE -->
    <div class="xl:col-span-2 bg-white rounded-2xl shadow border overflow-hidden">

        <!-- HEADER -->
        <div class="p-5 border-b flex items-center justify-between">

            <div>
                <h3 class="font-semibold text-slate-900">
                    🗑 Waste Tracking
                </h3>

                <p class="text-sm text-slate-500">
                    Spoilage, expiry & kitchen waste monitoring
                </p>
            </div>

            <input type="text"
                   id="customSearch"
                   placeholder="Search waste logs..."
                   class="px-4 py-2 rounded-xl border border-slate-300 focus:ring-2 focus:ring-red-500 focus:outline-none">

        </div>

        <!-- TABLE -->
        <div class="overflow-x-auto">

            <table id="manage_waste" class="display w-full text-sm">

                <thead class="bg-slate-50 text-slate-600">
                    <tr>
                        <th class="text-left p-4">Inventory Item</th>
                        <th class="text-left p-4">Waste Type</th>
                        <th class="text-left p-4">Unit</th>
                        <th class="text-left p-4">Action</th>
                    </tr>
                </thead>

                <tbody class="divide-y">

                    <?php foreach($wastes as $waste) {

                        $itemDetails = DB::table('items')
                                        ->where('id', $waste->item_id)
                                        ->first();
                    ?>

                    <tr class="hover:bg-slate-50 transition">

                        <!-- ITEM -->
                        <td class="p-4">
                            <div>
                                <p class="font-medium">
                                    <?php echo $itemDetails ? $itemDetails->name : ''; ?>
                                </p>
                            </div>
                        </td>

                        <!-- WASTE TYPE -->
                        <td class="p-4 text-green-600 font-medium">
                            <?php echo $waste->waste_type; ?>
                        </td>

                        <!-- UNIT -->
                        <td class="p-4">
                            <?php echo $waste->unit; ?>
                        </td>

                        <!-- ACTION -->
                        <td class="p-4">

                            <a href="<?php echo url('edit-waste/'.$waste->id); ?>"
                               class="px-3 py-1 rounded-lg bg-blue-100 text-blue-600 mr-2 hover:bg-blue-200 transition">
                                Edit
                            </a>

                            <a href="<?php echo url('delete-waste/'.$waste->id); ?>"
                               onclick="return confirm('Are you sure you want to delete this waste record?')"
                               class="px-3 py-1 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition">
                                Delete
                            </a>

                        </td>

                    </tr>

                    <?php } ?>

                </tbody>

            </table>

        </div>

    </div>

    <!-- AI WASTE REDUCTION -->
    <div class="bg-white rounded-2xl shadow border p-6">

        <h3 class="font-semibold text-slate-900 mb-5">
            🤖 AI Waste Reduction
        </h3>

        <div class="space-y-4">

            <!-- CARD -->
            <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                <div class="flex items-center justify-between">
                    <span class="font-medium text-slate-800">
                        Overstock Prevention
                    </span>

                    <span class="text-blue-600 font-bold">
                        Active
                    </span>
                </div>

                <p class="text-sm text-slate-500 mt-2">
                    AI detected excess stock in dairy inventory.
                </p>

            </div>

            <!-- CARD -->
            <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                <div class="flex items-center justify-between">
                    <span class="font-medium text-slate-800">
                        Expiry Prediction
                    </span>

                    <span class="text-yellow-700 font-bold">
                        12 Alerts
                    </span>
                </div>

                <p class="text-sm text-slate-500 mt-2">
                    Inventory likely to expire within 3 days.
                </p>

            </div>

            <!-- CARD -->
            <div class="p-4 rounded-xl border bg-green-50 border-green-100">

                <div class="flex items-center justify-between">
                    <span class="font-medium text-slate-800">
                        Smarter Reordering
                    </span>

                    <span class="text-green-600 font-bold">
                        Optimized
                    </span>
                </div>

                <p class="text-sm text-slate-500 mt-2">
                    Reduced over-ordering by 18%.
                </p>

            </div>

        </div>

    </div>

</div>

<!-- DATATABLE SCRIPT -->
<script>
$(document).ready(function () {

    // Initialize DataTable
    var table = $('#manage_waste').DataTable({

        responsive: true,

        pageLength: 10,

        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],

        columnDefs: [
            {
                orderable: false,
                targets: [4]
            }
        ]

    });

    // Custom Search
    $('#customSearch').on('keyup', function () {
        table.search(this.value).draw();
    });

});
</script>

    <!-- SECOND GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        <!-- WASTE ANALYTICS -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="font-semibold text-slate-900">
                        📊 Waste Analytics
                    </h3>

                    <p class="text-sm text-slate-500">
                        Trend reports & root cause analysis
                    </p>
                </div>

                <button class="px-4 py-2 rounded-lg bg-slate-900 text-white text-sm">
                    View Reports
                </button>

            </div>

            <div class="space-y-4">

                <div class="border rounded-xl p-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h4 class="font-medium">
                                Highest Waste Category
                            </h4>

                            <p class="text-sm text-slate-500">
                                Fresh Produce
                            </p>
                        </div>

                        <span class="text-red-600 font-bold">
                            ₹ 18,000
                        </span>

                    </div>

                </div>

                <div class="border rounded-xl p-4">

                    <div class="flex items-center justify-between">

                        <div>
                            <h4 class="font-medium">
                                Root Cause Analysis
                            </h4>

                            <p class="text-sm text-slate-500">
                                Overstocking detected
                            </p>
                        </div>

                        <span class="px-3 py-1 rounded-full bg-red-100 text-red-600 text-xs">
                            Critical
                        </span>

                    </div>

                </div>

            </div>

        </div>

        <!-- SUSTAINABILITY -->
        <div class="bg-white rounded-2xl shadow border p-6">

            <div class="flex items-center justify-between mb-5">

                <div>
                    <h3 class="font-semibold text-slate-900">
                        🌱 Sustainability Metrics
                    </h3>

                    <p class="text-sm text-slate-500">
                        Environmental impact & waste reduction KPIs
                    </p>
                </div>

                <button class="px-4 py-2 rounded-lg bg-green-600 hover:bg-green-700 text-white text-sm">
                    Sustainability Report
                </button>

            </div>

            <div class="space-y-4">

                <div class="p-4 rounded-xl bg-green-50 border border-green-100">

                    <div class="flex items-center justify-between">
                        <h4 class="font-medium">
                            Carbon Footprint
                        </h4>

                        <span class="text-green-600 font-bold">
                            -12%
                        </span>
                    </div>

                    <p class="text-sm text-slate-500 mt-2">
                        Reduced food waste emissions this quarter.
                    </p>

                </div>

                <div class="p-4 rounded-xl bg-blue-50 border border-blue-100">

                    <div class="flex items-center justify-between">
                        <h4 class="font-medium">
                            Waste Reduction Target
                        </h4>

                        <span class="text-blue-600 font-bold">
                            82% Achieved
                        </span>
                    </div>

                    <p class="text-sm text-slate-500 mt-2">
                        Annual sustainability goal progress.
                    </p>

                </div>

            </div>

        </div>

    </div>

</div>


@endsection