<x-app-layout>
    <x-form-section>
        <div class="account-form-item mb-20">
            <center>
                <h4>Invalid Token.</h4>
            </center>
            <div class="account-form-label">
                <p>The link you are trying to access is either invalid or has expired. <br> Please request a new link to
                    download the resource.</p>
            </div><br>
            <form action="{{ route('sms-student-request') }}" method="POST">
                @csrf
                <input type="hidden" name="resource_id" id="resource_id" value="{{ $resource->id }}">
                <div class="account-form-button">
                    <button type="submit" class="account-btn">Resend Link</button>
                </div>
            </form>
            <div class="account-break">
                <span>OR</span>
            </div>
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
