{{-- resources/views/procurement/edit_data.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="space-y-6">

    <!-- PAGE HEADER -->
    <div class="flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-bold text-slate-900">
                Edit Purchase Order
            </h1>

            <p class="text-sm text-slate-500 mt-1">
                Update procurement purchase order details
            </p>
        </div>

        <a href="{{ route('procurements.viewData') }}"
           class="px-4 py-2 rounded-xl bg-slate-900 text-white hover:bg-slate-800 transition">
            ← Back to Orders
        </a>

    </div>

    <!-- FORM -->
    <div class="bg-white rounded-2xl shadow border p-6">

        <form action="{{ route('procurements.editData', $procurement->id) }}"
              method="POST"
              class="space-y-8">

            @csrf
            @method('PUT')

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
                               name="po_number"
                               value="{{ old('po_number', $procurement->po_number) }}"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                    </div>

                    <!-- SUPPLIER -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Supplier
                        </label>

                        <select name="supplier_id"
                                class="supplierSelect w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

                            <option value="">Select Supplier</option>

                            @foreach ($suppliers as $supplier)

                                <option value="{{ $supplier->id }}"
                                    {{ $procurement->supplier_id == $supplier->id ? 'selected' : '' }}>

                                    {{ $supplier->name }}

                                </option>

                            @endforeach

                        </select>

                    </div>

                    <!-- DELIVERY DATE -->
                    <div>

                        <label class="block text-sm font-medium text-slate-700 mb-2">
                            Expected Delivery
                        </label>

                        <input type="date"
                               name="expected_delivery_date"
                               value="{{ old('expected_delivery_date', $procurement->expected_delivery_date) }}"
                               class="w-full rounded-xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">

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
                            id="addRowBtn"
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

                        <tbody id="itemBody">

                            @php $rowIndex = 0; @endphp

                            @foreach($procurement_items as $procurement_item)

                            <tr class="item-row">

                                <!-- ITEM -->
                                <td class="p-4">

                                    <select name="items[{{ $rowIndex }}][item_id]"
                                            class="item-select w-full rounded-lg border border-slate-300 px-3 py-2">

                                        <option value="">Select Item</option>

                                        @foreach ($items as $item)

                                            <option value="{{ $item->id }}"
                                                    data-price="{{ $item->price }}"
                                                    data-unit="{{ $item->unit }}"
                                                    {{ $procurement_item->item_id == $item->id ? 'selected' : '' }}>

                                                {{ $item->name }}

                                            </option>

                                        @endforeach

                                    </select>

                                </td>

                                <!-- UNIT -->
                                <td class="p-4">

                                    <input type="text"
                                           name="items[{{ $rowIndex }}][unit]"
                                           value="{{ $procurement_item->unit }}"
                                           class="unit w-full rounded-lg border border-slate-300 px-3 py-2"
                                           readonly>

                                </td>

                                <!-- QTY -->
                                <td class="p-4">

                                    <input type="number"
                                           min="1"
                                           value="{{ $procurement_item->quantity }}"
                                           name="items[{{ $rowIndex }}][quantity]"
                                           class="qty w-full rounded-lg border border-slate-300 px-3 py-2">

                                </td>

                                <!-- PRICE -->
                                <td class="p-4">

                                    <input type="number"
                                           step="0.01"
                                           min="0"
                                           value="{{ $procurement_item->unit_price }}"
                                           name="items[{{ $rowIndex }}][unit_price]"
                                           class="price w-full rounded-lg border border-slate-300 px-3 py-2"
                                           readonly>

                                </td>

                                <!-- TOTAL -->
                                <td class="p-4 font-semibold total">
                                    ₹ {{ number_format($procurement_item->total, 2) }}
                                </td>

                                <!-- ACTION -->
                                <td class="p-4">

                                    <button type="button"
                                            class="removeRow px-3 py-1 rounded-lg bg-red-100 text-red-600">
                                        Remove
                                    </button>

                                </td>

                            </tr>

                            @php $rowIndex++; @endphp

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <!-- SUMMARY -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-5">

                <div class="bg-slate-50 rounded-2xl border p-5">

                    <p class="text-sm text-slate-500">
                        Subtotal
                    </p>

                    <h2 class="text-2xl font-bold mt-2" id="subtotal">
                        ₹ {{ number_format($procurement->subtotal, 2) }}
                    </h2>

                </div>

                <div class="bg-slate-50 rounded-2xl border p-5">

                    <p class="text-sm text-slate-500">
                        Tax (10%)
                    </p>

                    <h2 class="text-2xl font-bold mt-2" id="tax">
                        ₹ {{ number_format($procurement->tax, 2) }}
                    </h2>

                </div>

                <div class="bg-blue-600 text-white rounded-2xl p-5 shadow-lg">

                    <p class="text-sm text-blue-100">
                        Grand Total
                    </p>

                    <h2 class="text-3xl font-bold mt-2" id="grandTotal">
                        ₹ {{ number_format($procurement->grand_total, 2) }}
                    </h2>

                </div>

            </div>

            <!-- NOTES -->
            <div>

                <label class="block text-sm font-medium text-slate-700 mb-2">
                    Notes / Instructions
                </label>

                <textarea rows="4"
                          name="notes"
                          class="w-full rounded-2xl border border-slate-300 px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">{{ $procurement->notes }}</textarea>

            </div>

            <!-- BUTTONS -->
            <div class="flex justify-end gap-4 pt-4">

                <a href="{{ route('procurements.viewData') }}"
                   class="px-5 py-3 rounded-xl border border-slate-300 hover:bg-slate-50 transition">
                    Cancel
                </a>

                <input type="submit"
                       value="Update Purchase Order"
                       name="update_procurement"
                       class="px-6 py-3 rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-medium shadow-lg transition duration-200">

            </div>

        </form>

    </div>

</div>

<script>

let rowIndex = {{ count($procurement_items) }};

let supplierItems = [];

/*
|--------------------------------------------------------------------------
| LOAD SUPPLIER ITEMS ON PAGE LOAD
|--------------------------------------------------------------------------
*/

$(document).ready(function(){

    let supplierId = $('.supplierSelect').val();

    if(supplierId){

        loadSupplierItems(supplierId);
    }

    refreshItemDropdowns();
});

/*
|--------------------------------------------------------------------------
| SUPPLIER CHANGE
|--------------------------------------------------------------------------
*/

$('.supplierSelect').on('change', function(){

    let supplierId = $(this).val();

    loadSupplierItems(supplierId);

    $('#itemBody').html('');

    calculateTotals();
});

/*
|--------------------------------------------------------------------------
| LOAD ITEMS AJAX
|--------------------------------------------------------------------------
*/

function loadSupplierItems(supplierId)
{
    $.ajax({

        url: '/get-items-by-supplier/' + supplierId,

        type: 'GET',

        success: function(response){

            supplierItems = response;
        }
    });
}

/*
|--------------------------------------------------------------------------
| ADD NEW ROW
|--------------------------------------------------------------------------
*/

$('#addRowBtn').on('click', function(){

    let options = `<option value="">Select Item</option>`;

    supplierItems.forEach(function(item){

        options += `
            <option value="${item.id}"
                    data-price="${item.price}"
                    data-unit="${item.unit}">

                ${item.name}

            </option>
        `;
    });

    let row = `
        <tr class="item-row">

            <td class="p-4">

                <select name="items[${rowIndex}][item_id]"
                        class="item-select w-full rounded-lg border border-slate-300 px-3 py-2">

                    ${options}

                </select>

            </td>

            <td class="p-4">

                <input type="text"
                       name="items[${rowIndex}][unit]"
                       class="unit w-full rounded-lg border border-slate-300 px-3 py-2"
                       readonly>

            </td>

            <td class="p-4">

                <input type="number"
                       min="1"
                       value="1"
                       name="items[${rowIndex}][quantity]"
                       class="qty w-full rounded-lg border border-slate-300 px-3 py-2">

            </td>

            <td class="p-4">

                <input type="number"
                       step="0.01"
                       min="0"
                       name="items[${rowIndex}][unit_price]"
                       class="price w-full rounded-lg border border-slate-300 px-3 py-2"
                       readonly>

            </td>

            <td class="p-4 font-semibold total">
                ₹ 0.00
            </td>

            <td class="p-4">

                <button type="button"
                        class="removeRow px-3 py-1 rounded-lg bg-red-100 text-red-600">
                    Remove
                </button>

            </td>

        </tr>
    `;

    $('#itemBody').append(row);

    rowIndex++;

    refreshItemDropdowns();
});

/*
|--------------------------------------------------------------------------
| REMOVE ROW
|--------------------------------------------------------------------------
*/

$(document).on('click', '.removeRow', function(){

    $(this).closest('tr').remove();

    calculateTotals();

    refreshItemDropdowns();
});

/*
|--------------------------------------------------------------------------
| ITEM CHANGE
|--------------------------------------------------------------------------
*/

$(document).on('change', '.item-select', function(){

    let row = $(this).closest('tr');

    let selectedOption = $(this).find(':selected');

    let price = selectedOption.data('price') || 0;

    let unit = selectedOption.data('unit') || '';

    row.find('.price').val(price);

    row.find('.unit').val(unit);

    calculateRow(row);

    calculateTotals();

    refreshItemDropdowns();
});

/*
|--------------------------------------------------------------------------
| QTY CHANGE
|--------------------------------------------------------------------------
*/

$(document).on('input', '.qty', function(){

    let row = $(this).closest('tr');

    calculateRow(row);

    calculateTotals();
});

/*
|--------------------------------------------------------------------------
| CALCULATE SINGLE ROW
|--------------------------------------------------------------------------
*/

function calculateRow(row)
{
    let qty =
        parseFloat(row.find('.qty').val()) || 0;

    let price =
        parseFloat(row.find('.price').val()) || 0;

    let total = qty * price;

    row.find('.total').text(
        '₹ ' + total.toFixed(2)
    );
}

/*
|--------------------------------------------------------------------------
| CALCULATE TOTALS
|--------------------------------------------------------------------------
*/

function calculateTotals()
{
    let subtotal = 0;

    $('.item-row').each(function(){

        let qty =
            parseFloat($(this).find('.qty').val()) || 0;

        let price =
            parseFloat($(this).find('.price').val()) || 0;

        subtotal += qty * price;
    });

    let tax = subtotal * 0.10;

    let grandTotal = subtotal + tax;

    $('#subtotal').text(
        '₹ ' + subtotal.toFixed(2)
    );

    $('#tax').text(
        '₹ ' + tax.toFixed(2)
    );

    $('#grandTotal').text(
        '₹ ' + grandTotal.toFixed(2)
    );
}

/*
|--------------------------------------------------------------------------
| DISABLE DUPLICATE ITEMS
|--------------------------------------------------------------------------
*/

function refreshItemDropdowns()
{
    let selectedItems = [];

    $('.item-select').each(function(){

        let value = $(this).val();

        if(value){

            selectedItems.push(value);
        }
    });

    $('.item-select').each(function(){

        let currentSelect = $(this);

        let currentValue = currentSelect.val();

        currentSelect.find('option').each(function(){

            let optionValue = $(this).val();

            $(this).prop('disabled', false);

            if(
                optionValue &&
                optionValue != currentValue &&
                selectedItems.includes(optionValue)
            ){
                $(this).prop('disabled', true);
            }

        });

    });
}

</script>

@endsection