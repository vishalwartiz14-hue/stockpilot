@extends('layouts.app')

@section('content')

<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">User Roles</h1>
        <p class="text-gray-500">All registered user roles list</p>
    </div>

<button onclick="openModal()"
    class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
    + Add User Role
</button>

<!-- Modal Backdrop -->
<div id="userRoleModal"
    class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <!-- Modal Box -->
    <div class="bg-white rounded-xl shadow-lg w-full max-w-md p-6 relative">

        <!-- Close Button -->
        <button onclick="closeModal()"
            class="absolute top-3 right-3 text-gray-500 hover:text-black text-xl">
            &times;
        </button>

        <!-- Modal Title -->
        <h2 class="text-xl font-bold mb-4">Add User Role</h2>

        <!-- Form -->
        <form action="{{ route('user-roles.addData') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    User Role Name
                </label>

                <input type="text" name="name"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter user role name" required>
            </div>

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Status
                </label>

                <select name="status" required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200">
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

                <input type="submit" name="add_userRole_submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600" value="Save">
            </div>
        </form>

    </div>
</div>

<!-- JS -->
<script id="gn9b0f">
    function openModal() {
        document.getElementById('userRoleModal').classList.remove('hidden');
        document.getElementById('userRoleModal').classList.add('flex');
    }

    function closeModal() {
        document.getElementById('userRoleModal').classList.add('hidden');
        document.getElementById('userRoleModal').classList.remove('flex');
    }
</script>
</div>

@include('components.flash_message')


<div class="bg-white shadow rounded-lg overflow-hidden">

    <table class="w-full text-left">
        <thead class="bg-gray-100 text-gray-700">
            <tr>
                <th class="p-3">Name</th>
                <th class="p-3">Status</th>
                <th class="p-3">Action</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach($userRoles as $userRole){ ?>
            <tr class="border-t hover:bg-gray-50">
                <td class="p-3"><?php echo $userRole->name; ?></td>
               <td class="p-3">
                <?php if($userRole->status == 'Active') { ?>
                    <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                        Active
                    </span>
                <?php } else { ?>
                    <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                        Inactive
                    </span>
                <?php } ?>
            </td>

                <td class="p-3"><?php echo print_date($userRole->created_at); ?></td>
                <td class="p-3"><?php echo print_date($userRole->updated_at); ?></td>
                <td>
                <button type="button" onclick="openEditModal(<?php echo $userRole->id; ?>)"
                    class="px-3 py-1 bg-blue-500 text-white rounded">
                    Edit
                </button>
                <a href="{{ route('user-roles.viewData', ['delete_userRole' => base64_encode($userRole->id)]) }}"
                       onclick="return confirm('Are you sure you want to delete this user role?')"
                       class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg">
                    Delete
                </a>
            </td>
           <div id="editModal<?php echo $userRole->id; ?>" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white w-96 rounded-lg p-5 relative">

        <!-- Close -->
        <button onclick="closeEditModal(<?php echo $userRole->id; ?>)"
            class="absolute top-2 right-2 text-xl">
            &times;
        </button>

        <h2 class="text-lg font-bold mb-4">Edit User Role</h2>

        <form action="{{ route('user-roles.editData', $userRole->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    User Role Name
                </label> 
                <input type="text" name="name" value="<?php echo $userRole->name; ?>"
                    class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200"
                    placeholder="Enter user role name" required>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-medium mb-1">
                    Status
                </label>

                <select name="status"  required class="w-full border rounded-lg px-3 py-2 focus:ring focus:ring-blue-200 " required>
                    <option value="">Select Status</option>
                    <option value="Active" <?php if($userRole->status=='Active') echo 'selected'; ?>>Active</option>
                    <option value="Inactive" <?php if($userRole->status=='Inactive') echo 'selected'; ?>>Inactive</option>
                </select>
            </div>
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeEditModal(<?php echo $userRole->id; ?>)"
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