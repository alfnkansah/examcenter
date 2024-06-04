<x-guest-layout>
    <form class="pt-3" method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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


        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <input type="password" class="form-control form-control-lg" id="password_confirmation"
                placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />

        </div>


        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                {{ __('Reset Password') }}
            </button>
        </div>
    </form>
</x-guest-layout>
