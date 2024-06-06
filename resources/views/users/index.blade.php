@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Dashboard Admins</h4>
                    <div class="table-responsive">
                        @if ($users->isEmpty())
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
                                            Email
                                        </th>



                                        <th>
                                            Date Added
                                        </th>
                                        {{-- 
                                        <th>
                                            Action
                                        </th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                {{ $user->name }}
                                            </td>

                                            <td>
                                                {{ $user->email }}
                                            </td>
                                            <td>
                                                {{ $user->created_at->format('d - M - Y g:i A') }}
                                            </td>

                                            {{-- <td>
                                                <a href="#" class="btn btn-sm bg-danger text-white delete-action-btn"
                                                    data-action-id="{{ $user->id }}" data-action-type="users">
                                                    Delete
                                                </a>

                                                <form id="delete-form-users-{{ $user->id }}"
                                                    action="{{ route('levels.destroy', $user->id) }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </td> --}}
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
