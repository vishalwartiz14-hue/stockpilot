{{-- resources/views/profile.blade.php --}}
@extends('layouts.app')
@section('content')
<div class="max-w-4xl mx-auto mt-10 bg-white shadow-lg rounded-xl p-8">
    <div class="flex items-center gap-6">
        {{-- Profile Image --}}
        <img src="https://ui-avatars.com/api/?name={{ auth()->user()->name }}&background=0D8ABC&color=fff" 
        alt="Profile" class="w-24 h-24 rounded-full border-4 border-blue-500">

        {{-- User Info --}}
        <div>
            <h2 class="text-3xl font-bold text-gray-800">
                {{ auth()->user()->name }}
            </h2>

            <p class="text-gray-500 mt-1">
                {{ auth()->user()->email }}
            </p>

            <p class="text-sm text-gray-400 mt-2">
                Joined: {{ auth()->user()->created_at->format('d M Y') }}
            </p>
        </div>

    </div>

    {{-- Divider --}}
    <hr class="my-6">

    {{-- Profile Details --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="font-semibold text-gray-700">User ID</h4>
            <p class="text-gray-600 mt-1">
                {{ auth()->user()->id }}
            </p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="font-semibold text-gray-700">Username</h4>
            <p class="text-gray-600 mt-1">
                {{ auth()->user()->name }}
            </p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="font-semibold text-gray-700">Email Address</h4>
            <p class="text-gray-600 mt-1">
                {{ auth()->user()->email }}
            </p>
        </div>

        <div class="bg-gray-100 p-4 rounded-lg">
            <h4 class="font-semibold text-gray-700">Account Status</h4>
            <p class="text-green-600 font-semibold mt-1">
                Active
            </p>
        </div>

    </div>

</div>

@endsection