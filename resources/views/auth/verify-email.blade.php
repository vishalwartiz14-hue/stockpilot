<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-3">
            <h2 class="text-3xl font-semibold text-white">Verify your email</h2>
            <p class="text-sm text-slate-400">Please confirm your email address before continuing.</p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="rounded-3xl border border-emerald-500/15 bg-emerald-500/10 p-4 text-sm text-emerald-200">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif

        <div class="grid gap-4 sm:grid-cols-2">
            <form method="POST" action="{{ route('verification.send') }}" class="grid">
                @csrf
                <x-primary-button>
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="grid">
                @csrf
                <button type="submit" class="inline-flex justify-center rounded-2xl border border-slate-800 bg-slate-950/90 px-4 py-2 text-sm font-semibold text-slate-100 transition hover:bg-slate-900">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
