<!-- course area start -->
<section class="h4_category-area pt-130 pb-110">
    <div class="container">
        <div class="row align-items-end mb-10">
            <div class="col-xl-5 col-lg-6">
                <div class="section-area-10 mb-40">
                    <h2 class="section-title mb-0">Library</h2>
                </div>
            </div>

            <div class="col-xl-7 col-lg-6">
                <div class="h10_course-tab mb-30">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="see-all-tab" type="button" role="tab"
                                aria-controls="see-all" aria-selected="true" data-bs-toggle="pill">
                                See All
                            </button>
                        </li>


                        @foreach ($exams as $exam)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link exam-tab" id="exam-tab-{{ $exam->id }}"
                                    data-exam-id="{{ $exam->id }}" data-bs-toggle="pill" type="button"
                                    role="tab" aria-controls="exam-{{ $exam->id }}" aria-selected="false">
                                    {{ $exam->short_name }}
                                </button>
                            </li>
                        @endforeach


                    </ul>
                </div>
            </div>

        </div>
        <div class="h10_course-wrap">
            <div class="tab-content" id="pills-tabContent">

                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab"
                    tabindex="0">
                    <div class="row" id="subject-container">
                        <!-- Placeholder for dynamically loaded subjects -->
                    </div>
                </div>



            </div>
        </div>
    </div>
</section>
<!-- course area end -->


@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get the "See All" button element
            const seeAllButton = document.getElementById('see-all-tab');

            // Add click event listener to the "See All" button
            seeAllButton.addEventListener('click', function() {
                // Fetch and display all subjects
                fetchAllSubjects();
            });

            // Fetch subjects associated with the selected exam type when a tab is clicked
            document.querySelectorAll('.exam-tab').forEach(tab => {
                tab.addEventListener('click', function() {
                    // Fetch subjects associated with the selected exam type
                    const examId = this.dataset.examId;

                    fetchSubjects(examId);
                });
            });

            // Fetch all subjects initially when the page is loaded
            fetchAllSubjects();
        });

        // Function to fetch all subjects
        function fetchAllSubjects() {
            fetch('/subjects/all')
                .then(response => response.json())
                .then(data => {
                    // Render the fetched subjects
                    renderContent(data);
                })
                .catch(error => {
                    console.error('Error fetching subjects:', error);
                });
        }

        // Function to fetch subjects associated with a specific exam type
        function fetchSubjects(examTypeId) {
            fetch(`/exams/${examTypeId}/content`)
                .then(response => response.json())
                .then(data => {
                    // Render the fetched content
                    renderContent(data);
                })
                .catch(error => {
                    console.error('Error fetching content:', error);
                });
        }

        // Function to render fetched content
        function renderContent(data) {
            // Render the fetched content in the appropriate element
            const contentContainer = document.getElementById('subject-container');
            contentContainer.innerHTML = data.html;
        }
    </script>
@endpush
