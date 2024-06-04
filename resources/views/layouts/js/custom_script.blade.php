<script>
    document.addEventListener('DOMContentLoaded', function() {
        const deleteButtons = document.querySelectorAll('.delete-action-btn');

        deleteButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();

                const actionId = this.dataset.actionId;
                const actionType = this.dataset.actionType;
                const quizID = this.dataset.quizID;

                console.log('Action ID:', actionId);
                console.log('Action Type:', actionType);
                console.log('Quiz ID:', quizID);

                // Show SweetAlert confirmation dialog
                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You will not be able to revert this action!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        // If user confirms, submit the corresponding form
                        const form = document.getElementById('delete-form-' +
                            actionType + '-' + actionId);
                        console.log('Form:', form);
                        form.submit();
                    }
                });
            });
        });
    });
</script>



<!-- In your Blade template -->
<script>
    var timezone = Intl.DateTimeFormat().resolvedOptions().timeZone ?? 'Africa/Accra';


    $.ajax({
        url: '/update-timezone',
        type: 'POST',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: {
            timezone: timezone
        },
        success: function(response) {
            // console.log('Timezone updated successfully');
            // console.log(timezone);
        },
        error: function(xhr, status, error) {
            console.error('Error updating timezone:', error);
        }
    });
</script>


<script>
    // Automatically close alerts after 5 seconds
    $(document).ready(function() {
        $('.alert_dismis').delay(5000).fadeOut('slow');
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const examIdInput = document.getElementById('exam_type_id');

        // Fetch subjects function
        function fetchSubjects() {
            const examId = examIdInput.value;


            fetch(`/get-subjects?exam_type_id=${examId}`)
                .then(response => response.json())
                .then(data => {
                    const subjectsDropdown = document.getElementById('subject_id');
                    subjectsDropdown.innerHTML = '<option>Select subject</option>';

                    // Loop through fetched subjects and append options to the dropdown
                    data.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject.id;
                        option.textContent = subject.name;
                        subjectsDropdown.appendChild(option);
                    });

                    // Set the old selected subject if available
                    const oldsubjectId = "{{ old('subject_id') }}";
                    if (oldsubjectId) {
                        subjectsDropdown.value = oldsubjectId;
                    }
                })
                .catch(error => {
                    console.error('Error fetching subjects:', error);
                });
        }

        // Event listeners
        examIdInput.addEventListener('change', fetchSubjects);

        // Fetch subjects on page load if old values are available
        fetchSubjects();
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const examIdInput = document.getElementById('exam_type_id');

        // Fetch subjects function
        function fetchSubjects() {
            const examId = examIdInput.value;


            fetch(`/get-categories?exam_type_id=${examId}`)
                .then(response => response.json())
                .then(data => {
                    const subjectsDropdown = document.getElementById('exam_category_id');
                    subjectsDropdown.innerHTML = '<option>Select Category</option>';

                    // Loop through fetched subjects and append options to the dropdown
                    data.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject.id;
                        option.textContent = subject.name;
                        subjectsDropdown.appendChild(option);
                    });

                    // Set the old selected subject if available
                    const oldsubjectId = "{{ old('exam_category_id') }}";
                    if (oldsubjectId) {
                        subjectsDropdown.value = oldsubjectId;
                    }
                })
                .catch(error => {
                    console.error('Error fetching subjects:', error);
                });
        }

        // Event listeners
        examIdInput.addEventListener('change', fetchSubjects);

        // Fetch subjects on page load if old values are available
        fetchSubjects();
    });
</script>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const levelIdInput = document.getElementById('level_id');

        // Fetch subjects function
        function fetchExamTypes() {
            const levelId = levelIdInput.value;


            fetch(`/get-examtypes?level_id=${levelId}`)
                .then(response => response.json())
                .then(data => {
                    const subjectsDropdown = document.getElementById('exam_type_id');
                    subjectsDropdown.innerHTML = '<option>Select Exam Type</option>';

                    // Loop through fetched subjects and append options to the dropdown
                    data.forEach(subject => {
                        const option = document.createElement('option');
                        option.value = subject.id;
                        option.textContent = subject.name;
                        subjectsDropdown.appendChild(option);
                    });

                    // Set the old selected subject if available
                    const oldsubjectId = "{{ old('exam_type_id') }}";
                    if (oldsubjectId) {
                        subjectsDropdown.value = oldsubjectId;
                    }
                })
                .catch(error => {
                    console.error('Error fetching Exam Types:', error);
                });
        }

        // Event listeners
        levelIdInput.addEventListener('change', fetchExamTypes);

        // Fetch subjects on page load if old values are available
        fetchExamTypes();
    });
</script>
