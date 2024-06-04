<x-app-layout>
    <!-- category area start -->
    <section class="h4_category-area pt-110 pb-70">
        <div class="container">

            <div class="row align-items-end mb-30">
                <div class="col-md-9">
                    <div class="section-area-3 mb-30">
                        <span class="section-subtitle">{{ $exam->short_name }} Subjects</span>
                        <h2 class="section-title mb-0">{{ $exam->short_name }} Subjects</h2>
                    </div>
                </div>

            </div>

            <div class="row g-0">
                @if ($subjects->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        There are currently no subjects available. Please check back later.
                    </div>
                @else
                    @foreach ($subjects as $subject)
                        <x-subject-card :subject="$subject" />
                    @endforeach
                @endif

            </div>
        </div>
    </section>
    <!-- category area end -->

    {{-- pasco --}}
</x-app-layout>
