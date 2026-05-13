<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-3">
            <h2 class="text-3xl font-semibold text-white">Forgot your password?</h2>
            <p class="text-sm text-slate-400">Enter your email and we will send you a secure reset link.</p>
        </div>

        <x-auth-session-status class="rounded-3xl border border-cyan-500/15 bg-slate-950/80 p-4 text-sm text-cyan-200" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <x-primary-button>
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
