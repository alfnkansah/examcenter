<x-app-layout>
    <x-form-section>
        <form action="{{ route('save-student-detials') }}" method="post" class="account-form">
            @csrf
            <input type="hidden" name="student_id" id="student_id" value="{{ $studentID }}">
            <input type="hidden" name="resource_id" id="resource_id" value="{{ $token }}">
            <div class="account-form-item mb-20">
                <div class="account-form-label">
                    <label>Your Full Name</label>
                </div>
                <div class="account-form-input">
                    <input type="text" placeholder="Enter Your Full Name" name="student_name"
                        class="@error('student_name') is-invalid @enderror">
                </div>
            </div>

            <div class="account-form-item mb-20">
                <div class="account-form-label">
                    <label>Your Level</label>
                </div>
                <div class="account-form-input">
                    <select class="form-control @error('student_level') is-invalid @enderror" name="student_level">
                        <option value="">Select Your Level</option>
                        <option value="1" {{ old('student_level') == 1 ? 'selected' : '' }}>Form 1</option>
                        <option value="2" {{ old('student_level') == 2 ? 'selected' : '' }}>Form 2</option>
                        <option value="3" {{ old('student_level') == 3 ? 'selected' : '' }}>Form 3</option>
                    </select>
                </div>
            </div>

            <div class="account-form-button">
                <button type="submit" class="account-btn">Download</button>
            </div>
        </form>
    </x-form-section>
</x-app-layout>
