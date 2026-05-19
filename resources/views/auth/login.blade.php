<x-guest-layout>

    <div
        class="min-h-screen flex items-center justify-center px-4 py-12"
        style="
            background-color:#0e1410;
            background-image:
                radial-gradient(ellipse 80% 60% at 20% 0%, rgba(197,242,75,0.18), transparent 60%),
                radial-gradient(ellipse 70% 50% at 100% 100%, rgba(255,181,71,0.14), transparent 60%);
        "
    >

        <div class="w-full max-w-md">

            <div
                class="rounded-[2rem] border p-8 shadow-2xl backdrop-blur-xl"
                style="
                    background: rgba(24,33,28,0.75);
                    border-color: rgba(180,220,180,0.12);
                "
            >

                <!-- LOGO -->
                <div class="text-center mb-8">

                    <div
                        class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl text-xl font-bold"
                        style="
                            background: linear-gradient(135deg,#c5f24b 0%,#ffb547 100%);
                            color:#14201a;
                        "
                    >
                        SP
                    </div>

                    <h1
                        class="mt-6 text-4xl"
                        style="
                            font-family:'Instrument Serif',serif;
                            color:#f1f5ef;
                        "
                    >
                        Welcome back
                    </h1>

                    <p class="mt-3 text-sm text-slate-400">
                        Sign in to manage inventory, procurement & analytics.
                    </p>

                </div>

                <!-- STATUS -->
                <x-auth-session-status
                    class="mb-5 rounded-2xl border p-4 text-sm"
                    style="
                        border-color: rgba(197,242,75,0.2);
                        background: rgba(197,242,75,0.06);
                        color:#c5f24b;
                    "
                    :status="session('status')"
                />

                <!-- FORM -->
                <form method="POST" action="{{ route('login') }}" class="space-y-5">

                    @csrf

                    <!-- EMAIL -->
                    <div>

                        <x-input-label
                            for="email"
                            :value="__('Email')"
                            class="text-slate-200"
                        />

                        <x-text-input
                            id="email"
                            class="mt-2 block w-full rounded-2xl border bg-[#111915] px-4 py-3 text-white focus:ring-0"
                            style="
                                border-color: rgba(180,220,180,0.12);
                            "
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autofocus
                        />

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2"
                        />

                    </div>

                    <!-- PASSWORD -->
                    <div>

                        <x-input-label
                            for="password"
                            :value="__('Password')"
                            class="text-slate-200"
                        />

                        <x-text-input
                            id="password"
                            class="mt-2 block w-full rounded-2xl border bg-[#111915] px-4 py-3 text-white focus:ring-0"
                            style="
                                border-color: rgba(180,220,180,0.12);
                            "
                            type="password"
                            name="password"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2"
                        />

                    </div>

                    <!-- REMEMBER -->
                    <div class="flex items-center justify-between text-sm">

                        <label class="flex items-center gap-2 text-slate-400">

                            <input
                                id="remember_me"
                                type="checkbox"
                                class="rounded border-slate-700 bg-[#111915]"
                            >

                            <span>Remember me</span>

                        </label>

                        @if (Route::has('password.request'))

                            <a
                                href="{{ route('password.request') }}"
                                class="hover:opacity-80"
                                style="color:#c5f24b;"
                            >
                                Forgot password?
                            </a>

                        @endif

                    </div>

                    <!-- BUTTON -->
                    <button
                        type="submit"
                        class="w-full rounded-2xl px-5 py-3 text-base font-semibold transition hover:opacity-95"
                        style="
                            background: linear-gradient(135deg,#c5f24b 0%,#ffb547 100%);
                            color:#14201a;
                            box-shadow: 0 30px 80px -20px rgba(197,242,75,0.35);
                        "
                    >
                        Log in
                    </button>

                </form>

                <!-- REGISTER -->
                <p class="mt-6 text-center text-sm text-slate-500">

                    New here?

                    <a
                        href="{{ route('register') }}"
                        class="font-semibold hover:opacity-80"
                        style="color:#c5f24b;"
                    >
                        Create account
                    </a>

                </p>

            </div>

        </div>

    </div>

</x-guest-layout>