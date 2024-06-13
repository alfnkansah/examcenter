@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Subject form</h4>
                    <form class="forms-sample" action="{{ route('subjects.update', $subject->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')


                        <div class="row">
                            <div class="form-group col-sm-6">
                                <label for="exam">Select Level</label>
                                <select name="level_id" id="level_id" class="form-control" required>
                                    <option value="">Select A Level</option>
                                    @foreach ($levels as $level)
                                        <option value="{{ $level->id }}"
                                            {{ old('level_id', $subject->level_id) == $level->id ? 'selected' : '' }}>
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

                            <div class="form-group col-sm-6">
                                <label for="subject">Select Category</label>
                                <select name="tag" id="tag" class="form-control" required>
                                    <option value="">Select Category</option>
                                    <option value="core" {{ $subject->tag == 'core' ? 'selected' : '' }}>Core Subjects
                                    </option>
                                    <option value="elective" {{ $subject->tag == 'elective' ? 'selected' : '' }}>Elective
                                        Subjects</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-6" id="program-div" style="display: none;">
                                <label>Select Program(s)</label>
                                <select class="form-control js-example-basic-multiple" name="program_ids[]" id="program_id"
                                    multiple="multiple" style="width: 100%;">
                                    <option value="">Select Program(s)</option>
                                </select>
                            </div>

                            <div class="form-group col-sm-12">
                                <label for="name">Subject Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="English Language" value="{{ old('name', $subject->name) }}">
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
