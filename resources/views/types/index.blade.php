@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Question Type Table</h4>
                    <div class="table-responsive">
                        @if ($types->isEmpty())
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
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($types as $type)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $type->name }}
                                            </td>
                                            <td>
                                                <a href="{{ route('question_type.edit', $type->id) }}"
                                                    class="btn btn-sm btn-primary">Edit</a>

                                                <a href="#" class="btn btn-sm bg-danger text-white delete-action-btn"
                                                    data-action-id="{{ $type->id }}" data-action-type="questionType">
                                                    Delete
                                                </a>

                                                <form id="delete-form-questionType-{{ $type->id }}"
                                                    action="{{ route('question_type.destroy', $type->id) }}" method="POST"
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
