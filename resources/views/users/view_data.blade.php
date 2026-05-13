@extends('layouts.app')

@section('content')
<?php
$UserLogindetails = auth()->user();
$user_add               =   DB::table('access')->where('module_name','users')->where('role', $UserLogindetails->type)->where('add','1')->count();
$user_edit              =   DB::table('access')->where('module_name','users')->where('role', $UserLogindetails->type)->where('edit','1')->count();
$user_delete            =   DB::table('access')->where('module_name','users')->where('role', $UserLogindetails->type)->where('delete','1')->count();


?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<div class="flex justify-between items-center mb-6">
    <div>
        <h1 class="text-2xl font-bold text-gray-800">Users Data</h1>
        <p class="text-gray-500">All registered users list</p>
    </div>

    <!-- Add Customer Button -->
     <?php if($user_add != 0){?>
    <a href="{{ route('users.add-user') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded shadow">
        + Add User
    </a>
    <?php } ?>
</div>

@include('components.flash_message')


<div class="bg-white shadow rounded-lg overflow-hidden p-4">

    <div class="overflow-x-auto">
        <table id="manage_users" class="display w-full">
            <thead class="bg-gray-100 text-gray-700">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Address</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach($users as $user){ 

                    $user_role = DB::table('user_roles')
                                    ->where('id', $user->type)
                                    ->first();
                ?>

                <tr>
                    <td><?php echo $user->name; ?></td>

                    <td><?php echo $user->email; ?></td>

                    <td>
                        <?php echo $user_role ? $user_role->name : ''; ?>
                    </td>

                    <td>
                        <?php echo $user->street_address; ?>
                    </td>

                    <td>
                        <?php if($user->status == 'Active') { ?>
                            <span class="px-2 py-1 text-xs font-semibold text-green-700 bg-green-100 rounded-full">
                                Active
                            </span>
                        <?php } else { ?>
                            <span class="px-2 py-1 text-xs font-semibold text-red-700 bg-red-100 rounded-full">
                                Inactive
                            </span>
                        <?php } ?>
                    </td>

                    <td>
                         <?php if($user_edit != 0){?>
                        <a href="{{ route('users.edit-user', urlencode(base64_encode($user->id))) }}"
                           class="bg-blue-500 hover:bg-blue-600 mr-2 text-white px-3 py-1 rounded-lg">
                            Edit
                        </a>
                        <?php } ?>
                        <?php if($user_delete != 0){?>
                        <a href="{{ route('users.viewData', ['delete_user' => base64_encode($user->id)]) }}"
                           onclick="return confirm('Are you sure you want to delete this user?')"
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
            
</div>
<script>
$(document).ready(function () {

    $('#manage_users').DataTable({

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