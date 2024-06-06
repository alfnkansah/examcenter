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
        <x-dashboard-card data="{{ $classes }}" label="No. of Classes" gradient="card-gradient-blue" />
        <x-dashboard-card data="{{ $subjects }}" label="No. of Subjects" gradient="card-gradient-red" />
        <x-dashboard-card data="{{ $countUsers }}" label="No. Admin Users" gradient="card-gradient-green" />
        <x-dashboard-card data="{{ $countVisist }}" label="All Visitors" gradient="card-gradient-orange" />
        <x-dashboard-card data="{{ $formattedVisitors }}" label="Unique Visitors" gradient="card-gradient-purple" />
        <x-dashboard-card data="{{ $visitLastSevenDays }}" label="Unique Visitors (Last 7 Days)"
            gradient="card-gradient-pink" />
        <x-dashboard-card data="{{ $visitLastMonth }}" label="Unique Visitors (last 30 days)"
            gradient="card-gradient-teal" />
        <x-dashboard-card data="{{ $visitToday }}" label="Unique Visitors (Today)" gradient="card-gradient-yellow" />

    </div>
    <div class="row">
        <div class="col-md-12 grid-margin">

            <x-visitor-chart />
        </div>
    </div>
@endsection
