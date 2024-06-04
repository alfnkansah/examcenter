<section class="h10_category-area pt-120 pb-120">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-6">
                <div class="section-area-10 mb-55 text-center">
                    <h2 class="section-title mb-20">Our Latest Articles</h2>
                    <p class="section-text"> subjects tailored for children on your website. You can customize <br>
                        this based on the specific educational categories you offer</p>
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($subjects as $subject)
                <x-subject-card :subject="$subject" />
            @endforeach

            <div class="col-12">
                <div class="h10_category-item-btn pt-30">
                    <a href="#">Visit more Category<i class="fa-light fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</section>
