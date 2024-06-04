@if ($subjects->isEmpty())
    <div class="alert alert-warning" role="alert">
        There are currently no subjects available for this exam type. Please check back
        later.
    </div>
@else
    @foreach ($subjects as $subject)
        <!-- Include the subject card component -->
        <x-subject-card :subject="$subject" />
    @endforeach
@endif
