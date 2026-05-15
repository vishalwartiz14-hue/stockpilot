@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Items</h1>
        <p class="text-gray-500">All registered items list</p>
    </div>

    <button onclick="openModal()"
        class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
        + Add items
    </button>
</div>

<!-- Add Modal -->
<div id="itemModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 overflow-y-auto p-4">

    <div
        class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative max-h-[90vh] overflow-y-auto">

        <!-- Close Button -->
        <button onclick="closeModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl">
            &times;
        </button>

        <h2 class="text-xl font-bold mb-4">Add Item</h2>

        <form action="{{ route('items.addData') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Select Category
                </label>

                <select name="category_id" required
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Item Name
                </label>

                <input type="text" name="name"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter item name" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Price
                </label>

                <input type="number" name="price" step="0.01"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter item price">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Unit
                </label>

                <select name="unit"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Select Unit</option>
                    <option value="pcs">pcs</option>
                    <option value="kg">kg</option>
                    <option value="liters">liters</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Tax Rate
                </label>

                <input type="number" name="tax_rate" step="0.01"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter item tax">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Stock Quantity
                </label>

                <input type="number" name="stock_quantity" step="0.01"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter item stock quantity">
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Status
                </label>

                <select name="status" required
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Description
                </label>

                <textarea name="description"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter item description"></textarea>
            </div>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>

                <input type="submit" name="add_item_submit"
                    class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600"
                    value="Save">
            </div>
        </form>
    </div>
</div>

<!-- JS -->
<script>
    function openModal() {
        document.getElementById('itemModal').classList.remove('hidden');
        document.getElementById('itemModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('itemModal').classList.add('hidden');
        document.getElementById('itemModal').classList.remove('flex');
    }
</script>

@include('components.flash_message')

<div class="bg-white shadow rounded-lg overflow-x-auto">

    <table class="w-full text-left">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3">Name</th>
                <th class="p-3">Status</th>
                <th class="p-3">Price</th>
                <th class="p-3">Tax Rate</th>
                <th class="p-3">Stock Quantity</th>
                <th class="p-3">Description</th>
                <th class="p-3">Created At</th>
                <th class="p-3">Updated At</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($items as $item){ ?>

            <tr class="border-t hover:bg-gray-50">

                <td class="p-3"><?php echo $item->name; ?></td>

                <td class="p-3">
                    <?php if($item->status == 'Active') { ?>
                    <span
                        class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                        Active
                    </span>
                    <?php } else { ?>
                    <span
                        class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                        Inactive
                    </span>
                    <?php } ?>
                </td>

                <td class="p-3"><?php echo $item->price; ?></td>
                <td class="p-3"><?php echo $item->tax_rate; ?></td>
                <td class="p-3"><?php echo $item->stock_quantity; ?></td>
                <td class="p-3"><?php echo $item->description; ?></td>
                <td class="p-3"><?php echo print_date($item->created_at); ?></td>
                <td class="p-3"><?php echo print_date($item->updated_at); ?></td>

                <td class="p-3 flex gap-2">

                    <button type="button"
                        onclick="openEditModal(<?php echo $item->id; ?>)"
                        class="px-3 py-1 bg-blue-500 text-white rounded">
                        Edit
                    </button>

                    <a href="{{ route('items.viewData', ['delete_item' => base64_encode($item->id)]) }}"
                        onclick="return confirm('Are you sure you want to delete this item?')"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                        Delete
                    </a>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div id="editModal<?php echo $item->id; ?>"
                class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 overflow-y-auto p-4">

                <div
                    class="bg-white w-full max-w-md rounded-lg p-5 relative max-h-[90vh] overflow-y-auto">

                    <!-- Close -->
                    <button
                        onclick="closeEditModal(<?php echo $item->id; ?>)"
                        class="absolute top-2 right-2 text-xl">
                        &times;
                    </button>

                    <h2 class="text-lg font-bold mb-4">Edit Item</h2>

                    <form action="{{ route('items.editData', $item->id) }}"
                        method="POST">

                        @csrf
                        @method('PUT')
                            <div class="mb-4">
                                <label class="block text-sm font-medium mb-1">
                                    Select Category
                                </label>
    
                                <select name="category_id" required
                                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
    
                                    <option value="">Select Category</option>
    
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            <?php if($item->category_id == $category->id) echo 'selected'; ?>>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Item Name
                            </label>

                            <input type="text" name="name"
                                value="<?php echo $item->name; ?>"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                                placeholder="Enter item name" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Price
                            </label>

                            <input type="number" name="price"
                                value="<?php echo $item->price; ?>"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                                placeholder="Enter price" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Unit
                            </label>

                            <select name="unit"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">

                                <option value="">Select Unit</option>

                                <option value="pcs"
                                    <?php if($item->unit=='pcs') echo 'selected'; ?>>
                                    pcs
                                </option>

                                <option value="kg"
                                    <?php if($item->unit=='kg') echo 'selected'; ?>>
                                    kg
                                </option>

                                <option value="liters"
                                    <?php if($item->unit=='liters') echo 'selected'; ?>>
                                    liters
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Tax Rate
                            </label>

                            <input type="number" name="tax_rate"
                                value="<?php echo $item->tax_rate; ?>"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                                placeholder="Enter tax rate" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Stock Quantity
                            </label>

                            <input type="number" name="stock_quantity"
                                value="<?php echo $item->stock_quantity; ?>"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                                placeholder="Enter stock quantity" required>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Status
                            </label>

                            <select name="status" required
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">

                                <option value="">Select Status</option>

                                <option value="Active"
                                    <?php if($item->status=='Active') echo 'selected'; ?>>
                                    Active
                                </option>

                                <option value="Inactive"
                                    <?php if($item->status=='Inactive') echo 'selected'; ?>>
                                    Inactive
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium mb-1">
                                Description
                            </label>

                            <textarea name="description"
                                class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                                placeholder="Enter item description"><?php echo $item->description; ?></textarea>
                        </div>

                        <div class="flex justify-end gap-2">

                            <button type="button"
                                onclick="closeEditModal(<?php echo $item->id; ?>)"
                                class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                                Cancel
                            </button>

                            <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php } ?>
        </tbody>
    </table>
</div>

<script>
    function openEditModal(id) {
        document.getElementById('editModal' + id).classList.remove('hidden');
        document.getElementById('editModal' + id).classList.add('flex');
    }

    function closeEditModal(id) {
        document.getElementById('editModal' + id).classList.add('hidden');
        document.getElementById('editModal' + id).classList.remove('flex');
    }
</script>

@endsection