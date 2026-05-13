<x-guest-layout>
    <div class="space-y-6">
        <div class="space-y-3">
            <h2 class="text-3xl font-semibold text-white">Confirm your password</h2>
            <p class="text-sm text-slate-400">This is a secure area. Please confirm your password to continue.</p>
        </div>

        <form method="POST" action="{{ route('password.confirm') }}" class="space-y-6">
            @csrf

            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex justify-end">
                <x-primary-button>
                    {{ __('Confirm') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
