@extends('layouts/contentNavbarLayout')

@section('title', 'Dashboard')

@section('vendor-style')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
@endsection

@section('content')
    <div class="d-flex flex-wrap gap-4">
        <div class="card" style="width: 300px;">
            <div class="card-header border-bottom colorBackground">
                <h5 class="mb-0 text-white text-center">Info 1</h5>
            </div>
            <div class="card-body mt-2">
                <h6 class="mb-2">Info 1</h6>
                <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                    <h4 class="mb-0 me-2"> -- --</h4>
                    <small class="text-success mt-1"></small>
                </div>
                <small>Info 1</small>
            </div>
        </div>
        <div class="card" style="width: 300px;">
            <div class="card-header border-bottom colorBackground">
                <h5 class="mb-0 text-white text-center">Info 2</h5>
            </div>
            <div class="card-body mt-2">
                <h6 class="mb-2">Info 2</h6>
                <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                    <h4 class="mb-0 me-2"> -- --</h4>
                    <small class="text-success mt-1"></small>
                </div>
                <small>Info 2</small>
            </div>
        </div>
        <div class="card" style="width: 300px;">
            <div class="card-header border-bottom colorBackground">
                <h5 class="mb-0 text-white text-center">Info 3</h5>
            </div>
            <div class="card-body mt-2">
                <h6 class="mb-2">Info 3</h6>
                <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                    <h4 class="mb-0 me-2"> -- --</h4>
                    <small class="text-success mt-1"></small>
                </div>
                <small>Info 3</small>
            </div>
        </div>
    </div>
@endsection
