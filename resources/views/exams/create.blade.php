@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Exams Types form</h4>
                    <form class="forms-sample" action="{{ route('exams.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exam">Select Level</label>
                                <select name="level_id" id="level_id" class="form-control" required>
                                    <option value="">Select A Level</option>
                                    @if ($levels->isEmpty())
                                        <option value="">No Levels</option>
                                    @else
                                        @foreach ($levels as $level)
                                            <option value="{{ $level->id }}"
                                                {{ old('level_id') == $level->id ? 'selected' : '' }}>
                                                {{ $level->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>

                            </div>


                            <div class="form-group col-sm-6">
                                <label for="name">Examination Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Basic Education Certificate Examination" value="{{ old('name') }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group col-sm-12">
                                <label for="short_name">Examination Short Name</label>
                                <input type="text" class="form-control" id="short_name" name="short_name"
                                    placeholder="BECE" value="{{ old('short_name') }}">
                                @error('short_name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
