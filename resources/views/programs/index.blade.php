@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Programs Table</h4>
                    <div class="table-responsive">
                        @if ($programs->isEmpty())
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
                                            Exams Type
                                        </th>
                                        <th>
                                            Level
                                        </th>
                                        <th>
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($programs as $program)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $program->name }}
                                            </td>
                                            <td>
                                                {{ $program->examType->short_name }}
                                            </td>

                                            <td>
                                                {{ $program->level->name }}
                                            </td>

                                            <td>
                                                <a href="{{ route('programs.edit', $program->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>

                                                <a href="#" class="btn btn-sm bg-danger text-white delete-action-btn"
                                                    data-action-id="{{ $program->id }}" data-action-type="programs">
                                                    Delete
                                                </a>

                                                <form id="delete-form-programs-{{ $program->id }}"
                                                    action="{{ route('programs.destroy', $program->id) }}" method="POST"
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
