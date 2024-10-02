@extends('layouts.app')

@section('title', 'Dashboard - Guidance Office')

@section('content')

    <div class="row">
        @include('nav.sideNav_guidance')
        <div class="col m-0 ps-0">
            @include('include.nav_bar')
            <div class="main-background">
                <div class="pt-3">
                    <h2>Dashboard</h2>
                </div>
                <div class="p-3">
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
                            <div class="card ">
                                <div class="bg-success py-2 px-3 text-dark bg-opacity-50 bg-gradient shadow">
                                    <h6 class="h4">Active SA</h6>
                                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>486</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <div class="card">
                                <div class="bg-warning py-2 px-3 text-dark bg-opacity-50 bg-gradient shadow">
                                    <h6 class="h4">Inactive SA</h6>
                                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>486</span></h2>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 col-xl-3">
                            <div class="card">
                                <div class="bg-info py-2 px-3 text-dark bg-opacity-50 bg-gradient shadow">
                                    <h6 class="h4">Total SA</h6>
                                    <h2 class="text-right"><i class="fa fa-cart-plus f-left"></i><span>486</span></h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-3 h-25">
                    <div class="row">
                        <div class="col-5 mb-3">
                            <div class="card px-4 py-3 shadow">
                                <canvas id="myChart"> </canvas>
                            </div>
                        </div>
                        <div class="col-7 mb-3">
                            <div class="card h-100 px-4 py-3 shadow">
                                <canvas class="" id="studTaskActivity"> </canvas>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    @include('nav.offcanvas_menu_guidance')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');
        const studAct = document.getElementById('studTaskActivity');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active Scholar', 'Under Probation', 'Revoked Sholarship'],
                datasets: [{
                    label: ' # Student Assistant',
                    data: [10, 5, 3],
                    backgroundColor: ["#1A2E40", "#FFC300", "#E74C3C"],
                    borderWidth: 3
                }]
            },
            options: {
                // scales: {
                //     y: {
                //         beginAtZero: true
                //     }
                // }
                plugins: {
                    title: {
                        display: true,
                        text: 'Sa Scholarship Status'
                    },
                }
            }
        });

        new Chart(studAct, {
            type: 'bar',
            data: {
                labels: ['Revoked', 'Probation'], // Categories for the X-axis
                datasets: [
                    {
                        label: '0.0',
                        data: [10, 5], // Replace with actual counts for 0.0 grade revoked and probation
                        backgroundColor: 'rgba(0, 22, 62, .2)', // Color for 0.0 Grade
                        borderColor: 'rgba(0, 22, 62, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Major Offense',
                        data: [8, 3], // Replace with actual counts for major offense revoked and probation
                        backgroundColor: 'rgba(231, 175, 65, .2)', // Color for Major Offense
                        borderColor: 'rgba(231, 175, 65, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        title: {
                            display: true,
                            text: 'Number of SAs'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Status'
                        }
                    }
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'SA Offense Status'
                    },
                    legend: {
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            label: function(tooltipItem) {
                                return tooltipItem.dataset.label + ': ' + tooltipItem.raw;
                            }
                        }
                    }
                },
                responsive: true, // Ensure the chart is responsive
                maintainAspectRatio: false,
                resizeDelay: 1000,
            }
        });
    </script>
@endsection
