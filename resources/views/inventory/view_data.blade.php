@extends('layouts.app')

@section('content')
<?php
$UserLogindetails = auth()->user();
$inventory_add               =   DB::table('access')->where('module_name','inventory')->where('role', $UserLogindetails->type)->where('add','1')->count();
$inventory_edit              =   DB::table('access')->where('module_name','inventory')->where('role', $UserLogindetails->type)->where('edit','1')->count();
$inventory_delete            =   DB::table('access')->where('module_name','inventory')->where('role', $UserLogindetails->type)->where('delete','1')->count();


?>

<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Inventory</h1>
    <p class="text-gray-500">Simple stock overview</p>
</div>

<!-- Summary Cards -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">

    <div class="bg-white p-5 rounded-lg shadow">
        <p class="text-gray-500">Total Items</p>
        <h2 class="text-2xl font-bold">{{ $total_items }}</h2>
    </div>

    <div class="bg-white p-5 rounded-lg shadow">
        <p class="text-gray-500">Low Stock</p>
        <h2 class="text-2xl font-bold text-red-500"></h2>
    </div>

    <div class="bg-white p-5 rounded-lg shadow">
        <p class="text-gray-500">Total Value</p>
        <h2 class="text-2xl font-bold">₹ {{ number_format($total_value, 2) }}</h2>
    </div>

</div>
@if(session('success'))
    <div class="mb-4 rounded-lg bg-green-100 border border-green-300 text-green-700 px-4 py-3">
        {{ session('success') }}
    </div>
@endif 

<!-- Action Button -->
<div class="flex justify-end mb-4">
    <?php if($inventory_add != 0){ ?>
    <a  href="{{ route('inventory.addData') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
        + Add Item
    </a>
    <?php } ?>
</div>

<!-- Inventory Table -->
<div class="bg-white shadow rounded-lg overflow-hidden p-4">

    <div class="overflow-x-auto">

        <table id="manage_inventory" class="display w-full">

            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th>Item</th>
                    <th>Category</th>
                    <th>Storage Location</th>
                    <th>Reorder Level</th>
                    <th>Unit</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($inventory_items as $inventory_item){ 
                    $itemDetails            =   DB::table('items')->where('id', $inventory_item->item_id)->first();
                    $category_name          =   DB::table('categories')->where('id', $inventory_item->category_id)->first();
                    $storage_locations      =   DB::table('storage_locations')->where('id', $inventory_item->storage_location_id)->first();
                ?>
                <tr class="border-t hover:bg-gray-50">

                    <td class="p-3">
                        <?php echo $itemDetails->name; ?>
                    </td>

                    <td class="p-3">
                        <?php echo $category_name ? $category_name->name : ''; ?>
                    </td>

                    <td class="p-3">
                        <?php echo $storage_locations ? $storage_locations->name : ''; ?>
                    </td>

                    <td class="p-3">
                        <?php echo $inventory_item->reorder_level; ?>
                    </td>

                    <td class="p-3">
                        <?php echo $itemDetails ? $itemDetails->unit : ''; ?>
                    </td>

                    <td class="p-3">
                         <?php if($inventory_edit != 0){ ?>
                        <a href="{{ route('inventory.edit-inventory', urlencode(base64_encode($inventory_item->id))) }}"
                           class="bg-blue-500 hover:bg-blue-600 mr-2 text-white px-3 py-1 rounded-lg">
                            Edit
                        </a>
                        <?php } ?>
                        <?php if($inventory_delete != 0){ ?>
                        <a href="{{ route('inventory.viewData', ['delete_inventory' => base64_encode($inventory_item->id)]) }}"
                           onclick="return confirm('Are you sure you want to delete this inventory item?')"
                           class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
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

    $('#manage_inventory').DataTable({

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


@endsection 