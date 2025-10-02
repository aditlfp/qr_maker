<x-guest-layout>
    <div
        class="min-h-screen flex items-center justify-center p-4 bg-gradient-to-br from-blue-500 via-purple-500 to-pink-500">

        <!-- Subtle animated background elements -->
        <div class="absolute inset-0 overflow-hidden pointer-events-none">
            <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-white/10 rounded-full blur-3xl animate-pulse"></div>
            <div class="absolute bottom-1/4 right-1/4 w-96 h-96 bg-white/10 rounded-full blur-3xl animate-pulse"
                style="animation-delay: 2s;"></div>
        </div>

        <!-- Register Card -->
        <div class="w-full max-w-md relative z-10">

            <!-- Logo -->
            <div class="text-center mb-8">
                <div
                    class="inline-flex items-center justify-center w-16 h-16 bg-white/20 backdrop-blur-md rounded-2xl mb-4 border border-white/30 shadow-xl">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-white" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                    </svg>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Create Account</h1>
                <p class="text-white/80">Join us today</p>
            </div>

            <!-- Glass Card -->
            <div class="bg-white/10 backdrop-blur-lg rounded-3xl shadow-2xl border border-white/20 p-8">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text text-white font-medium">{{ __('Name') }}</span>
                        </label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}"
                            placeholder="Enter your name"
                            class="input bg-white/20 border-white/30 text-white placeholder-white/50 focus:bg-white/30 focus:border-white/50 w-full @error('name') border-red-400 @enderror"
                            required autofocus autocomplete="name" />
                        @error('name')
                            <label class="label">
                                <span class="label-text-alt text-red-300">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text text-white font-medium">{{ __('Email') }}</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                            placeholder="Enter your email"
                            class="input bg-white/20 border-white/30 text-white placeholder-white/50 focus:bg-white/30 focus:border-white/50 w-full @error('email') border-red-400 @enderror"
                            required autocomplete="username" />
                        @error('email')
                            <label class="label">
                                <span class="label-text-alt text-red-300">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-control mb-5">
                        <label class="label">
                            <span class="label-text text-white font-medium">{{ __('Password') }}</span>
                        </label>
                        <input type="password" id="password" name="password" placeholder="Enter your password"
                            class="input bg-white/20 border-white/30 text-white placeholder-white/50 focus:bg-white/30 focus:border-white/50 w-full @error('password') border-red-400 @enderror"
                            required autocomplete="new-password" />
                        @error('password')
                            <label class="label">
                                <span class="label-text-alt text-red-300">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-control mb-6">
                        <label class="label">
                            <span class="label-text text-white font-medium">{{ __('Confirm Password') }}</span>
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                            placeholder="Confirm your password"
                            class="input bg-white/20 border-white/30 text-white placeholder-white/50 focus:bg-white/30 focus:border-white/50 w-full @error('password_confirmation') border-red-400 @enderror"
                            required autocomplete="new-password" />
                        @error('password_confirmation')
                            <label class="label">
                                <span class="label-text-alt text-red-300">{{ $message }}</span>
                            </label>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <button type="submit"
                        class="btn btn-primary w-full bg-white/30 hover:bg-white/40 border-white/40 text-white font-semibold">
                        {{ __('Register') }}
                    </button>

                    <!-- Login Link -->
                    <div class="divider text-white/60 text-sm my-6">OR</div>
                    <div class="text-center">
                        <p class="text-white/90 text-sm">
                            Already registered?
                            <a href="{{ route('login') }}" class="text-white font-semibold hover:underline">
                                Sign in
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Footer -->
            <div class="text-center mt-6">
                <p class="text-white/70 text-sm">🔒 Secured with end-to-end encryption</p>
            </div>
        </div>

        <style>
            @keyframes pulse {

                0%,
                100% {
                    opacity: 0.3;
                }

                50% {
                    opacity: 0.5;
                }
            }

            .animate-pulse {
                animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
            }
        </style>
    </div>
</x-guest-layout>
