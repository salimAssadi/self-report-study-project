@extends('layouts.admin')
@section('page-title')
    {{ __('Dashboard') }}
@endsection
@push('script-page')
    <?php $settings = Utility::settings(); ?>
    <script>
        var timezone = '{{ !empty($settings['timezone']) ? $settings['timezone'] : 'Asia/Kolkata' }}';

        let today = new Date(new Date().toLocaleString("en-US", {
            timeZone: timezone
        }));
        var curHr = today.getHours()
        var target = document.getElementById("greetings");

        if (curHr < 12) {
            target.innerHTML = "{{__('Good Morning,')}}";
        } else if (curHr < 17) {
            target.innerHTML = "{{__('Good Afternoon,')}}";
        } else {
            target.innerHTML = "{{__('Good Evening,')}}";
        }
       
    </script>
@endpush
@section('content')
    @php
        $logo = \App\Models\Utility::get_file('uploads/logo/');
        $company_logo = \App\Models\Utility::getValByName('company_logo');
        $profile = \App\Models\Utility::get_file('uploads/profile/');
        $logo1 = \App\Models\Utility::get_file('uploads/is_cover_image/');
        $users = Auth::user();
    @endphp
    <!-- [ Main Content ] start -->
    @if (\Auth::user()->type == 'super admin')
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-xxl-6">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="welcome-card border bg-light-primary p-3 border-primary rounded text-dark mb-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <img src="{{ !empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . 'avatar.png' }}"
                                                alt="" class="theme-avtar">
                                        </div>
                                        <div>
                                            <h5 class="mb-0 f-w-600 text-primary">
                                                <span class="d-block" id="greetings"></span>
                                                <b class="f-w-700">{{ __(Auth::user()->name) }}</b>
                                            </h5>
                                        </div>
                                    </div>
                                    <p class="mb-0 f-w-500 text-primary"><b
                                            class="f-w-700">{{ __('Have a nice day!') }}</b>
                                    </p>
                                </div>
                            </div>
                            {{-- <hr> --}}
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-primary">
                                            <i class="fas fa-cube"></i>
                                        </div> --}}
                                        <h6 class="mb-2 mt-3 ">{{ __('Users') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_user }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-primary">
                                            <i class="fas fa-cube"></i>
                                        </div> --}}
                                        <h6 class="mb-2 mt-3 ">{{ __('Standards Count') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_user }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-primary">
                                            <i class="fas fa-cube"></i>
                                        </div> --}}
                                        <h6 class="mb-2 mt-3 ">{{ __('Number of Criteria') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_user }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-primary">
                                            <i class="fas fa-cube"></i>
                                        </div> --}}
                                        <h6 class="mb-2 mt-3 ">{{ __('Not Fulfilled') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_user }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-warning">
                                        </div> --}}
                                        <h6 class="mb-2 mt-3">
                                            {{-- <i class="fas fa-cart-plus"></i> --}}
                                            {{ __('Partially Fulfilled') }}
                                        </h6>
                                        <h3 class="mb-0">{{ $user->total_orders }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-warning">
                                            <i class="fas fa-cart-plus"></i>
                                        </div> --}}
                                        <h6 class="mb-2 mt-3">{{ __('Fulfilled') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_orders }}</h3>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-warning">
                                            <i class="fas fa-cart-plus"></i>
                                        </div> --}}
                                        <h6 class="mb-2 mt-3">{{ __('Fulfilled with Precision') }}</h6>
                                        <h3 class="mb-0">{{ $user->total_orders }}</h3>
                                    </div>
                                </div>
                            </div>
                           
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        {{-- <div class="theme-avtar bg-danger">
                                            <i class="fas fa-shopping-bag"></i>
                                        </div> --}}
                                        <h6 class="mb-2 mt-3">{{ __('Fulfilled with Excellence') }}</h6>
                                        <h3 class="mb-0">{{ $user['total_plan'] }}</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="col-xxl-6">
                        <div class="card">
                            <div class="card-header">
                                <h5>{{ __('Recent Order') }}</h5>
                            </div>
                            <div class="card-body">
                                <div id="plan_order" data-color="primary" data-height="230"></div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
      
    @endif
    <!-- [ Main Content ] end -->
@endsection
@push('script-page')
    <script>
        $(document).on('click', '#code-generate', function() {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
    @if (\Auth::user()->type == 'super admin')
        <script>
            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "Order",
                        data: [10,20,30,40,50,60,70,40,20,50,60,20,50,70]
                    }],

                    xaxis: {
                        axisBorder: {
                            show: !1
                        },
                        type: "MMM",
                        categories: 0,
                        title: {
                            text: '{{ __('Days') }}'
                        }
                    },
                    colors: ['#e83e8c'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#plan_order"), options);
                chart.render();
            })();
        </script>
    @else
        <script>
            $(document).ready(function() {
                $('.cp_link').on('click', function() {
                    var value = $(this).attr('data-link');
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(value).select();
                    document.execCommand("copy");
                    $temp.remove();
                    show_toastr('Success', '{{ __('Link copied') }}', 'success')
                });
            });

            (function() {
                var options = {
                    chart: {
                        height: 250,
                        type: 'area',
                        toolbar: {
                            show: false,
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: 2,
                        curve: 'smooth'
                    },


                    series: [{
                        name: "Order",
                        // data: [10,20,30,40,50,60,70,40,20,50,60,20,50,70]
                    }],

                    // xaxis: {
                    //     axisBorder: {
                    //         show: !1
                    //     },
                    //     type: "MMM",
                    //     title: {
                    //         text: '{{ __('Days') }}'
                    //     }
                    // },
                    colors: ['#6fd943'],

                    grid: {
                        strokeDashArray: 4,
                    },
                    legend: {
                        show: false,
                    },
                    // markers: {
                    //     size: 4,
                    //     colors: ['#FFA21D'],
                    //     opacity: 0.9,
                    //     strokeWidth: 2,
                    //     hover: {
                    //         size: 7,
                    //     }
                    // },
                    yaxis: {
                        tickAmount: 3,
                    }
                };
                var chart = new ApexCharts(document.querySelector("#apex-dashborad"), options);
                chart.render();
            })();
            var scrollSpy = new bootstrap.ScrollSpy(document.body, {
                target: '#useradd-sidenav',
                offset: 300
            })
        </script>
        <script>
            $(document).on('click', '#code-generate', function() {
                var length = 10;
                var result = '';
                var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
                var charactersLength = characters.length;
                for (var i = 0; i < length; i++) {
                    result += characters.charAt(Math.floor(Math.random() * charactersLength));
                }
                $('#auto-code').val(result);
            });
        </script>
        <script>
            (function() {
                var options = {
                    // series: [{{ $storage_limit }}],
                    chart: {
                        height: 550,
                        type: 'radialBar',
                        offsetY: -20,
                        sparkline: {
                            enabled: true
                        }
                    },
                    plotOptions: {
                        radialBar: {
                            startAngle: -90,
                            endAngle: 90,
                            track: {
                                background: "#e7e7e7",
                                strokeWidth: '100%',
                                margin: 5, // margin is in pixels
                            },
                            dataLabels: {
                                name: {
                                    show: true
                                },
                                value: {
                                    offsetY: -50,
                                    fontSize: '20px'
                                }
                            }
                        }
                    },
                    grid: {
                        padding: {
                            top: -10
                        }
                    },
                    colors: ["#6FD943"],
                    labels: ['Used'],
                };
                var chart = new ApexCharts(document.querySelector("#device-chart"), options);
                chart.render();
            })();
        </script>

        <script>
            //social sharing
            $(document).ready(function() {
                var customURL = {!! json_encode(url('/store/' . $store_id->slug)) !!};
                $('.Demo1').socialSharingPlugin({
                    url: customURL,
                    title: $('meta[property="og:title"]').attr('content'),
                    description: $('meta[property="og:description"]').attr('content'),
                    img: $('meta[property="og:image"]').attr('content'),
                    enable: ['whatsapp', 'facebook', 'twitter', 'pinterest', 'linkedin']
                });

                $('.socialShareButton').click(function(e) {
                    e.preventDefault();
                    $('.sharingButtonsContainer').toggle();
                });
            });
        </script>
    @endif
@endpush
