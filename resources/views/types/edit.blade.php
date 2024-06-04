@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Question Types form</h4>
                    <form class="forms-sample" action="{{ route('question_type.update', $QuestionType->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Types Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Essay"
                                value="{{ old('name', $QuestionType->name) }}">
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
