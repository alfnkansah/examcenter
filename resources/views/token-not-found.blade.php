<x-app-layout>
    <x-form-section>
        <div class="account-form-item mb-20">
            <center>
                <h4>Token Not Found</h4>
            </center>
            <div class="account-form-label">
                <p>The token you provided could not be found. Please ensure that you have the correct link or
                    request a
                    new one.</p>

            </div><br>

            <div class="account-bottom">
                <div class="account-option">
                    <a href="{{ route('homepage') }}" class="account-option-account">
                        <span>Back Home</span>
                    </a>
                </div>

            </div>
        </div>
    </x-form-section>
</x-app-layout>
