<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-3">
            <h2 class="text-3xl font-semibold text-white">Sign in to StockPilot</h2>
            <p class="text-sm text-slate-400">Enter your credentials to access the inventory dashboard.</p>
        </div>

        <x-auth-session-status class="rounded-3xl border border-cyan-500/15 bg-slate-950/80 p-4 text-sm text-cyan-200" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between gap-4 text-sm text-slate-400">
                <label for="remember_me" class="inline-flex items-center gap-2">
                    <input id="remember_me" type="checkbox" class="rounded border-slate-700 bg-slate-950 text-cyan-500 shadow-sm focus:ring-cyan-500" name="remember">
                    <span>{{ __('Remember me') }}</span>
                </label>

                @if (Route::has('password.request'))
                    <a class="text-slate-300 hover:text-white" href="{{ route('password.request') }}">{{ __('Forgot your password?') }}</a>
                @endif
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                <x-primary-button>
                    {{ __('Log in') }}
                </x-primary-button>
                <a href="{{ route('register') }}" class="text-sm font-medium text-cyan-400 hover:text-cyan-300">{{ __('New here? Create an account') }}</a>
            </div>
        </form>
    </div>
</x-guest-layout>
