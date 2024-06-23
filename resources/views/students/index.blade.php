@extends('layouts.admin')
@section('main')

    @push('styles')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- DataTables CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">

        <!-- DataTables Buttons CSS -->
        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">

        <style>
            .dt-buttons .dt-button {
                background-color: #007bff;
                color: white;
                border: none;
                padding: 6px 12px;
                margin: 2px;
                border-radius: 4px;
                cursor: pointer;
            }

            .dt-buttons .dt-button:hover {
                background-color: #0056b3;
            }

            .dt-buttons .dt-button:active {
                background-color: #003f7f;
            }
        </style>
    @endpush
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Student Table</h4>
                    <div class="table-responsive">
                        @if ($students->isEmpty())
                            <div class="alert alert-info">
                                No record found
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Full Name</th>
                                        <th>Level / Form</th>
                                        <th>Phone Number</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $student->full_name }}</td>
                                            <td>
                                                @if ($student->level == 1)
                                                    J.H.S 1
                                                @elseif($student->level == 2)
                                                    J.H.S 2
                                                @elseif($student->level == 3)
                                                    J.H.S 3
                                                @elseif($student->level == 4)
                                                    S.H.S 1
                                                @elseif($student->level == 5)
                                                    S.H.S 2
                                                @elseif($student->level == 6)
                                                    S.H.S 3
                                                @else
                                                    Unknown Level
                                                @endif
                                            </td>

                                            <td>{{ $student->phone_number }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>

        <!-- DataTables Buttons JS -->
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.flash.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.table').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ]
                });
            });
        </script>
    @endpush
@endsection
