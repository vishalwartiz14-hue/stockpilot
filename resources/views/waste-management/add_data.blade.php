
@extends('layouts.app')

@section('content')
<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Record Waste Entry
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Track spoiled inventory, kitchen waste, expired products & food loss
            </p>
        </div>

        <a href="{{ route('waste-management.viewData') }}"
           class="px-5 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white shadow-lg transition">
            ← Back
        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-2xl shadow border p-6">

        <form method="POST" action="{{ route('waste-management.addData') }}" class="space-y-6">

            <!-- BASIC DETAILS -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Waste Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                           Select Category
                        </label>

                        <select name="category_id" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                            <option value="">Select Category</option>
                           <?php  foreach($categories as $category): ?>
                                <option value="<?= $category->id ?>"><?= $category->name ?></option>
                           <?php endforeach; ?>
                        </select>
                         @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                    </div>

                    <!-- ITEM -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                        Item
                        </label>

                        <select name="item_id" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                            <option value="">Select Item</option>
                           <?php  foreach($items as $item): ?>
                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                           <?php endforeach; ?>
                        </select>
                         @error('item_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                    <!-- CATEGORY -->
                    

                    <!-- WASTE TYPE -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Waste Type
                        </label>

                        <select name="waste_type" class="w-full rounded-xl border border-slate-300 px-4 py-3">
                            <option value="">Select Waste Type</option>
                            <option value="expired_inventory">Expired Inventory</option>
                            <option value="kitchen_waste">Kitchen Waste</option>
                            <option value="spoilage">Spoilage</option>
                            <option value="plate_waste">Plate Waste</option>
                            <option value="damaged_inventory">Damaged Inventory</option>
                        </select>
                        @error('waste_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                    </div>

                </div>

            </div>

            <!-- QUANTITY -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Quantity & Cost
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-5">

                    <!-- QUANTITY -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Quantity
                        </label>

                        <input type="number"
                               name="quantity"
                               placeholder="25"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                   @error('quantity')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
                            </div>

                    <!-- UNIT -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Unit
                        </label>

                       <input type="text" readonly
                               name="unit"
                               placeholder="kg, liters, pieces"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                                 @error('unit')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Item Price
                        </label>

                        <input type="text" readonly
                               name="item_price"
                               placeholder=""
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                                 @error('item_price')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            </div>

                    <!-- COST -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Estimated Loss Value
                        </label>

                        <input type="text"
                               name="cost"
                               placeholder="₹ 5,000"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                                 @error('cost')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                            </div>

                    <!-- DATE -->
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Waste Date
                        </label>

                        <input type="date" name="waste_date"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3">
                     @error('waste_date')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                            </div>

                </div>

            </div>

            <!-- ROOT CAUSE -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Root Cause Analysis
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div class="p-4 rounded-xl border bg-red-50 border-red-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Overstocking
                            </span>

                            <input type="checkbox" name="root_cause[]" value="Overstocking" class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Excess inventory purchased
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Expired Stock
                            </span>

                            <input type="checkbox" class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Product exceeded shelf life
                        </p>

                    </div>

                    <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                        <div class="flex items-center justify-between">
                            <span class="font-medium text-slate-800">
                                Kitchen Damage
                            </span>

                            <input type="checkbox" class="h-5 w-5">
                        </div>

                        <p class="text-sm text-slate-500 mt-2">
                            Mishandling during preparation
                        </p>

                    </div>

                </div>

            </div>

            <!-- NOTES -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Additional Notes
                </h3>

                <textarea rows="5" name="notes" placeholder="Enter waste details, observations, corrective actions..."
                class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:outline-none"></textarea>
            </div>

            <!-- AI INSIGHTS -->
            <div>
                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    AI Waste Prevention Suggestions
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <div class="p-5 rounded-2xl border bg-blue-50 border-blue-100">

                        <h4 class="font-semibold text-blue-700">
                            Smarter Reordering
                        </h4>

                        <p class="text-sm text-slate-600 mt-2">
                            Reduce dairy order quantity by 15%.
                        </p>

                    </div>

                    <div class="p-5 rounded-2xl border bg-green-50 border-green-100">

                        <h4 class="font-semibold text-green-700">
                            Inventory Rotation
                        </h4>

                        <p class="text-sm text-slate-600 mt-2">
                            Apply FIFO strategy for perishables.
                        </p>

                    </div>

                    <div class="p-5 rounded-2xl border bg-yellow-50 border-yellow-100">

                        <h4 class="font-semibold text-yellow-700">
                            Expiry Prediction
                        </h4>

                        <p class="text-sm text-slate-600 mt-2">
                            5 inventory items nearing expiry.
                        </p>

                    </div>

                </div>

            </div>

            <!-- ACTION BUTTONS -->
            <div class="flex justify-end gap-4 pt-4">

                <a href="{{ route('waste-management.viewData') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                    Cancel
                </a>

                <input type="submit" value="Save Waste Entry" name="add_waste_record"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-semibold shadow-lg transition duration-200">
            </div>

        </form>

    </div>

</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
/*
|--------------------------------------------------------------------------
| CATEGORY CHANGE
|--------------------------------------------------------------------------
*/
$('select[name="category_id"]').on('change', function () {

    let categoryId = $(this).val();

    $('select[name="item_id"]').html(
        '<option value="">Loading...</option>'
    );
    $.ajax({
        url: '/get-items-by-category/' + categoryId,
        type: 'GET',
        success: function (response) {
            let options =
                '<option value="">Select Item</option>';
            response.forEach(function (item) {
                options += `
                    <option value="${item.id}"
                            data-price="${item.price}"
                            data-unit="${item.unit}">
                        ${item.name}
                    </option>
                `;
            });
            $('select[name="item_id"]').html(options);
        }
    });
});
/*
|--------------------------------------------------------------------------
| ITEM CHANGE
|--------------------------------------------------------------------------
*/
$('select[name="item_id"]').on('change', function () {

    let selectedOption  =   $(this).find(':selected');
    let price           =   selectedOption.data('price') || 0;
    let unit            =   selectedOption.data('unit') || '';
    $('input[name="item_price"]').val(price);
    $('input[name="unit"]').val(unit);
    calculateLoss();
});
/*
|--------------------------------------------------------------------------
| QUANTITY CHANGE
|--------------------------------------------------------------------------
*/
$('input[name="quantity"]').on('keyup change', function () {
    calculateLoss();
});
/*
|--------------------------------------------------------------------------
| CALCULATE LOSS
|--------------------------------------------------------------------------
*/
function calculateLoss(){
    let quantity = parseFloat($('input[name="quantity"]').val()) || 0;
    let price = parseFloat($('input[name="item_price"]').val()) || 0;
    let total = quantity * price;
    $('input[name="cost"]').val(total.toFixed(2));
}
</script>
@endsection