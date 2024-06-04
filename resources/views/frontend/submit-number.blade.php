<x-app-layout>
    <x-form-section>
        <form action="{{ route('save-phone-number') }}" class="account-form" method="POST">
            @csrf
            <div class="account-form-item mb-20">
                <div class="account-form-label">
                    <label>Your Phone Number</label>
                </div>
                <div class="account-form-input">
                    <input type="hidden" value="{{ $resourceID }}" name="resourceID">
                    <input type="text" placeholder="Enter Your Phone Number" name="student_phone_number"
                        class="form-control @error('student_phone_number') is-invalid @enderror"
                        value="{{ old('student_phone_number') }}" maxlength="13">
                    @error('student_phone_number')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    @if ($errors->has('student_phone_number'))
                        <small class="text-danger">Please enter a valid 10-digit phone number.</small>
                    @elseif(!empty(old('student_phone_number')) && strlen(old('student_phone_number')) < 10)
                        <small class="text-danger">The phone number must be exactly 10 digits.</small>
                    @else
                        <small class="text-muted">Please enter your phone number in the format +1234567890,
                            123-456-7890, or 0240000000.</small>
                    @endif
                </div>


            </div>

            <div class="account-form-button">
                <button type="submit" class="account-btn">Download</button>
            </div>
        </form>

    </x-form-section>

</x-app-layout>
