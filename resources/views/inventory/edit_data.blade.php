@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6">

    <!-- Header -->
    <div class="mb-6 border-b pb-4">

        <h1 class="text-2xl font-bold text-gray-800">
            Edit Inventory Item
        </h1>

        <p class="text-gray-500">
            Update the details of an existing inventory item
        </p>

    </div>

    <form action="{{ route('inventory.edit-inventory', base64_encode(urlencode($inventory_item->id))) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf

        <!-- CATEGORY -->
        <div class="mb-4">

            <label class="block text-gray-700 mb-1">
                Select Category
            </label>

            <select name="category_id"
                    id="categorySelect"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                <option value="">
                    Select Category
                </option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}"
                        {{ old('category_id', $inventory_item->category_id) == $category->id ? 'selected' : '' }}>

                        {{ $category->name }}

                    </option>

                @endforeach

            </select>

            @error('category_id')

                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- ITEM -->
        <div class="mb-4">

            <label class="block text-gray-700 mb-1">
                Select Item
            </label>

            <select name="item_id"
                    id="itemSelect"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                <option value="">
                    Select Item
                </option>

                @foreach($items as $item)

                    @if($item->category_id == old('category_id', $inventory_item->category_id))

                        <option value="{{ $item->id }}"
                            {{ old('item_id', $inventory_item->item_id) == $item->id ? 'selected' : '' }}>

                            {{ $item->name }}

                        </option>

                    @endif

                @endforeach

            </select>

            @error('item_id')

                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- STOCK INFO -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <!-- OPENING STOCK -->
            <div>

                <label class="block text-gray-700 mb-1">
                    Opening Stock
                </label>

                <input type="number"
                       name="opening_stock"
                       value="{{ old('opening_stock', $inventory_item->opening_stock) }}"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Enter quantity">

                @error('opening_stock')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>

            <!-- REORDER LEVEL -->
            <div>

                <label class="block text-gray-700 mb-1">
                    Reorder Level
                </label>

                <input type="number"
                       name="reorder_level"
                       value="{{ old('reorder_level', $inventory_item->reorder_level) }}"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Minimum stock level">

                @error('reorder_level')

                    <p class="text-red-500 text-sm mt-1">
                        {{ $message }}
                    </p>

                @enderror

            </div>

        </div>

        

        <!-- STORAGE LOCATION -->
        <div class="mb-4">

            <label class="block text-gray-700 mb-1">
                Storage Location
            </label>

            <select name="storage_location_id"
                    class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                <option value="">
                    Select Storage Location
                </option>

                @foreach($storage_locations as $location)

                    <option value="{{ $location->id }}"
                        {{ old('storage_location_id', $inventory_item->storage_location_id) == $location->id ? 'selected' : '' }}>

                        {{ $location->name }}

                    </option>

                @endforeach

            </select>

            @error('storage_location_id')

                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>

            @enderror

        </div>

        <!-- BUTTONS -->
        <div class="flex justify-end gap-3 mt-6">

            <a href="{{ route('inventory.viewData') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">

                Cancel

            </a>

            <input type="submit"
                   name="edit_inventory_button"
                   value="Update Inventory"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-block">

        </div>

    </form>

</div>

<!-- JQUERY -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- AJAX SCRIPT -->
<script>

$(document).ready(function () {
    $('#categorySelect').on('change', function () {
        let categoryId = $(this).val();
        $('#itemSelect').html(
            '<option value="">Loading...</option>'
        );
        $.ajax({
            url: '/get-items-by-category/' + categoryId,
            type: 'GET',
            success: function (response) {
                $('#itemSelect').html(
                    '<option value="">Select Item</option>'
                );

                response.forEach(function (item) {

                    $('#itemSelect').append(

                        '<option value="' + item.id + '">' +

                            item.name +

                        '</option>'

                    );

                });

            }

        });

    });

});

</script>

@endsection