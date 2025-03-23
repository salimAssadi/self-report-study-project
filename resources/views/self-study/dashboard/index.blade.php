@extends('layouts.admin-app')
@section('page-title')
    {{ __('Dashboard') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item" aria-current="page">{{ __('Dashboard') }}</li>
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
                            <div class="avtar bg-light-warning">
                                <i class="ti ti-package f-24"></i>
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
                            <div class="avtar bg-light-primary">
                                <i class="ti ti-history f-24"></i>
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
                                <i class="ti ti-credit-card f-24"></i>
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
                            <div class="avtar bg-light-danger">
                                <i class="ti ti-credit-card f-24"></i>
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
                            <div class="avtar bg-light-danger">
                                <i class="ti ti-file f-24"></i>
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
                            <div class="avtar bg-light-danger">
                                <i class="ti ti-credit-card f-24"></i>
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
                            <div class="avtar bg-light-danger">
                                <i class="ti ti-file f-24"></i>
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

     

    </div>
@endsection
