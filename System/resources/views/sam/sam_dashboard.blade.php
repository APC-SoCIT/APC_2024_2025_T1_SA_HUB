@extends('layouts.app')

@section('title', 'Dashboard - Student Assistant Manager')


@section('content')
    @include('include.nav_bar')
    <div class="container">
        <div class="row">
            <div class="col m-0 ps-0">
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
                                        <h2 class="text-right"><i
                                                class="fa fa-cart-plus f-left"></i><span></span>{{ $activeSA }}</h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-3">
                                <div class="card">
                                    <div class="bg-warning py-2 px-3 text-dark bg-opacity-50 bg-gradient shadow">
                                        <h6 class="h4">Inactive SA</h6>
                                        <h2 class="text-right"><i
                                                class="fa fa-cart-plus f-left"></i><span>{{ $inactiveSA }}</span></h2>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 col-xl-3">
                                <div class="card">
                                    <div class="bg-info py-2 px-3 text-dark bg-opacity-50 bg-gradient shadow">
                                        <h6 class="h4">Total SA</h6>
                                        <h2 class="text-right"><i
                                                class="fa fa-cart-plus f-left"></i><span>{{ $totalSA }}</span></h2>
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
    </div>
    @include('nav.offcanvas_menu_sam')
@endsection

@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const activeScholar = @json($activeScholar);
        const probationScholar = @json($probationScholar);
        const revokedScholar = @json($revokedScholar);

        const zeroProbation = @json($zeroProbation);
        const zeroRevoked = @json($zeroRevoked);
        const majorProbation = @json($majorProbation);
        const majorRevoked = @json($majorRevoked);
        const ctx = document.getElementById('myChart');
        const studAct = document.getElementById('studTaskActivity');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: ['Active Scholar', 'Under Probation', 'Revoked Sholarship'],
                datasets: [{
                    label: ' # Student Assistant',
                    data: [activeScholar, probationScholar, revokedScholar],
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
                        text: 'Scholarship Status'
                    },
                }
            }
        });

        new Chart(studAct, {
            type: 'bar',
            data: {
                labels: ['0.0', 'Major Offense'], // Categories for the X-axis
                datasets: [{
                        label: 'On Probation',
                        data: [zeroProbation,
                            majorProbation
                        ], // Replace with actual counts for 0.0 grade revoked and probation
                        backgroundColor: 'rgba(0, 22, 62, .2)', // Color for probation Grade
                        borderColor: 'rgba(0, 22, 62, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Revoked Scholarship',
                        data: [zeroRevoked,
                            majorRevoked
                        ], // Replace with actual counts for major offense revoked and probation
                        backgroundColor: 'rgba(231, 175, 65, .2)', // Color for revoked scholarship
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
                            text: 'Student Assistant'
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
                        text: 'Offense Status'
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
