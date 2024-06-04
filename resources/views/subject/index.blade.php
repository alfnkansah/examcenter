@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Striped Table</h4>
                    <div class="table-responsive">
                        @if ($subjects->isEmpty())
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
                                            Category
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
                                    @foreach ($subjects as $subject)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $subject->name }}
                                            </td>
                                            <td>
                                                {{ $subject->tag }}
                                            </td>

                                            <td>
                                                {{ $subject->level->name }}
                                            </td>

                                            <td>
                                                <a href="{{ route('subjects.edit', $subject->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>

                                                <a href="#" class="btn btn-sm bg-danger text-white delete-action-btn"
                                                    data-action-id="{{ $subject->id }}" data-action-type="subjects">
                                                    Delete
                                                </a>

                                                <form id="delete-form-subjects-{{ $subject->id }}"
                                                    action="{{ route('subjects.destroy', $subject->id) }}" method="POST"
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
