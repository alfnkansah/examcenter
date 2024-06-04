<x-app-layout>
    <x-form-section>
        <div class="account-form-item mb-20">
            <center>
                <h4>Confirmation.</h4>
            </center>
            <div class="account-form-label">
                <p>We will send a download link for <b>{{ $relatedResource->subject->name }} -
                        {{ $relatedResource->questionType->name }} <span style="color: red;">
                            ({{ $relatedResource->exam_year }})</span></b> to
                    {{ substr($relatedStudent->phone_number, 0, 3) . str_repeat('*', strlen($relatedStudent->phone_number) - 5) . substr($relatedStudent->phone_number, -2) }}
                    via
                    SMS.</p>
            </div><br>
            <form action="{{ route('sms-student-request') }}" method="POST">
                @csrf
                <input type="hidden" name="resource_id" id="resource_id" value="{{ $resource->id }}">
                <div class="account-form-button">
                    <button type="submit" class="account-btn">Send Link</button>
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
