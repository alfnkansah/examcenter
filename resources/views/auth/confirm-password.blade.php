<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
    </div>

    <form method="POST" class="pt-3" action="{{ route('password.confirm') }}">
        @csrf

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />
            <input type="password" class="form-control form-control-lg" id="password" placeholder="Password"
                name="password" required autocomplete="current-password">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-3">
            <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">
                {{ __('Confirm') }}
            </button>
        </div>
    </form>
</x-guest-layout>
