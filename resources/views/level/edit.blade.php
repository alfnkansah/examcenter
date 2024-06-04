@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Classes form</h4>
                    <form class="forms-sample" action="{{ route('levels.update', $level->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Class Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="JHS 1"
                                value="{{ old('name', $level->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
