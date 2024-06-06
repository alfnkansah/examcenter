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
                    <h4 class="card-title">All Resources Table</h4>
                    <div class="table-responsive">
                        @if ($resources->isEmpty())
                            <div class="alert alert-info">
                                No record found
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Exam Type</th>
                                        <th>Level</th>
                                        <th>Subject</th>
                                        <th>Paper Type</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($resources as $resource)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $resource->examType->short_name }}</td>
                                            <td>{{ $resource->level->name }}</td>
                                            <td>{{ $resource->subject->name }}</td>
                                            <td>{{ $resource->questionType->name }}</td>
                                            <td>
                                                {{-- <a href="{{ route('resoures.edit', $resource->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a> --}}

                                                <a href="#" class="btn btn-sm bg-danger text-white delete-action-btn"
                                                    data-action-id="{{ $resource->id }}" data-action-type="resoures">
                                                    Delete
                                                </a>

                                                <form id="delete-form-resoures-{{ $resource->id }}"
                                                    action="{{ route('resoures.destroy', $resource->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td>
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
