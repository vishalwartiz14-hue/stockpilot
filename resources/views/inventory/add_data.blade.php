@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6">

    <!-- Header -->
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">
            Add Inventory Item
        </h1>

        <p class="text-gray-500">
            Create a new stock item for your inventory
        </p>
    </div>

    <form action="{{ route('inventory.addData') }}"
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

                <option value="">Select Category</option>

                @foreach($categories as $category)

                    <option value="{{ $category->id }}">
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
                    First Select Category
                </option>

                @foreach($items as $item)

                    <option value="{{ $item->id }}"
                            data-category="{{ $item->category_id }}">

                        {{ $item->name }}

                    </option>

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
                <input type="number" name="opening_stock" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
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
                <input type="number" name="reorder_level"
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

            <select name="storage_location_id" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">

                <option value="">
                    Select Storage Location
                </option>

                @foreach($storage_locations as $location)
                    <option value="{{ $location->id }}">
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

            <input type="submit" name="add_inventory_button" value="Save Item"
                   class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-block">

        </div>

    </form>

</div>

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