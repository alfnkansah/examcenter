<x-app-layout>
    <x-form-section>
        <div class="account-form-item mb-20">
            <div class="text-center">
                <h4>Download Resource</h4>
            </div>
            <div class="account-form-label">
                <p>Thank you for using {{ env('APP_NAME') }}. Please click the button below to download the resource.
                </p>
            </div><br>

            <div class="account-form-button">
                {{--  --}}
                <a href="{{ asset('storage/' . $file->file_path) }}" download>
                    <button type="submit" class="account-btn">Click To Download</button>
                </a>
            </div>

            <div class="account-break">
                <span>OR</span>
            </div>
            <div class="account-bottom">
                <div class="account-option">

                    <a href="{{ route('view-answer', $file->id) }}" class="account-option-account">
                        <span>View Answer</span>
                    </a>
                </div>

            </div>
        </div>
    </x-form-section>
</x-app-layout>
