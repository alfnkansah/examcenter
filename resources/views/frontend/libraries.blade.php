<x-app-layout>
    <!-- career area start -->
    {{-- <section class="h8_about-area pt-110 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="section-area-8 text-center mb-50">
                        <span class="section-subtitle">Choose Your Level</span>
                        <h2 class="section-title mb-0">Choose Your Level</h2>
                    </div>
                </div>
            </div>
            <div class="row">


                @if ($exams->isEmpty())
                    <div class="alert alert-warning" role="alert">
                        There are currently no exams available. Please check back later.
                    </div>
                @else
                    @foreach ($exams as $exam)
                        <div class="col-xl-6 col-lg-6">
                            <div class="h8_career-item mb-30">
                                <div class="h8_career-item-content">
                                    <span>{{ $exam->short_name }}</span>
                                    <h4 style="margin-bottom: 10px;">{{ $exam->name }}
                                    </h4>
                                    <p style="font-size: 14px;">Prepare for the upcoming
                                        <strong>{{ $exam->short_name }}</strong> with access to
                                        a comprehensive
                                        collection of past questions and resources.
                                    </p>

                                    <a href="{{ route('view-exams-library', ['slug' => $exam->slug, 'id' => $exam->id]) }}"
                                        class="theme-btn theme-btn-8 h8_career-btn">View Resource<i
                                            class="fa-light fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif


            </div>
        </div>
    </section> --}}
    <!-- career area end -->


    <!-- category area start -->
    {{-- <section class="h4_category-area pt-110 pb-70">
        <div class="container">

            <div class="row align-items-end mb-30">
                <div class="col-md-9">
                    <div class="section-area-3 mb-30">
                        <span class="section-subtitle">Popular Subjects</span>
                        <h2 class="section-title mb-0">Featured Subjects</h2>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="h3_category-section-button mb-40 text-md-end">
                        <a href="{{ route('subjects-all') }}" class="theme-btn theme-btn-medium theme-btn-3">All
                            Subjects<i class="fa-light fa-arrow-up-right"></i></a>
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
    </section> --}}
    <!-- category area end -->

    <x-subject-list />

</x-app-layout>
