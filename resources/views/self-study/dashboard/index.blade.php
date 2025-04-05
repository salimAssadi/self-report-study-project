@extends('layouts.admin-app')
@section('page-title')
    {{ __('Dashboard') }}
@endsection
@section('breadcrumb')
    <!-- Tabs -->
    <ul class="nav nav-tabs" id="dashboardTabs" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="standards-tab" data-bs-toggle="tab" data-bs-target="#standards" type="button"
                role="tab" aria-controls="standards" aria-selected="true">{{ __('Standards') }}</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="criteria-tab" data-bs-toggle="tab" data-bs-target="#criteria" type="button"
                role="tab" aria-controls="criteria" aria-selected="false">{{ __('Criteria') }}</button>
        </li>
    </ul>
@endsection
@push('script-page')
    {{-- <script>
        var documentByCategoryData = {!! json_encode($result['documentByCategory']['data']) !!};
        var documentByCategory = {!! json_encode($result['documentByCategory']['category']) !!};
        var documentBySubCategoryData = {!! json_encode($result['documentBySubCategory']['data']) !!};
        var documentBySubCategory = {!! json_encode($result['documentBySubCategory']['category']) !!};
    </script> --}}
    {{-- <script src="{{ asset('js/dashboard.js') }}"></script> --}}

    <script>
        var options = {
            chart: {
                type: 'area',
                height: 250,
                toolbar: {
                    show: false
                }
            },
            colors: ['#2ca58d', '#0a2342'],
            dataLabels: {
                enabled: false
            },
            legend: {
                show: true,
                position: 'top'
            },
            markers: {
                size: 1,
                colors: ['#fff', '#fff', '#fff'],
                strokeColors: ['#2ca58d', '#0a2342'],
                strokeWidth: 1,
                shape: 'circle',
                hover: {
                    size: 4
                }
            },
            stroke: {
                width: 2,
                curve: 'smooth'
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shadeIntensity: 1,
                    type: 'vertical',
                    inverseColors: false,
                    opacityFrom: 0.5,
                    opacityTo: 0
                }
            },
            grid: {
                show: false
            },
            series: [{
                name: "{{ __('Total Document') }}",
                data: documentByCategoryData
            }, ],
            xaxis: {
                categories: documentByCategory,
                tooltip: {
                    enabled: false
                },
                labels: {
                    hideOverlappingLabels: true
                },
                axisBorder: {
                    show: false
                },
                axisTicks: {
                    show: false
                }
            }
        };
        var chart = new ApexCharts(document.querySelector('#document_by_cat'), options);
        chart.render();
    </script>
@endpush
@section('content')
    <div class="tab-content mt-3" id="dashboardTabsContent">
        <!-- Standards Tab -->
        <div class="tab-pane fade show active" id="standards" role="tabpanel" aria-labelledby="standards-tab">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-secondary">
                                        <i class="ti ti-users f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Total Users') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $totalUsers }}</h4>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-secondary">
                                        <i class="ti ti-list-check f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Main Standards Count') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $totalMainStandards }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-warning">
                                        <i class="ti ti-package f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Sub Standards Count') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $totalSubStandards }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-success">
                                        <i class="ti ti-circle-check  f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Completed') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $counts['completed'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-warning">
                                        <i class="ti ti-alert-triangle f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Partially Completed') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $counts['partially_completed'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-danger">
                                        <i class="ti ti-circle-x f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Incomplete') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $counts['incomplete'] }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="tab-pane fade" id="criteria" role="tabpanel" aria-labelledby="criteria-tab">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-primary">
                                        <i class="ti ti-list-check f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Number of Criteria') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $totalCriteria }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-danger">
                                        <i class="ti ti-circle-x f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Not Fulfilled') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $notFulfilled }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-warning">
                                        <i class="ti ti-alert-triangle f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Partially Fulfilled') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $partiallyFulfilled }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-success">
                                        <i class="ti ti-circle-check f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Fulfilled') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $fulfilled }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-primary">
                                        <i class="ti ti-sunrise f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Fulfilled with Precision') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $fulfilledWithPrecision }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-success">
                                        <i class="ti ti-medal f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Fulfilled with Excellence') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $fulfilledWithExcellence }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-success">
                                        <i class="ti ti-thumb-up f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Matching') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $counts['criteria_matching'] ?? 0 }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <div class="avtar bg-light-danger">
                                        <i class="ti ti-thumb-down f-24"></i>
                                    </div>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <p class="mb-1">{{ __('Not Matching') }}</p>
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="mb-0">{{ $counts['criteria_non_matching'] }}
                                        </h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
