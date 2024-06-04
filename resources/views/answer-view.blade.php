<x-app-layout>
    <script>
        // Redirect to the PDF file when the page loads
        window.location.href = "{{ asset('storage/' . $resource->file_path) }}";
    </script>
</x-app-layout>
