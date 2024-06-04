@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <div class="table-responsive">
                        @if ($examsTypes->isEmpty())
                            <div class="alert alert-info">
                                No record found
                            </div>
                        @else
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Short Name
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($examsTypes as $exams)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $exams->name }}
                                            </td>
                                            <td>
                                                {{ $exams->short_name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('exams.edit', $exams->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>

                                                <a href="#" class="btn btn-sm bg-danger text-white delete-action-btn"
                                                    data-action-id="{{ $exams->id }}" data-action-type="exams">
                                                    Delete
                                                </a>

                                                <form id="delete-form-exams-{{ $exams->id }}"
                                                    action="{{ route('exams.destroy', $exams->id) }}" method="POST"
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
@endsection
