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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    const arsipLabels = @json($labels);
    const arsipData = @json($data);

    const ctx = document.getElementById('myChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: arsipLabels,
            datasets: [{
                label: 'Jumlah Arsip',
                data: arsipData,
                backgroundColor: 'rgba(41, 101, 255, 0.93)',
                borderColor: 'rgba(41, 101, 255, 0.93)',
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
@endsection

@section('content')
    {{-- @if(Auth::user()->role !== "General Admin") --}}
    <div class="d-flex flex-wrap gap-4">
        <div class="card" style="width: 300px;">
            <div class="card-header border-bottom colorBackground">
                <h5 class="mb-0 text-white text-center">Direktorat 81</h5>
            </div>
            <div class="card-body mt-2">
                <h6 class="mb-2">Jumlah Arsip</h6>
                <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                    <h4 class="mb-0 me-2">{{ $roleCounts['Direktorat 81'] ?? '--' }}</h4>
                    <small class="text-success mt-1"></small>
                </div>
                <small>Direktorat 81</small>
            </div>
        </div>
        <div class="card" style="width: 300px;">
            <div class="card-header border-bottom colorBackground">
                <h5 class="mb-0 text-white text-center">Direktorat 82</h5>
            </div>
            <div class="card-body mt-2">
                <h6 class="mb-2">Jumlah Arsip</h6>
                <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                    <h4 class="mb-0 me-2">{{ $roleCounts['Direktorat 82'] ?? '--' }}</h4>
                    <small class="text-success mt-1"></small>
                </div>
                <small>Direktorat 82</small>
            </div>
        </div>
        <div class="card" style="width: 300px;">
            <div class="card-header border-bottom colorBackground">
                <h5 class="mb-0 text-white text-center">Direktorat 83</h5>
            </div>
            <div class="card-body mt-2">
                <h6 class="mb-2">Jumlah Arsip</h6>
                <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                    <h4 class="mb-0 me-2">{{ $roleCounts['Direktorat 83'] ?? '--' }}</h4>
                    <small class="text-success mt-1"></small>
                </div>
                <small>Direktorat 83</small>
            </div>
        </div>
        <div class="card" style="width: 300px;">
            <div class="card-header border-bottom colorBackground">
                <h5 class="mb-0 text-white text-center">Direktorat 84</h5>
            </div>
            <div class="card-body mt-2">
                <h6 class="mb-2">Jumlah Arsip</h6>
                <div class="d-flex flex-wrap align-items-center mb-2 pb-1">
                    <h4 class="mb-0 me-2">{{ $roleCounts['Direktorat 84'] ?? '--' }}</h4>
                    <small class="text-success mt-1"></small>
                </div>
                <small>Direktorat 84</small>
            </div>
        </div>
        <canvas id="myChart" width="400" height="200"></canvas>
    </div>
    {{-- @endif --}}
@endsection
