@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto bg-white shadow-xl rounded-xl p-8">

    <!-- Header -->
    <div class="mb-8 border-b pb-4">
        <h1 class="text-3xl font-bold text-gray-800">Edit User</h1>
        <p class="text-gray-500">Update user information and roles</p>
    </div>
<form action="{{ route('users.edit-user', base64_encode(urlencode($user->id))) }}"
      method="POST">

    @csrf
        <!-- Row 1 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Full Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                <input type="text" name="full_name" value="<?php echo $user->name; ?>"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Enter full name">
                    @error('full_name')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
            </div>

            <!-- Email -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                <input type="email" name="email" value="<?php echo $user->email; ?>"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Enter email">
                        @error('email')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
            </div>

        </div>

        <!-- Row 2 -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <!-- Password -->
            <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">
                Password
            </label>

            <input type="password"
                name="password"
                class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                placeholder="******">

            @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
        </div>

            <!-- Role -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">User Role</label>
                <select name="type" class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="">Select Role</option>
                    @foreach($userRoles as $role)
                        <option value="{{ $role->id }}" <?php if($user->type == $role->id) echo 'selected'; ?>>{{ $role->name }}</option>
                    @endforeach 
                </select>
                 @error('type')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
            </div>

        </div>

        <!-- Optional Details -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

            <!-- Phone -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Phone (Optional)</label>
                <input type="text" name="phone_number" value="<?php echo $user->phone_number; ?>"
                       class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                       placeholder="Enter phone number">
                       
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                <select name='status' class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none">
                    <option value="Active" <?php echo $user->status == 'Active' ? 'selected' : ''; ?>>Active</option>
                    <option value="Inactive" <?php echo $user->status == 'Inactive' ? 'selected' : ''; ?>>Inactive</option>
                </select>
                 @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
            </div>

        </div>

        <!-- Address -->
        <div class="mt-6">
            <label class="block text-sm font-medium text-gray-700 mb-1">Address</label>
            <textarea rows="3" name="street_address"
                      class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-500 outline-none"
                      placeholder="Enter full address"><?php echo $user->street_address; ?></textarea>
     @error('street_address')
        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
    @enderror
        </div>
        <!-- Buttons -->
        <div class="flex justify-end gap-4 mt-8">
            <a href="<?php echo route('users.viewData'); ?>"
               class="px-5 py-2 bg-gray-500 hover:bg-gray-600 text-white rounded-lg">
                Cancel   </a>

    <input type="submit" name="edit_user_button" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg inline-block" value="Save User">
 
        </div>

    </form>

</div>

@endsection