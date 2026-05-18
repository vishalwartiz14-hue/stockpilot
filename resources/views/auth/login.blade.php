<x-guest-layout>
    <div class="space-y-6">
        <div class="text-center">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-500 text-xl font-bold text-white">SP</div>
            <h1 class="mt-6 text-3xl font-semibold text-white">Sign in to StockPilot</h1>
            <p class="mt-3 text-sm text-slate-400">Access inventory, procurement, and reporting from one dashboard.</p>
        </div>

        <x-auth-session-status
            class="rounded-2xl border border-cyan-500/20 bg-slate-950/80 p-4 text-sm text-cyan-200"
            :status="session('status')" />

        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf

            <div>
                <x-input-label for="email" :value="__('Email')" class="text-slate-200" />
                <x-text-input id="email"
                    class="mt-2 block w-full"
                    type="email"
                    name="email"
                    :value="old('email')"
                    required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password" :value="__('Password')" class="text-slate-200" />
                <x-text-input id="password"
                    class="mt-2 block w-full"
                    type="password"
                    name="password"
                    required />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between text-sm text-slate-400">
                <label class="flex items-center gap-2">
                    <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-700 bg-slate-950 text-cyan-500 focus:ring-cyan-500" />
                    <span>Remember me</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="font-medium text-cyan-400 hover:text-cyan-300">Forgot password?</a>
                @endif
            </div>

            <button type="submit" class="w-full rounded-2xl bg-gradient-to-r from-cyan-500 to-blue-600 px-5 py-3 text-base font-semibold text-white shadow-xl shadow-cyan-500/20 transition hover:opacity-95">
                Log in
            </button>
        </form>

        <p class="text-center text-sm text-slate-500">
            New here? <a href="{{ route('register') }}" class="font-semibold text-cyan-400 hover:text-cyan-300">Create an account</a>
        </p>
    </div>
</x-guest-layout>
