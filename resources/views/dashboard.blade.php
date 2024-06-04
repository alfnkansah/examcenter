@extends('layouts.admin')
@section('main')
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="row">
                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                    <h3 class="font-weight-bold"><span style="color: red;">{{ $greeting }}</span>
                        {{ Auth()->user()->name }}</h3>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <x-dashboard-card data="{{ $classes }}" label="No. of Classes" />
        <x-dashboard-card data="{{ $subjects }}" label="No. of Subjects" />
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">

            <x-visitor-chart />
        </div>
    </div>
@endsection
