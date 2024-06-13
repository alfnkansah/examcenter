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
        const tagInput = document.getElementById('tag');
        const programInput = document.getElementById('program_id');
        const levelInput = document.getElementById('level_id');
        // Fetch subjects function
        function fetchSubjects() {
            const examId = examIdInput.value;
            const tagValue = tagInput.value;
            const programValue = programInput.value;
            const levelValue = levelInput.value;

            fetch(
                    `/get-subjects?exam_type_id=${examId}&tag=${tagValue}&program_id=${programValue}&level_id=${levelValue}`
                )
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
        tagInput.addEventListener('change', fetchSubjects);
        programInput.addEventListener('change', fetchSubjects);
        levelInput.addEventListener('change', fetchSubjects);

        // Fetch subjects on page load if old values are available
        fetchSubjects();
    });
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const examIdInput = document.getElementById('exam_type_id');

        // Fetch subjects function
        function fetchCategory() {
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
        examIdInput.addEventListener('change', fetchCategory);

        // Fetch subjects on page load if old values are available
        fetchCategory();
    });
</script>


{{-- 
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const levelIdInput = document.getElementById('level_id');
        const examTypeIdInput = document.getElementById('exam_type_id');
        const tagInput = document.getElementById('tag');
        const programDiv = document.getElementById('program-div');
        const programSelect = document.getElementById('program_id');

        // Fetch exam types function
        function fetchExamTypes() {
            const levelId = levelIdInput.value;
            console.log(levelId);
            fetch(`/get-examtypes?level_id=${levelId}`)
                .then(response => response.json())
                .then(data => {
                    examTypeIdInput.innerHTML = '<option value="">Select Exam Type</option>';

                    data.forEach(examType => {
                        const option = document.createElement('option');
                        option.value = examType.id;
                        option.textContent = examType.name;
                        examTypeIdInput.appendChild(option);
                    });

                    const selectedExamTypeId = "{{ $program->exam_type_id ?? old('exam_type_id') }}";

                    if (selectedExamTypeId) {
                        examTypeIdInput.value = selectedExamTypeId;
                    }

                    // Fetch programs after setting the exam type
                    fetchPrograms();
                })
                .catch(error => {
                    console.error('Error fetching Exam Types:', error);
                });
        }

        // Fetch programs function
        function fetchPrograms() {
            const levelId = levelIdInput.value;
            const examTypeId = examTypeIdInput.value;
            const tagValue = tagInput.value;

            if (levelId && examTypeId && tagValue) {
                fetch(`/get-programs?level_id=${levelId}&exam_type_id=${examTypeId}&tag=${tagValue}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            programDiv.style.display = 'block';
                            programSelect.innerHTML = '<option value="">Select A Program</option>';

                            data.forEach(program => {
                                const option = document.createElement('option');
                                option.value = program.id;
                                option.textContent = program.name;
                                programSelect.appendChild(option);
                            });

                            const selectedProgramId = "{{ $subject->program_id ?? old('program_id') }}";
                            if (selectedProgramId) {
                                programSelect.value = selectedProgramId;
                            }
                        } else {
                            programDiv.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching programs:', error);
                        programDiv.style.display = 'none';
                    });
            } else {
                programDiv.style.display = 'none';
            }
        }

        // Event listeners
        levelIdInput.addEventListener('change', function() {
            fetchExamTypes();
            fetchPrograms();
        });
        examTypeIdInput.addEventListener('change', fetchPrograms);
        tagInput.addEventListener('change', fetchPrograms);

        // Initial fetch on page load
        fetchExamTypes();
    });
</script> --}}

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const levelIdInput = document.getElementById('level_id');
        const examTypeIdInput = document.getElementById('exam_type_id');
        const tagInput = document.getElementById('tag');
        const programDiv = document.getElementById('program-div');
        const programSelect = document.getElementById('program_id');
        fetchExamTypes();

        // Fetch exam types function
        function fetchExamTypes() {
            const levelId = levelIdInput.value;
            if (levelId) {
                fetch(`/get-examtypes?level_id=${levelId}`)
                    .then(response => response.json())
                    .then(data => {
                        examTypeIdInput.innerHTML = '<option value="">Select Exam Type</option>';
                        data.forEach(examType => {
                            const option = document.createElement('option');
                            option.value = examType.id;
                            option.textContent = examType.name;
                            examTypeIdInput.appendChild(option);
                        });
                        const selectedExamTypeId =
                            "{{ $subject->exam_type_id ?? ($program->exam_type_id ?? old('exam_type_id')) }}";
                        if (selectedExamTypeId) {
                            examTypeIdInput.value = selectedExamTypeId;
                        }
                        // Fetch programs after setting the exam type
                        fetchPrograms();
                    })
                    .catch(error => {
                        console.error('Error fetching Exam Types:', error);
                    });
            }
        }

        // Fetch programs function
        function fetchPrograms() {
            const levelId = levelIdInput.value;
            const examTypeId = examTypeIdInput.value;
            const tagValue = tagInput.value;
            if (levelId && examTypeId && tagValue) {
                fetch(`/get-programs?level_id=${levelId}&exam_type_id=${examTypeId}&tag=${tagValue}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data && data.length > 0) {
                            programDiv.style.display = 'block';
                            programSelect.innerHTML = '<option value="">Select Program(s)</option>';
                            data.forEach(program => {
                                const option = document.createElement('option');
                                option.value = program.id;
                                option.textContent = program.name;
                                programSelect.appendChild(option);
                            });
                            // Set selected programs (handles multiple selection)
                            const selectedProgramIds = @json(old('program_ids', isset($subject) ? $subject->programs->pluck('id')->toArray() : []));
                            if (selectedProgramIds) {
                                selectedProgramIds.forEach(programId => {
                                    const option = programSelect.querySelector(
                                        `option[value="${programId}"]`);
                                    if (option) {
                                        option.selected = true;
                                    }
                                });
                            }
                        } else {
                            programDiv.style.display = 'none';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching programs:', error);
                        programDiv.style.display = 'none';
                    });
            } else {
                programDiv.style.display = 'none';
            }
        }

        // Event listeners
        levelIdInput.addEventListener('change', function() {
            fetchExamTypes();
            fetchPrograms();
        });
        examTypeIdInput.addEventListener('change', fetchPrograms);
        tagInput.addEventListener('change', fetchPrograms);

        // Fetch exam types on page load
        fetchExamTypes();
    });
</script>
