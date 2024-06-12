@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Program form</h4>
                    <form class="forms-sample" action="{{ route('programs.update', $program->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="level_id">Select Level</label>
                                <select name="level_id" id="level_id" class="form-control" required>
                                    <option value="">Select A Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('level_id', $program->level_id) == $level->id ? 'selected' : '' }}>
                                            {{ $level->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('level_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="subject">Select Exams Type</label>
                                <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                                    <option value="">Select Level First</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="name">Program Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="General Science" value="{{ old('name', $program->name) }}">
                                @error('name')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2">Update</button>
                    </form>


                </div>
            </div>
        </div>
    </div>
@endsection
