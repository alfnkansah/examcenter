<x-app-layout>
    <x-form-section>
        <div class="account-form-item mb-20">
            <div class="text-center">
                <h4>Download Resource</h4>
            </div>
            <div class="account-form-label">
                <p>Thank you for using {{ env('APP_NAME') }}. Please click the button below to download the resource.
                </p>
            </div><br>

            <div class="account-form-button">
                <a id="download-link" href="{{ asset('storage/' . $file->file_path) }}" download>
                    <button id="download-button" type="button" class="account-btn">
                        <span class="button-text">Click To Download</span>
                        <span class="loading-spinner" style="display: none;"></span>
                    </button>
                </a>
            </div>



            <div class="account-break">
                <span>OR</span>
            </div>
            <div class="account-bottom">
                <div class="account-option">

                    <a href="{{ route('view-answer', $file->id) }}" class="account-option-account">
                        <span>View Answer</span>
                    </a>
                </div>

            </div>
        </div>
    </x-form-section>

    <style>
        /* Style for the loading spinner */
        .loading-spinner {
            border: 4px solid #f3f3f3;
            /* Light grey */
            border-top: 4px solid #3498db;
            /* Blue */
            border-radius: 50%;
            width: 25px;
            height: 25px;
            animation: spin 2s linear infinite;
            margin-left: 10px;
            /* Space between button text and spinner */
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Disable button style */
        .account-btn:disabled {
            background-color: #cccccc;
            /* Grey background */
            cursor: not-allowed;
        }
    </style>

    @push('scripts')
        <script>
            document.getElementById('download-link').addEventListener('click', function(event) {
                var downloadButton = document.getElementById('download-button');
                var buttonText = downloadButton.querySelector('.button-text');
                var loadingSpinner = downloadButton.querySelector('.loading-spinner');

                // Show the loading spinner and disable the button
                buttonText.style.display = 'none';
                loadingSpinner.style.display = 'inline-block';
                downloadButton.disabled = true;

                // Restore the button state after download starts
                setTimeout(function() {
                    // Here you can optionally restore the button state if needed
                    buttonText.style.display = 'inline';
                    loadingSpinner.style.display = 'none';
                    downloadButton.disabled = false;
                }, 3000); // Adjust the timeout duration if needed
            });
        </script>
    @endpush

</x-app-layout>
