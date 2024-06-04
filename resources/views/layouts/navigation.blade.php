@include('layouts.top-navbar')

<!-- header area start -->
<header>
    <div class="h7_header-area header-sticky">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xxl-5 col-xl-3 col-lg-4 col-6">
                    <div class="h7_header-left">
                        <div class="h7_header-logo">
                            <a href="/">
                                <img src="{{asset('assets/frontend/img/logo/logo.png')}}" alt="logo-img"
                                     style="width: 60%;">
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-7 col-xl-9 col-lg-8 col-6">
                    <div class="h8_header-right">
                        <div class="h7_header-menu d-none d-xl-block">
                            <nav class="h7_main-menu mobile-menu" id="mobile-menu">
                                <ul>
                                    <li><a href="{{ route('homepage') }}">Home</a></li>
                                    <li><a href="{{ route('libraries') }}">Passco Library</a></li>
                                    <li><a href="{{ route('answer-libraries') }}">Answers Library</a></li>
                                    <li><a href="{{ route('lesson') }}">Lessons</a></li>
                                    {{-- <li><a href="/">About Us</a></li>
                                    <li><a href="/">Contact</a></li> --}}
                                </ul>
                            </nav>
                        </div>
                        {{--<div class="h8_header-action d-none d-sm-flex">
                             <a href="#" class="h8_header-login">
                                <svg width="14" height="16" viewBox="0 0 14 16" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.01367 8C8.94667 8 10.5137 6.433 10.5137 4.5C10.5137 2.567 8.94667 1 7.01367 1C5.08068 1 3.51367 2.567 3.51367 4.5C3.51367 6.433 5.08068 8 7.01367 8Z"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                    <path
                                        d="M13.026 14.9996C13.026 12.2906 10.331 10.0996 7.013 10.0996C3.695 10.0996 1 12.2906 1 14.9996"
                                        stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round" />
                                </svg>
                                Login
                            </a>
                            <a href="#" class="h8_header-btn theme-btn theme-btn-8">
                                Get in Touch
                            </a>
                             <a href="#" class="h8_header-search"><i class="fa-light fa-magnifying-glass"></i></a>
                        </div>--}}
                        <div class="header-menu-bar h8_menu-bar d-xl-none ml-10">
                            <span class="header-menu-bar-icon side-toggle">
                                <i class="fa-light fa-bars"></i>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
