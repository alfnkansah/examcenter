@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Exams Type form</h4>

                    @if (session('warning'))
                        <div class="alert alert-warning">
                            {{ session('warning') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('warning') }}
                        </div>
                    @endif


                    <form class="forms-sample" action="{{ route('resoures.store') }}" method="POST"
                        enctype="multipart/form-data">
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
                                <label for="subject">Select Exams Type</label>
                                <select name="exam_type_id" id="exam_type_id" class="form-control" required>
                                    <option value="">Select A Type</option>

                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="subject">Select Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control" required>
                                    <option value="">Select A Subject</option>

                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="subject">Select Exams Category</label>
                                <select name="exam_category_id" id="exam_category_id" class="form-control" required>
                                    <option value="">Select A Category</option>

                                </select>
                            </div>


                            <div class="form-group col-sm-6">
                                <label for="exam_year">Select Year</label>
                                <select name="exam_year" id="exam_year" class="form-control" required>
                                    <option value="">Select Year</option>
                                    @php
                                        $currentYear = now()->year;
                                        $startYear = 2015;
                                    @endphp
                                    @for ($year = $currentYear; $year >= $startYear; $year--)
                                        <option value="{{ $year }}">{{ $year }}</option>
                                    @endfor
                                </select>

                            </div>

                            <div class="form-group col-sm-6">
                                <label for="subject">Select Question Type</label>
                                <select name="question_type" id="question_type" class="form-control" required>
                                    <option value="">Select Question Type</option>
                                    @if ($QuestionType->isEmpty())
                                        <option value="">No Classes Available</option>
                                    @else
                                        @foreach ($QuestionType as $type)
                                            <option value="{{ $type->id }}"
                                                {{ old('question_type') == $type->id ? 'selected' : '' }}>
                                                {{ $type->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="question_file">Question PDF</label>
                                <input type="file" class="form-control" id="question_file" name="question_file"
                                    accept=".pdf" required>
                                @error('question_file')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group col-sm-6">
                                <label for="answer_file">Answer PDF</label>
                                <input type="file" class="form-control" id="answer_file" name="answer_file"
                                    accept=".pdf" required>
                                @error('answer_file')
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
