@extends('layouts.app')

@section('content')
<?php
$UserLogindetails = auth()->user();
$storage_location_add               =   DB::table('access')->where('module_name','storage_locations')->where('role', $UserLogindetails->type)->where('add','1')->count();
$storage_location_edit              =   DB::table('access')->where('module_name','storage_locations')->where('role', $UserLogindetails->type)->where('edit','1')->count();
$storage_location_delete            =   DB::table('access')->where('module_name','storage_locations')->where('role', $UserLogindetails->type)->where('delete','1')->count();
?>
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Storage Location</h1>
        <p class="text-gray-500">All registered storage locations list</p>
    </div>
<?php if($storage_location_add != 0) {?>
<button onclick="openModal()"
    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
    + Add Storage Location
</button>
<?php } ?>
<!-- Modal Backdrop -->
<div id="storageLocationModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <!-- Modal Box -->
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">

        <!-- Close Button -->
        <button onclick="closeModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl">
            &times;
        </button>

        <!-- Modal Title -->
        <h2 class="text-xl font-bold mb-4">Add Storage Location</h2>

        <!-- Form -->
        <form action="{{ route('storage-locations.addData') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Storage Location Name
                </label>

                <input type="text" name="name"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter storage location name" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Status
                </label>

                <select name="status"  required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
                    <option value="">Select Status</option>
                    <option value="Active">Active</option>
                    <option value="Inactive">Inactive</option>
                </select>
            </div>

            
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-300 rounded hover:bg-gray-400">
                    Cancel
                </button>

                <input type="submit" name="add_category_submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" value="Save">
            </div>
        </form>

    </div>
</div>

<!-- JS -->
<script id="gn9b0f">
    function openModal() {
        document.getElementById('storageLocationModal').classList.remove('hidden');
        document.getElementById('storageLocationModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('storageLocationModal').classList.add('hidden');
        document.getElementById('storageLocationModal').classList.remove('flex');
    }
</script>
</div>

@include('components.flash_message')


<div class="bg-white shadow rounded-lg overflow-hidden">

    <table class="w-full text-left">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3">Name</th>
                <th class="p-3">Email</th>
                <th class="p-3">Role</th>
                <th class="p-3">Address</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($storage_locations as $storage_location){ ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3"><?php echo $storage_location->name; ?></td>
               <td class="p-3">
                <?php if($storage_location->status == 'Active') { ?>
                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                        Active
                    </span>
                <?php } else { ?>
                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                        Inactive
                    </span>
                <?php } ?>
            </td>

                <td class="p-3"><?php echo print_date($storage_location->created_at); ?></td>
                <td class="p-3"><?php echo print_date($storage_location->updated_at); ?></td>
                <td>
            <?php if($storage_location_edit != 0) {?>
                <button type="button" onclick="openEditModal(<?php echo $storage_location->id; ?>)"
                    class="px-3 py-1 bg-blue-500 text-white rounded">
                    Edit
                </button>
                <?php } ?>
                <?php if($storage_location_delete != 0) {?>
                <a href="{{ route('storage-locations.viewData', ['delete_storage_location' => base64_encode($storage_location->id)]) }}"
                       onclick="return confirm('Are you sure you want to delete this storage location?')"
                       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                    Delete
                </a>
                <?php } ?>
            </td>
            
           <div id="editModal<?php echo $storage_location->id; ?>" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white w-96 rounded-lg p-5 relative">

        <!-- Close -->
        <button onclick="closeEditModal(<?php echo $storage_location->id; ?>)"
            class="absolute top-2 right-2 text-xl">
            &times;
        </button>

        <h2 class="text-lg font-bold mb-4">Edit Storage Location</h2>

        <form action="{{ route('storage-locations.editData', $storage_location->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Storage Location Name
                </label> 
                <input type="text" name="name" value="<?php echo $storage_location->name; ?>"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter storage location name" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Status
                </label>

                <select name="status"  class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 " required>
                    <option value="">Select Status</option>
                    <option value="Active" <?php if($storage_location->status=='Active') echo 'selected'; ?>>Active</option>
                    <option value="Inactive" <?php if($storage_location->status=='Inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal(<?php echo $storage_location->id; ?>)"
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