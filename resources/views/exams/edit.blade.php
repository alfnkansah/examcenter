@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Exams Types form</h4>
                    <form class="forms-sample" action="{{ route('exams.update', $examType->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="name">Examination Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Basic Education Certificate Examination"
                                value="{{ old('name', $examType->name) }}">
                            @error('name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="short_name">Examination Short Name</label>
                            <input type="text" class="form-control" id="short_name" name="short_name" placeholder="BECE"
                                value="{{ old('short_name', $examType->short_name) }}">
                            @error('short_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
