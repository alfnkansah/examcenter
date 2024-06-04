@extends('layouts.admin')
@section('main')

    @push('styles')
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

        <!-- DataTables JS -->
        <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
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
                                                    Form 1
                                                @elseif($student->level == 2)
                                                    Form 2
                                                @elseif($student->level == 3)
                                                    Form 3
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
        <script>
            $(document).ready(function() {
                $('.table').DataTable();
            });
        </script>
    @endpush
@endsection
