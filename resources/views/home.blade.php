<x-app-layout>
    <!-- banner area start -->
    <section class="h10_banner-area">
        <div class="h10_single-banner bg-default" data-background="{{ asset('assets/frontend/img/banner/bg.jpg') }}">
            <div class="container">
                <div class="row justify-content-between align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6">
                        <div class="h10_banner-content mb-60 mb-lg-0">
                            <h1 class="h10_banner-content-title">High School Exam Prep <span>Resources.</span></h1>
                            <p class="h10_banner-content-text">
                                Get ready for BECE and WASSCE with our free past and sample questions.
                            </p>

                            <div class="h10_banner-content-btn mb-60">
                                <a href="{{ route('libraries') }}"
                                   class="theme-btn theme-btn-10 theme-btn-10-transparent">
                                    Access Library
                                    <i class="fa-light fa-arrow-right"></i>
                                </a>
                            </div>
                            {{-- <div class="h10_banner-bottom-info">
                                <span><i class="fa-light fa-book"></i>4k + Question</span>
                                <span><i class="fa-light fa-users"></i>18k Total Student</span>
                                <span><i class="fa-light fa-file-lines"></i>100+ Courses</span>
                            </div> --}}
                        </div>
                    </div>
                    <div class="col-xxl-5 col-xl-6 col-lg-6">
                        <div class="h10_banner-right pl-110">
                            <div class="">
                                <img class="img-thumbnail" src="{{ asset('assets/frontend/img/banner/banner-1.jpeg') }}"
                                     alt="exam-center">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner area end -->


    <section class="h8_about-area pt-120 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="h8_about-wrap ml-30 mb-50">
                        <div class="section-area-8 mb-35">
                            <span class="section-subtitle">Past Question Library</span>
                            <h2 class="section-title mb-20">Free Access to Our Resources</h2>
                            <p class="section-text">Prepare for the upcoming WASSCE and BECE with access to a
                                comprehensive free
                                collection of past questions and resources. </p>
                        </div>

                        <a href="{{ route('libraries') }}" class="theme-btn theme-btn-10">Explore Library<i
                                    class="fa-light fa-arrow-right"></i></a>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">
                    <div class="h8_about-img mr-35 mb-20">
                        <img class="img-thumbnail" src="{{ asset('assets/frontend/img/banner/banner-3.jpeg') }}" alt="">
                    </div>
                </div>

            </div>
        </div>
    </section>


    <section class="h4_category-area pt-130 pb-70">
        <div class="container">
            <div class="row">
                <div class="col-xl-6 col-lg-6">
                    <div class="h8_about-img mr-35 mb-20">
                        <img class="img-thumbnail" src="{{ asset('assets/frontend/img/banner/banner-2.jpeg') }}"
                             alt="lesson">
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6">
                    <div class="h8_about-wrap ml-30 mb-50">
                        <div class="section-area-8 mb-35">
                            <span class="section-subtitle">Coming Soon</span>
                            <h2 class="section-title mb-20">Lessons</h2>
                            <p class="section-text">Difficult JHS/SHS topics broken into simple and easy to understand
                                lessons by expert tutors and college professors.</p>

                        </div>

                        <a href="{{ route('lesson') }}" class="theme-btn theme-btn-8">Access Lesson<i
                                    class="fa-light fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- category area start -->
    {{-- <x-student-subject /> --}}
    <!-- category area end -->

</x-app-layout>
