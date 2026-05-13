{{-- resources/views/profile/edit.blade.php --}}

@extends('layouts.app')

@section('content')

<div class="max-w-5xl mx-auto py-10 px-6">

    <div class="bg-white shadow-xl rounded-2xl overflow-hidden">

        {{-- Header --}}
        <div class="bg-slate-900 px-8 py-10 text-white">

            <div class="flex items-center gap-6">

                <img 
                    src="https://ui-avatars.com/api/?name={{ $user->name }}&background=0f172a&color=ffffff&size=120"
                    class="w-28 h-28 rounded-full border-4 border-white shadow-lg"
                    alt="Profile Image"
                >

                <div>
                    <h1 class="text-3xl font-bold">
                        {{ $user->name }}
                    </h1>

                    <p class="text-slate-300 mt-2">
                        {{ $user->email }}
                    </p>

                    <p class="text-sm text-slate-400 mt-1">
                        Member Since :
                        {{ $user->created_at->format('d M Y') }}
                    </p>
                </div>

            </div>

        </div>

        {{-- Body --}}
        <div class="p-8">

            <h2 class="text-2xl font-bold text-slate-800 mb-6">
                Profile Information
            </h2>

            @if (session('status') === 'profile-updated')

                <div class="mb-6 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                    Profile updated successfully.
                </div>

            @endif

            <form method="POST" action="{{ route('profile.update') }}">

                @csrf
                @method('PATCH')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Name --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Full Name
                        </label>

                        <input 
                            type="text"
                            name="name"
                            value="{{ old('name', $user->name) }}"
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-slate-800 outline-none"
                        >

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            Email Address
                        </label>

                        <input 
                            type="email"
                            name="email"
                            value="{{ old('email', $user->email) }}"
                            class="w-full border border-slate-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-slate-800 outline-none"
                        >

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Submit Button --}}
                <div class="mt-8">
                    <button 
                        type="submit"
                        class="bg-slate-900 hover:bg-slate-800 text-white px-6 py-3 rounded-lg font-semibold transition"
                    >
                        Update Profile
                    </button>
                </div>

            </form>

            {{-- Delete Account --}}
            <div class="mt-12 border-t pt-8">

                <h3 class="text-xl font-bold text-red-600 mb-4">
                    Delete Account
                </h3>

                <form method="POST" action="{{ route('profile.destroy') }}">

                    @csrf
                    @method('DELETE')

                    <div class="max-w-md">

                        <input 
                            type="password"
                            name="password"
                            placeholder="Enter your password"
                            class="w-full border border-red-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-red-500 outline-none"
                        >

                        @error('password', 'userDeletion')
                            <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                        @enderror

                    </div>

                    <button 
                        type="submit"
                        onclick="return confirm('Are you sure you want to delete account?')"
                        class="mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-lg font-semibold transition"
                    >
                        Delete Account
                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection