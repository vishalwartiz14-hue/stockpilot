@extends('layouts.app')

@section('content')

<div class="container mx-auto px-6 py-6">

    @include('components.flash_message')

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            Access Control
        </h1>
    </div>

    <!-- FORM START -->
    <form action="{{ route('access.save') }}" method="POST">
        @csrf

        <div class="bg-white shadow rounded-lg overflow-x-auto">

            <table class="w-full border-collapse">

                <!-- TABLE HEADER -->
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 border text-left">Role</th>
                        <th class="p-3 border text-left">Module</th>
                        <th class="p-3 border text-center">View</th>
                        <th class="p-3 border text-center">Add</th>
                        <th class="p-3 border text-center">Edit</th>
                        <th class="p-3 border text-center">Delete</th>
                    </tr>
                </thead>

                <tbody>

                @php
                    $groupedRoles = $access_list->groupBy('role');
                @endphp

                @forelse($groupedRoles as $roleId => $modules)

                    @php
                        $role = DB::table('user_roles')
                                    ->where('id', $roleId)
                                    ->first();
                    @endphp

                    @foreach($modules as $index => $access)

                        <tr class="hover:bg-gray-50">

                            <!-- ROLE -->
                            @if($index == 0)
                                <td rowspan="{{ count($modules) }}"
                                    class="p-3 border font-bold text-blue-600 align-top bg-gray-50">

                                    {{ $role ? $role->name : '-' }}

                                </td>
                            @endif

                            <!-- MODULE -->
                            <td class="p-3 border font-medium">
                                {{ $access->module_name }}
                            </td>

                            <!-- VIEW -->
                            <td class="p-3 border text-center">

                                <input type="hidden"
                                       name="permissions[{{ $access->id }}][view]"
                                       value="0">

                                <input type="checkbox"
                                       name="permissions[{{ $access->id }}][view]"
                                       value="1"
                                       {{ $access->view == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- ADD -->
                            <td class="p-3 border text-center">

                                <input type="hidden"
                                       name="permissions[{{ $access->id }}][add]"
                                       value="0">

                                <input type="checkbox"
                                       name="permissions[{{ $access->id }}][add]"
                                       value="1"
                                       {{ $access->add == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- EDIT -->
                            <td class="p-3 border text-center">

                                <input type="hidden"
                                       name="permissions[{{ $access->id }}][edit]"
                                       value="0">

                                <input type="checkbox"
                                       name="permissions[{{ $access->id }}][edit]"
                                       value="1"
                                       {{ $access->edit == 1 ? 'checked' : '' }}>
                            </td>

                            <!-- DELETE -->
                            <td class="p-3 border text-center">

                                <input type="hidden"
                                       name="permissions[{{ $access->id }}][delete]"
                                       value="0">

                                <input type="checkbox"
                                       name="permissions[{{ $access->id }}][delete]"
                                       value="1"
                                       {{ $access->delete == 1 ? 'checked' : '' }}>
                            </td>

                        </tr>

                    @endforeach

                @empty

                    <tr>
                        <td colspan="6"
                            class="text-center p-4 text-gray-500">
                            No access records found
                        </td>
                    </tr>

                @endforelse

                </tbody>

            </table>

        </div>

        <!-- SAVE BUTTON -->
        <div class="mt-4">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-5 py-2 rounded-lg">

                Save Permissions

            </button>
        </div>

    </form>
    <!-- FORM END -->

</div>

@endsection