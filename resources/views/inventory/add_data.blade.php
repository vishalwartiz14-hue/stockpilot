@extends('layouts.app')

@section('content')

<div class="max-w-3xl mx-auto bg-white shadow-lg rounded-xl p-6">

    <!-- Header -->
    <div class="mb-6 border-b pb-4">
        <h1 class="text-2xl font-bold text-gray-800">Add Inventory Item</h1>
        <p class="text-gray-500">Create a new stock item for your inventory</p>
    </div>

    <form action="{{ route('inventory.addData') }}" method="Post" enctype="mutlipart/form-data">
@csrf
        <!-- Item Name -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Item Name</label>
            <input type="text" name="item_name"
                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                   placeholder="e.g. Tomato, Rice, Milk">
                    @error('item_name')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Category + Unit -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <div>
                <label class="block text-gray-700 mb-1">Category</label>
                <select name="category_id" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">Select Category</option>
                <?php foreach($categories as $category){ ?>
                    <option value="<?php echo $category->id; ?>">
                        <?php echo $category->name; ?>
                    </option>
                <?php } ?>
            </select> 
            @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Unit</label>
                <select name="unit" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">Select Unit</option>
                    <option value="Kg">Kg</option>
                    <option value="Gram">Gram</option>
                    <option value="Liter">Liter</option>
                    <option value="Piece">Piece</option>
                    <option value="Box">Box</option>
                </select>
                @error('unit')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

        </div>

        <!-- Stock Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">

            <div>
                <label class="block text-gray-700 mb-1">Opening Stock</label>
                <input type="number" name="opening_stock"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Enter quantity">
                       @error('opening_stock')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

            <div>
                <label class="block text-gray-700 mb-1">Reorder Level</label>
                <input type="number" name="reorder_level"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Minimum stock level">
                       @error('reorder_level')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

        </div>

        <!-- Price -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Price (Per Unit)</label>
            <input type="number" name="price"
                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                   placeholder="Enter price">
                   @error('price')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Storage Location -->
        <div class="mb-4">
            <label class="block text-gray-700 mb-1">Storage Location</label>
            <select name="storage_location_id" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                <option value="">Select Storage Location</option>
                <?php foreach($storage_locations as $location){ ?>
                    <option value="<?php echo $location->id; ?>">
                        <?php echo $location->name; ?>
                    </option>
                <?php } ?>
            </select> 
            @error('storage_location_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex justify-end gap-3 mt-6">

            <a href="{{ route('inventory.viewData') }}"
               class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                Cancel
            </a>

            <input type="Submit" name="add_inventory_button" value="Save Item"
        class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-block">

        </div>

    </form>

</div>

@endsection