{{-- resources/views/waste-management/edit_data.blade.php --}}

@extends('layouts.app')

@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="space-y-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Edit Waste Entry
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Update spoiled inventory, expired stock & waste records
            </p>
        </div>

        <a href="{{ route('waste-management.viewData') }}"
           class="px-5 py-3 rounded-xl bg-slate-900 hover:bg-slate-800 text-white shadow-lg transition">
            ← Back
        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-2xl shadow border p-6">

        <form method="POST"
              action="{{ route('waste-management.editData', ['id' => $waste->id]) }}"
              class="space-y-6">

            @csrf
            @method('PUT')

            <!-- BASIC DETAILS -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Waste Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                    <!-- CATEGORY -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Select Category
                        </label>

                        <select name="category_id"
                                class="categorySelect w-full rounded-xl border border-slate-300 px-4 py-3">

                            <option value="">Select Category</option>

                            @foreach($categories as $category)

                                <option value="{{ $category->id }}"
                                    {{ $category->id == $waste->category_id ? 'selected' : '' }}>

                                    {{ $category->name }}

                                </option>

                            @endforeach

                        </select>

                        @error('category_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- ITEM -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Inventory Item
                        </label>

                        <select name="item_id"
                                data-selected="{{ $waste->item_id }}"
                                class="itemSelect w-full rounded-xl border border-slate-300 px-4 py-3">

                            <option value="">Select Item</option>

                        </select>

                        @error('item_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- WASTE TYPE -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Waste Type
                        </label>

                        <select name="waste_type"
                                class="w-full rounded-xl border border-slate-300 px-4 py-3">

                            <option value="">Select Waste Type</option>

                            <option value="expired_inventory"
                                {{ $waste->waste_type == 'expired_inventory' ? 'selected' : '' }}>
                                Expired Inventory
                            </option>

                            <option value="kitchen_waste"
                                {{ $waste->waste_type == 'kitchen_waste' ? 'selected' : '' }}>
                                Kitchen Waste
                            </option>

                            <option value="spoilage"
                                {{ $waste->waste_type == 'spoilage' ? 'selected' : '' }}>
                                Spoilage
                            </option>

                            <option value="plate_waste"
                                {{ $waste->waste_type == 'plate_waste' ? 'selected' : '' }}>
                                Plate Waste
                            </option>

                            <option value="damaged_inventory"
                                {{ $waste->waste_type == 'damaged_inventory' ? 'selected' : '' }}>
                                Damaged Inventory
                            </option>

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
                               value="{{ $waste->quantity }}"
                               class="quantity w-full rounded-xl border border-slate-300 px-4 py-3">

                        @error('quantity')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- UNIT -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Unit
                        </label>

                        <input type="text"
                               readonly
                               name="unit"
                               value="{{ $waste->unit }}"
                               class="unit w-full rounded-xl border border-slate-300 px-4 py-3">

                        @error('unit')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- ITEM PRICE -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Item Price
                        </label>

                        <input type="text"
                               readonly
                               name="item_price"
                               value="{{ $waste->item_price }}"
                               class="itemPrice w-full rounded-xl border border-slate-300 px-4 py-3">

                    </div>

                    <!-- COST -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Estimated Loss Value
                        </label>

                        <input type="text"
                               readonly
                               name="cost"
                               value="{{ $waste->cost }}"
                               class="cost w-full rounded-xl border border-slate-300 px-4 py-3">

                        @error('cost')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- DATE -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Waste Date
                        </label>

                        <input type="date"
                               name="waste_date"
                               value="{{ $waste->waste_date }}"
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

                            <input type="checkbox"
                                   name="root_cause[]"
                                   value="Overstocking"
                                   class="h-5 w-5"
                                   >

                        </div>

                    </div>

                    <div class="p-4 rounded-xl border bg-yellow-50 border-yellow-100">

                        <div class="flex items-center justify-between">

                            <span class="font-medium text-slate-800">
                                Expired Stock
                            </span>

                            <input type="checkbox"
                                   name="root_cause[]"
                                   value="Expired Stock"
                                   class="h-5 w-5"
                                  >

                        </div>

                    </div>

                    <div class="p-4 rounded-xl border bg-blue-50 border-blue-100">

                        <div class="flex items-center justify-between">

                            <span class="font-medium text-slate-800">
                                Kitchen Damage
                            </span>

                            <input type="checkbox"
                                   name="root_cause[]"
                                   value="Kitchen Damage"
                                   class="h-5 w-5"
                                  >

                        </div>

                    </div>

                </div>

            </div>

            <!-- NOTES -->
            <div>

                <h3 class="text-lg font-semibold text-slate-900 mb-5">
                    Additional Notes
                </h3>

                <textarea rows="5"
                          name="notes"
                          class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-red-500 focus:outline-none">{{ $waste->notes }}</textarea>

            </div>

            <!-- BUTTONS -->
            <div class="flex justify-end gap-4 pt-4">

                <a href="{{ route('waste-management.viewData') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                    Cancel
                </a>

                <input type="submit"
                       value="Update Waste Entry"
                       name="edit_waste_record"
                       class="inline-flex items-center gap-2 px-6 py-3 rounded-xl bg-gradient-to-r from-red-600 to-rose-600 hover:from-red-700 hover:to-rose-700 text-white font-semibold shadow-lg transition duration-200">

            </div>

        </form>

    </div>

</div>

<script>

/*
|--------------------------------------------------------------------------
| PAGE LOAD
|--------------------------------------------------------------------------
*/

$(document).ready(function () {

    loadItemsByCategory();
});

/*
|--------------------------------------------------------------------------
| LOAD ITEMS BY CATEGORY
|--------------------------------------------------------------------------
*/

function loadItemsByCategory()
{
    let categoryId = $('.categorySelect').val();

    if(categoryId == ''){
        return;
    }

    $.ajax({

        url: '/get-items-by-category/' + categoryId,

        type: 'GET',

        success: function (response) {

            let selectedItem = $('.itemSelect').data('selected');

            let options = '<option value="">Select Item</option>';

            response.forEach(function (item) {

                let selected = '';

                if(selectedItem == item.id){
                    selected = 'selected';
                }

                options += `
                    <option value="${item.id}"
                            data-price="${item.price}"
                            data-unit="${item.unit}"
                            ${selected}>
                        ${item.name}
                    </option>
                `;
            });

            $('.itemSelect').html(options);

            updateItemDetails();
        }
    });
}

/*
|--------------------------------------------------------------------------
| CATEGORY CHANGE
|--------------------------------------------------------------------------
*/

$('.categorySelect').on('change', function () {

    $('.itemSelect').attr('data-selected', '');

    loadItemsByCategory();
});

/*
|--------------------------------------------------------------------------
| ITEM CHANGE
|--------------------------------------------------------------------------
*/

$(document).on('change', '.itemSelect', function () {

    updateItemDetails();
});

/*
|--------------------------------------------------------------------------
| QUANTITY CHANGE
|--------------------------------------------------------------------------
*/

$(document).on('input', '.quantity', function () {

    calculateCost();
});

/*
|--------------------------------------------------------------------------
| UPDATE ITEM DETAILS
|--------------------------------------------------------------------------
*/

function updateItemDetails()
{
    let selectedOption = $('.itemSelect option:selected');

    let price = selectedOption.data('price') || 0;

    let unit = selectedOption.data('unit') || '';

    $('.unit').val(unit);

    $('.itemPrice').val(price);

    calculateCost();
}

/*
|--------------------------------------------------------------------------
| CALCULATE COST
|--------------------------------------------------------------------------
*/

function calculateCost()
{
    let quantity = parseFloat($('.quantity').val()) || 0;

    let price = parseFloat($('.itemPrice').val()) || 0;

    let total = quantity * price;

    $('.cost').val(total.toFixed(2));
}

</script>

@endsection