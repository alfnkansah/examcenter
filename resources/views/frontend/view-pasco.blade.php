<x-app-layout>
    <!-- category area start -->
    <section class="h4_category-area pt-50 pb-110">
        <div class="container">
            <div class="row align-items-end mb-10">
                <div class="col-md-9">
                    <div class="section-area-3">
                        <span class="section-subtitle">{{ $category->examType->short_name }}
                            {{ $category->name }}</span>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="h3_category-section-button mb-40 text-md-end">

                    </div>
                </div>
            </div>

            <div class="row mb-50">

                <form class="forms-sample" id="filterForm">

                    @csrf
                    <div class="row">
                        <input type="hidden" value="{{ $id }}" name="category_id" id="category_id">
                        <div class="form-group col-sm-3 col-6">
                            <label for="exam_year">Select Year</label>
                            <select name="exam_year" id="exam_year" class="form-control" required>
                                <option value="">Select Year</option>
                                @php
                                    $currentYear = now()->year;
                                    $startYear = 2015;
                                @endphp
                                @for ($year = $currentYear; $year >= $startYear; $year--)
                                    <option value="{{ $year }}">{{ $year }}</option>
                                @endfor
                            </select>

                        </div>

                        <div class="form-group col-sm-3 col-6">
                            <label for="exam">Subject Category</label>
                            <select name="category" id="category" class="form-control">
                                <option value="">Select to filter</option>
                                <option value="core">Core Subjects</option>
                                <option value="elective">Elective Subjects</option>

                            </select>

                        </div>

                        <div class="form-group col-sm-3 col-6">
                            <label for="exam">Select Subject</label>
                            <select name="subject_id" id="subject_id" class="form-control">
                                <option value="">Select A Subject</option>
                                @if ($subjects->isEmpty())
                                    <option value="">No Subjects Available</option>
                                @else
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}"
                                            {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                            {{ $subject->name }}
                                        </option>
                                    @endforeach
                                @endif
                            </select>

                        </div>



                    </div>
                    <br>

                </form>
            </div>


            <div id="loading-indicator" class="loader-wrapper">
                <div class="loader"></div>
                <div>Loading...</div>
            </div>


            <div id="main-container">
                <div id="quiz-container" class="row">
                    <!-- Content will be loaded here -->
                </div>
            </div>

        </div>
    </section>
    <!-- category area end -->



    @push('scripts')
        <script>
            function fetchFilteredResources() {
                const id = {{ $id }};
                const url = `/load-initial-resources?id=${id}`; // Send ID as a query parameter

                // Show loading indicator
                document.getElementById('main-container').style.display = 'none';
                document.getElementById('loading-indicator').style.display = 'block';

                fetch(url)
                    .then(response => response.json())
                    .then(data => {
                        // Hide loading indicator
                        document.getElementById('loading-indicator').style.display = 'none';
                        document.getElementById('main-container').style.display = 'block';
                        document.getElementById('quiz-container').innerHTML = data.html;
                    })
                    .catch(error => {
                        console.error('Error fetching quizzes:', error);
                        // Hide loading indicator on error
                        document.getElementById('loading-indicator').style.display = 'none';
                    });
            }

            document.addEventListener('DOMContentLoaded', function() {
                fetchFilteredResources();
                document.getElementById('searchButton').addEventListener('click', function(event) {
                    event.preventDefault(); // Prevent the default form submission
                    // document.querySelector('form').reset();
                    fetchFilteredResources();
                });
            });
        </script>

        <script>
            document.getElementById('exam_year').addEventListener('change', fetchResources);
            document.getElementById('subject_id').addEventListener('change', fetchResources);
            document.getElementById('category').addEventListener('change', fetchResources);

            function fetchResources() {
                const selectedYear = document.getElementById('exam_year').value;
                const selectedSubjectId = document.getElementById('subject_id').value;
                const categoryID = document.getElementById('category_id').value;
                const category = document.getElementById('category').value;

                // Show loading indicator
                document.getElementById('main-container').style.display = 'none';
                document.getElementById('loading-indicator').style.display = 'block';

                fetch(
                        `/filter-resources?exam_year=${selectedYear}&subject_id=${selectedSubjectId}&category_id=${categoryID}&category=${category}`
                    )
                    .then(response => response.json())
                    .then(data => {
                        // Hide loading indicator
                        document.getElementById('main-container').style.display = 'block';
                        document.getElementById('loading-indicator').style.display = 'none';
                        document.getElementById('quiz-container').innerHTML = data.html;
                    })
                    .catch(error => {
                        console.error('Error fetching lectures:', error);
                        // Hide loading indicator on error
                        document.getElementById('loading-indicator').style.display = 'none';
                    });
            }

            // Fetch lectures when the page loads
            fetchResources();
        </script>
    @endpush

</x-app-layout>
