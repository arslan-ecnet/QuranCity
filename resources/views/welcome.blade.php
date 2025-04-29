@extends('layouts.app')
@section('title')
    <title>Quran City</title>
@endsection
@section('content')
    <div class="dash-content">
        <div class="content-wrap">
            <div class="row top-content">
                <div class="col-lg-6">
                    <div class="box-content box-shadow p-4 p-md-5">
                        <div class="title d-flex align-items-center justify-content-between">
                            <h5>Registered Users</h5>
                            <span class="">{{$totalUsers}}</span>
                        </div>
                        <div class="full-img"></div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="box-content box-shadow  p-4 p-md-5">
                        <div class="title d-flex align-items-center justify-content-between">
                            <h5>Total Surahs</h5>
                            <span class="">{{$totalSurahs}}</span>
                        </div>
                        <div class="text-center"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bottom-content d-none d-lg-block">

        </div>
        <div class="row mt-4">
            <div class="col-6">
                <div class="box-content box-shadow p-4">
                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <h6>Users Registered</h6>
                            <div><span class="fw-bold text-warning">This Week: {{ $thisWeekTotal }}</span></div>
                            <div><span class="fw-bold text-secondary">Previous Week: {{ $lastWeekTotal }}</span></div>
                        </div>
                    </div>
                    <canvas id="userComparisonChart" height="100"></canvas>
                </div>
            </div>
        </div>


    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('userComparisonChart').getContext('2d');
        const userComparisonChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [
                    {
                        label: 'This Week',
                        data: {!! json_encode($thisWeek) !!},
                        borderColor: '#DAA520',
                        backgroundColor: 'rgba(218,165,32,0.1)',
                        tension: 0.4,
                        fill: false,
                        pointRadius: 5,
                        pointHoverRadius: 8
                    },
                    {
                        label: 'Previous Week',
                        data: {!! json_encode($lastWeek) !!},
                        borderColor: '#C0C0C0',
                        backgroundColor: 'rgba(192,192,192,0.1)',
                        tension: 0.4,
                        fill: false,
                        borderDash: [5, 5],
                        pointRadius: 5,
                        pointHoverRadius: 8
                    }
                ]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { position: 'bottom' }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        suggestedMax: Math.max(...{!! json_encode($thisWeek) !!}, ...{!! json_encode($lastWeek) !!}) + 100
                    }
                }
            }
        });
    </script>

@endsection
