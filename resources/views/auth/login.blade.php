<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form class="pt-3" method="POST" action="{{ route('login') }}">
        @csrf
        <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email')" />
            <input type="email" class="form-control form-control-lg" placeholder="Email" name="email"
                value="{{ old('email') }}" required autofocus autocomplete="username">

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <input type="password" class="form-control form-control-lg" id="password" placeholder="Password"
                name="password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />

        </div>

        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                {{ __('Log in') }}
            </button>
        </div>

        <!-- Remember Me -->
        <div class="my-2 d-flex justify-content-between align-items-center">
            <div class="form-check">
                <label class="form-check-label text-muted" for="remember_me">
                    <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                    {{ __('Keep me signed in') }}
                </label>
            </div>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}"
                    class="auth-link text-black">{{ __('Forgot your password?') }}</a>
            @endif

        </div>

    </form>
</x-guest-layout>
