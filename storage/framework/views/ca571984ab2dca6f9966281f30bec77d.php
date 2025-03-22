<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Dashboard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <?php $settings = Utility::settings(); ?>
    <script>
        var timezone = '<?php echo e(!empty($settings['timezone']) ? $settings['timezone'] : 'Asia/Kolkata'); ?>';

        let today = new Date(new Date().toLocaleString("en-US", {
            timeZone: timezone
        }));
        var curHr = today.getHours()
        var target = document.getElementById("greetings");

        if (curHr < 12) {
            target.innerHTML = "<?php echo e(__('Good Morning,')); ?>";
        } else if (curHr < 17) {
            target.innerHTML = "<?php echo e(__('Good Afternoon,')); ?>";
        } else {
            target.innerHTML = "<?php echo e(__('Good Evening,')); ?>";
        }
       
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <?php
        $logo = \App\Models\Utility::get_file('uploads/logo/');
        $company_logo = \App\Models\Utility::getValByName('company_logo');
        $profile = \App\Models\Utility::get_file('uploads/profile/');
        $logo1 = \App\Models\Utility::get_file('uploads/is_cover_image/');
        $users = Auth::user();
    ?>
    <!-- [ Main Content ] start -->
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <div class="row">
            <!-- [ sample-page ] start -->
            <div class="col-sm-12">
                <div class="row">
                    <div class="">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="welcome-card border bg-light-primary p-3 border-primary rounded text-dark mb-4">
                                    <div class="d-flex align-items-center mb-4">
                                        <div class="me-2">
                                            <img src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . 'avatar.png'); ?>"
                                                alt="" class="theme-avtar">
                                        </div>
                                        <div>
                                            <h5 class="mb-0 f-w-600 text-primary">
                                                <span class="d-block" id="greetings"></span>
                                                <b class="f-w-700"><?php echo e(__(Auth::user()->name)); ?></b>
                                            </h5>
                                        </div>
                                    </div>
                                    <p class="mb-0 f-w-500 text-primary"><b
                                            class="f-w-700"><?php echo e(__('Have a nice day!')); ?></b>
                                    </p>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Users')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($totalUsers); ?></h3>
                                    </div>
                                </div>
                            </div>
                        
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Main Standards Count')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($totalMainStandards); ?></h3>
                                    </div>
                                </div>
                            </div>

                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Sub Standards Count')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($totalSubStandards); ?></h3>
                                    </div>
                                </div>
                            </div>
                        
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Number of Criteria')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($totalCriteria); ?></h3>
                                    </div>
                                </div>
                            </div>
                        
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Not Fulfilled')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($notFulfilled); ?></h3>
                                    </div>
                                </div>
                            </div>
                        
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Partially Fulfilled')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($partiallyFulfilled); ?></h3>
                                    </div>
                                </div>
                            </div>
                        
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Fulfilled')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($fulfilled); ?></h3>
                                    </div>
                                </div>
                            </div>
                        
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Fulfilled with Precision')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($fulfilledWithPrecision); ?></h3>
                                    </div>
                                </div>
                            </div>
                        
                            
                            <div class="col-lg-3 col-6">
                                <div class="card">
                                    <div class="card-body">
                                        <h6 class="mb-2 mt-3"><?php echo e(__('Fulfilled with Excellence')); ?></h6>
                                        <h3 class="mb-0"><?php echo e($fulfilledWithExcellence); ?></h3>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    
                </div>
            </div>
            <!-- [ sample-page ] end -->
        </div>
      
    <?php endif; ?>
    <!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
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
    <?php if(\Auth::user()->type == 'super admin'): ?>
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
                            text: '<?php echo e(__('Days')); ?>'
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
    <?php else: ?>
        <script>
            $(document).ready(function() {
                $('.cp_link').on('click', function() {
                    var value = $(this).attr('data-link');
                    var $temp = $("<input>");
                    $("body").append($temp);
                    $temp.val(value).select();
                    document.execCommand("copy");
                    $temp.remove();
                    show_toastr('Success', '<?php echo e(__('Link copied')); ?>', 'success')
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
                    //         text: '<?php echo e(__('Days')); ?>'
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
       
      
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/home.blade.php ENDPATH**/ ?>