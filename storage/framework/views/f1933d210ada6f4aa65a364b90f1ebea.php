<style>
    .table-bordered {
    border: 1px solid #070707fb ;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}
</style>
<?php
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $logo_img = \App\Models\Utility::getValByName('company_logo');
    $logo_light = \App\Models\Utility::getValByName('company_light_logo');
    $logo_dark = \App\Models\Utility::getValByName('company_dark_logo');
    $invoice_store = \App\Models\Utility::getValByName('invoice_logo');
    $s_logo = \App\Models\Utility::get_file('uploads/store_logo/');
    $lang = \App\Models\Utility::getValByName('default_language');
    if (\Auth::user()->type == 'Super Admin') {
        $company_logo = Utility::get_superadmin_logo();
    } else {
        $company_logo = Utility::get_company_logo();
    }
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $store_logo = \App\Models\Utility::getValByName('logo');
    if (Auth::user()->type != 'super admin') {
        $store_lang = $store_settings->lang;
        $store_id = $store_settings->id;
    }

    $file_type = config('files_types');
    $setting = App\Models\Utility::settings();

    $SITE_RTL = $setting['SITE_RTL'];

    $local_storage_validation = $setting['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);

    $s3_storage_validation = $setting['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);

    $wasabi_storage_validation = $setting['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);

    $pixals_platforms = \App\Models\Utility::pixel_plateforms();
    $flag = !empty($setting['color_flag']) ? $setting['color_flag'] : 'false';
?>
<?php
    $setting = App\Models\Utility::colorset();
    $color = 'theme-3';
    if (!empty($setting['color'])) {
        $color = $setting['color'];
    }
?>

<?php if($color == 'theme-1'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background: #0CAF60 !important;
            border-color: #0CAF60 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background: #0CAF60 !important;
            border-color: #0CAF60 !important;
        }

        .btn.btn-outline-primary {
            color: #0CAF60;
            border-color: #0CAF60 !important;
        }

        #english label {
            direction: ltr !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-2'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff !important;
            background: #584ED2 !important;
            border-color: #584ED2 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background: #584ED2 !important;
            border-color: #584ED2 !important;
        }

        .btn.btn-outline-primary {
            color: #584ED2;
            border-color: #584ED2 !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-3'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #6fd943 !important;
            border-color: #6fd943 !important;
        }

        .btn.btn-outline-primary {
            color: #6fd943;
            border-color: #6fd943 !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-4'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #145388 !important;
            border-color: #145388 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #145388 !important;
            border-color: #145388 !important;
        }

        .btn.btn-outline-primary {
            color: #145388;
            border-color: #145388 !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-5'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #B9406B !important;
            border-color: #B9406B !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #B9406B !important;
            border-color: #B9406B !important;
        }

        .btn.btn-outline-primary {
            color: #B9406B;
            border-color: #B9406B !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-6'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #008ECC !important;
            border-color: #008ECC !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #008ECC !important;
            border-color: #008ECC !important;
        }

        .btn.btn-outline-primary {
            color: #008ECC;
            border-color: #008ECC !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-7'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #922C88 !important;
            border-color: #922C88 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #922C88 !important;
            border-color: #922C88 !important;
        }

        .btn.btn-outline-primary {
            color: #922C88;
            border-color: #922C88 !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-8'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #C0A145 !important;
            border-color: #C0A145 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #C0A145 !important;
            border-color: #C0A145 !important;
        }

        .btn.btn-outline-primary {
            color: #C0A145;
            border-color: #C0A145 !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-9'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #48494B !important;
            border-color: #48494B !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #48494B !important;
            border-color: #48494B !important;
        }

        .btn.btn-outline-primary {
            color: #48494B;
            border-color: #48494B !important;
        }
    </style>
<?php endif; ?>

<?php if($color == 'theme-10'): ?>
    <style>
        .btn-check:checked+.btn-outline-primary,
        .btn-check:active+.btn-outline-primary,
        .btn-outline-primary:active,
        .btn-outline-primary.active,
        .btn-outline-primary.dropdown-toggle.show {
            color: #ffffff;
            background-color: #0C7785 !important;
            border-color: #0C7785 !important;

        }

        .btn-outline-primary:hover {
            color: #ffffff !important;
            background-color: #0C7785 !important;
            border-color: #0C7785 !important;
        }

        .btn.btn-outline-primary {
            color: #0C7785;
            border-color: #0C7785 !important;
        }
    </style>
<?php endif; ?>

<?php $__env->startSection('page-title'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Settings')); ?>

    <?php else: ?>
        <?php echo e(__('Store Settings')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Settings')); ?>

    <?php else: ?>
        <?php echo e(__('Store Settings')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <?php if(Auth::user()->type == 'super admin'): ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Settings')); ?></li>
    <?php else: ?>
        <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
        <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Store Settings')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <ul class="nav nav-pills cust-nav   rounded  mb-3 " id="pills-tab" role="tablist">
        <?php if(Auth::user()->type == 'super admin'): ?>
            <li class="nav-item">
                <a class="nav-link" id="brand_settings-tab" data-bs-toggle="pill" href="#brand_settings" role="tab"
                    aria-controls="brand_settings" aria-selected="false"><?php echo e(__('General Settings')); ?></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="facility_settings-tab" data-bs-toggle="pill" href="#facility_settings"
                    role="tab" aria-controls="facility_settings" aria-selected="false"><?php echo e(__('Facility Info')); ?></a>
            </li>

            

            
        <?php endif; ?>
    </ul>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
    <style>
        hr {
            margin: 8px;
        }
    </style>
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script type="text/javascript">
        $(document).on("click", '.send_email', function(e) {
            e.preventDefault();
            var title = $(this).attr('data-title');
            var size = 'md';
            var url = $(this).attr('data-url');
            console.log($("#mail_host").val());
            if (typeof url != 'undefined') {
                $("#commonModal .modal-title").html(title);
                $("#commonModal .modal-dialog").addClass('modal-' + size);
                $("#commonModal").modal('show');
                $.post(url, {
                    _token: '<?php echo e(csrf_token()); ?>',
                    mail_driver: $("#mail_driver").val(),
                    mail_host: $("#mail_host").val(),
                    mail_port: $("#mail_port").val(),
                    mail_username: $("#mail_username").val(),
                    mail_password: $("#mail_password").val(),
                    mail_encryption: $("#mail_encryption").val(),
                    mail_from_address: $("#mail_from_address").val(),
                    mail_from_name: $("#mail_from_name").val(),

                }, function(data) {
                    $('#commonModal .body').html(data);
                });
            }
        });
        $(document).on('submit', '#test_email', function(e) {
            e.preventDefault();
            $("#email_sending").show();
            var post = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                type: "post",
                url: url,
                data: post,
                cache: false,
                beforeSend: function() {
                    $('#test_email .btn-create').attr('disabled', 'disabled');
                },
                success: function(data) {

                    if (data.is_success) {
                        show_toastr('Success', data.message, 'success');
                    } else {
                        show_toastr('Error', data.message, 'error');
                    }

                    $('#commonModal').modal('hide');

                },
                complete: function() {
                    $('#test_email .btn-create').removeAttr('disabled');
                },
            });
        });
    </script>

    <script type="text/javascript">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('On-Off Email Template')): ?>
            $(document).on("click", ".email-template-checkbox", function() {
                var chbox = $(this);
                $.ajax({
                    url: chbox.attr('data-url'),
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        status: chbox.val()
                    },
                    type: 'PUT',
                    success: function(response) {
                        if (response.is_success) {
                            show_toastr('Success', response.success, 'success');
                            if (chbox.val() == 1) {
                                $('#' + chbox.attr('id')).val(0);
                            } else {
                                $('#' + chbox.attr('id')).val(1);
                            }
                        } else {
                            show_toastr('Error', response.error, 'error');
                        }
                    },
                    error: function(response) {
                        response = response.responseJSON;
                        if (response.is_success) {
                            show_toastr('Error', response.error, 'error');
                        } else {
                            show_toastr('Error', response, 'error');
                        }
                    }
                })
            });
        <?php endif; ?>
    </script>
    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,

        })
        $(".list-group-item").click(function() {
            $('.list-group-item').filter(function() {
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }
    </script>

    <script>
        var scrollSpy = new bootstrap.ScrollSpy(document.body, {
            target: '#useradd-sidenav',
            offset: 300,
        })
        $(".list-group-item").click(function() {
            $('.list-group-item').filter(function() {
                return this.href == id;
            }).parent().removeClass('text-primary');
        });

        function check_theme(color_val) {
            $('#theme_color').prop('checked', false);
            $('input[value="' + color_val + '"]').prop('checked', true);
        }

        $(document).on('change', '[name=storage_setting]', function() {
            console.log($(this).val());
            if ($(this).val() == 's3') {
                $('.s3-setting').removeClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').addClass('d-none');
            } else if ($(this).val() == 'wasabi') {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').removeClass('d-none');
                $('.local-setting').addClass('d-none');
            } else {
                $('.s3-setting').addClass('d-none');
                $('.wasabi-setting').addClass('d-none');
                $('.local-setting').removeClass('d-none');
            }
        });
    </script>
    <script>
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button1', {
                removeItemButton: true,
            }
        );
        var multipleCancelButton = new Choices(
            '#choices-multiple-remove-button2', {
                removeItemButton: true,
            }
        );
    </script>
    <script>
        $('.colorPicker').on('click', function(e) {
            $('body').removeClass('custom-color');
            if (/^theme-\d+$/) {
                $('body').removeClassRegex(/^theme-\d+$/);
            }
            $('body').addClass('custom-color');
            $('.themes-color-change').removeClass('active_color');
            $(this).addClass('active_color');
            const input = document.getElementById("color-picker");
            setColor();
            input.addEventListener("input", setColor);

            function setColor() {
                document.documentElement.style.setProperty('--color-customColor', input.value);
            }
            $(`input[name='color_flag`).val('true');
        });

        $('.themes-color-change').on('click', function() {

            $(`input[name='color_flag`).val('false');

            var color_val = $(this).data('value');
            $('body').removeClass('custom-color');
            if (/^theme-\d+$/) {
                $('body').removeClassRegex(/^theme-\d+$/);
            }
            $('body').addClass(color_val);
            $('.theme-color').prop('checked', false);
            $('.themes-color-change').removeClass('active_color');
            $('.colorPicker').removeClass('active_color');
            $(this).addClass('active_color');
            $(`input[value=${color_val}]`).prop('checked', true);
        });

        $.fn.removeClassRegex = function(regex) {
            return $(this).removeClass(function(index, classes) {
                return classes.split(/\s+/).filter(function(c) {
                    return regex.test(c);
                }).join(' ');
            });
        };
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <!-- [ Main Content ] start -->
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <div class="tab-content" id="pills-tabContent">
                <?php if(Auth::user()->type == 'super admin'): ?>
                    <div class="tab-pane fade active show" id="brand_settings" role="tabpanel"
                        aria-labelledby="brand_settings-tab">
                        <div class="active card" id="brand_settings">
                            <div class="card-header">
                                <h5><?php echo e(__('General Settings')); ?></h5>
                            </div>
                            <?php echo e(Form::model($settings, ['route' => 'business.setting', 'method' => 'POST', 'enctype' => 'multipart/form-data'])); ?>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><?php echo e(__('Logo dark')); ?></h5>
                                            </div>
                                            <div class="card-body mt-3">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">

                                                        <a href="<?php echo e($logo . 'logo-dark.png' . '?timestamp=' . time()); ?>"
                                                            target="_blank">
                                                            <img id="adminlogoDark" alt="your image"
                                                                src="<?php echo e($logo . 'logo-dark.png' . '?timestamp=' . time()); ?>"
                                                                width="150px" class="big-logo">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5 ">
                                                        <label for="dark_logo">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                                            </div>
                                                            <input type="file" class="form-control file" name="dark_logo"
                                                                id="dark_logo" data-filename="darklogo_update"
                                                                onchange="document.getElementById('adminlogoDark').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><?php echo e(__('Logo Light')); ?></h5>
                                            </div>
                                            <div class="card-body mt-3">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">
                                                        <a href="<?php echo e($logo . 'logo-light.png' . '?timestamp=' . time()); ?>"
                                                            target="_blank">
                                                            <img id="adminLogoLight" alt="your image"
                                                                src="<?php echo e($logo . 'logo-light.png' . '?timestamp=' . time()); ?>"
                                                                width="150px" class="big-logo img_setting">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5 ">
                                                        <label for="light_logo">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i><?php echo e(__('Select image')); ?>

                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                name="light_logo" id="light_logo"
                                                                data-filename="light_logo_update"
                                                                onchange="document.getElementById('adminLogoLight').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    <?php $__errorArgs = ['logo_light'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-sm-6 col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5><?php echo e(__('Favicon')); ?></h5>
                                            </div>
                                            <div class="card-body admin_favicon pt-6">
                                                <div class=" setting-card">
                                                    <div class="logo-content mt-4">
                                                        
                                                        <a href="<?php echo e($logo . 'favicon.png' . '?timestamp=' . time()); ?>"
                                                            target="_blank">
                                                            <img id="faviConLoGo" alt="your image"
                                                                src="<?php echo e($logo . 'favicon.png' . '?timestamp=' . time()); ?>"
                                                                width="50px" height="50px" class="img_setting">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <label for="favicon">
                                                            <div class=" bg-primary  m-auto"> <i
                                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                                            </div>
                                                            <input type="file" class="form-control file"
                                                                id="favicon" name="favicon"
                                                                data-filename="favicon_update"
                                                                onchange="document.getElementById('faviConLoGo').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    <?php $__errorArgs = ['favicon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                        <div class="row">
                                                            <span class="invalid-logo" role="alert">
                                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                                            </span>
                                                        </div>
                                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('title_text', __('Title Text'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('title_text', null, ['class' => 'form-control', 'placeholder' => __('Title Text')])); ?>

                                        <?php $__errorArgs = ['title_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-title_text" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('footer_text', __('Footer Text'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('footer_text', null, ['class' => 'form-control', 'placeholder' => __('Footer Text')])); ?>

                                        <?php $__errorArgs = ['footer_text'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-footer_text" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <?php echo e(Form::label('default_language', __('Default Language'), ['class' => 'col-form-label'])); ?>

                                        <div class="changeLanguage">
                                            <select name="default_language" id="default_language"
                                                class="form-control custom-select" data-toggle="select">
                                                <?php $__currentLoopData = \App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $language): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option <?php if($lang == $code): ?> selected <?php endif; ?>
                                                        value="<?php echo e($code); ?>"><?php echo e(Str::ucfirst($language)); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    
                                    <div class="form-group col-md-3 ">
                                        <?php echo e(Form::label('SITE_RTL', __('Enable RTL'), ['class' => 'col-form-label'])); ?>

                                        <div class="col-12 mt-2">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" data-toggle="switchbutton"
                                                    class="custom-control-input" name="SITE_RTL" id="SITE_RTL"
                                                    value="on" <?php echo e($SITE_RTL == 'on' ? 'checked="checked"' : ''); ?>>
                                                <label class="form-check-labe" for="SITE_RTL"></label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>
                                
                                <h4 class="small-title"><?php echo e(__('Theme Customizer')); ?></h4>
                                <div class="setting-card setting-logo-box p-3">
                                    <div class="row">
                                        <div class="col-lg-4 col-xl-8 col-md-4">
                                            <h6 class="mt-2">
                                                <i data-feather="credit-card"
                                                    class="me-2"></i><?php echo e(__('Primary color settings')); ?>

                                            </h6>

                                            <hr class="my-2" />
                                            <div class="color-wrp">
                                                <div class="theme-color themes-color">
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-1' ? 'active_color' : ''); ?>"
                                                        data-value="theme-1"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-1"<?php echo e($color == 'theme-1' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-2' ? 'active_color' : ''); ?>"
                                                        data-value="theme-2"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-2"<?php echo e($color == 'theme-2' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-3' ? 'active_color' : ''); ?>"
                                                        data-value="theme-3"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-3"<?php echo e($color == 'theme-3' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-4' ? 'active_color' : ''); ?>"
                                                        data-value="theme-4"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-4"<?php echo e($color == 'theme-4' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-5' ? 'active_color' : ''); ?>"
                                                        data-value="theme-5"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-5"<?php echo e($color == 'theme-5' ? 'checked' : ''); ?>>
                                                    <br>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-6' ? 'active_color' : ''); ?>"
                                                        data-value="theme-6"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-6"<?php echo e($color == 'theme-6' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-7' ? 'active_color' : ''); ?>"
                                                        data-value="theme-7"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-7"<?php echo e($color == 'theme-7' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-8' ? 'active_color' : ''); ?>"
                                                        data-value="theme-8"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-8"<?php echo e($color == 'theme-8' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-9' ? 'active_color' : ''); ?>"
                                                        data-value="theme-9"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-9"<?php echo e($color == 'theme-9' ? 'checked' : ''); ?>>
                                                    <a href="#!"
                                                        class="themes-color-change <?php echo e($color == 'theme-10' ? 'active_color' : ''); ?>"
                                                        data-value="theme-10"></a>
                                                    <input type="radio" class="theme_color d-none" name="color"
                                                        value="theme-10"<?php echo e($color == 'theme-10' ? 'checked' : ''); ?>>
                                                </div>
                                                <div class="color-picker-wrp ">
                                                    <input type="color" value="<?php echo e($color ? $color : ''); ?>"
                                                        class="colorPicker <?php echo e(isset($flag) && $flag == 'true' ? 'active_color' : ''); ?>"
                                                        name="custom_color" id="color-picker">
                                                    <input type='hidden' name="color_flag"
                                                        value=<?php echo e(isset($flag) && $flag == 'true' ? 'true' : 'false'); ?>>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary m-r-10'])); ?>

                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>

                    <div class="tab-pane fade" id="facility_settings" role="tabpanel"
                        aria-labelledby="facility_settings-tab">
                        <div class="card" id="facility_settings">
                            <form action="<?php echo e(route('Facility.setting')); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                                <div class="card-header">
                                    <h5 class="mb-2"><?php echo e(__('Facility Info')); ?></h5>
                                </div>
                                <div class="card-body">
                                    <!-- Tabs -->
                                    <ul class="nav nav-tabs w-25" id="facilityTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="arabic-tab" data-bs-toggle="tab"
                                                data-bs-target="#arabic" type="button" role="tab"
                                                aria-controls="arabic" aria-selected="true"><?php echo e(__('Arabic')); ?></button>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="english-tab" data-bs-toggle="tab"
                                                data-bs-target="#english" type="button" role="tab"
                                                aria-controls="english"
                                                aria-selected="false"><?php echo e(__('English')); ?></button>
                                        </li>
                                    </ul>

                                    <!-- Tab Content -->
                                    <div class="tab-content mt-3" id="facilityTabsContent">
                                        <!-- Arabic Tab -->
                                        <div class="tab-pane fade show active" id="arabic" role="tabpanel"
                                            aria-labelledby="arabic-tab">
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Facility Name (Arabic)')); ?></label>
                                                <input type="text" name="facility_name_ar" class="form-control"
                                                    value="<?php echo e($settings['facility_name_ar'] ?? ''); ?>"
                                                    placeholder="<?php echo e(__('Enter Facility Name (Arabic)')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Vision (Arabic)')); ?></label>
                                                <textarea name="vision_ar" class="form-control summernote" rows="3" placeholder="<?php echo e(__('Enter Vision (Arabic)')); ?>"><?php echo e($settings['vision_ar'] ?? ''); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Goals (Arabic)')); ?></label>
                                                <textarea name="goals_ar" class="form-control summernote" rows="3" placeholder="<?php echo e(__('Enter Goals (Arabic)')); ?>"><?php echo e($settings['goals_ar'] ?? ''); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Report Guidelines (Arabic)')); ?></label>
                                                <textarea name="report_guidelines_ar" class="form-control summernote" rows="3"
                                                    placeholder="<?php echo e(__('Enter Report Guidelines (Arabic)')); ?>"><?php echo e($settings['report_guidelines_ar'] ?? ''); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Contact Name (Arabic)')); ?></label>
                                                <input type="text" name="contact_name_ar" class="form-control"
                                                    value="<?php echo e($settings['contact_name_ar'] ?? ''); ?>"
                                                    placeholder="<?php echo e(__('Enter Contact Name (Arabic)')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Contact Position (Arabic)')); ?></label>
                                                <input type="text" name="contact_position_ar" class="form-control"
                                                    value="<?php echo e($settings['contact_position_ar'] ?? ''); ?>"
                                                    placeholder="<?php echo e(__('Enter Contact Position (Arabic)')); ?>">
                                            </div>
                                        </div>

                                        <!-- English Tab -->

                                        <div class="tab-pane fade"  id="english" role="tabpanel"
                                            aria-labelledby="english-tab">
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Facility Name (English)')); ?></label>
                                                <input type="text" name="facility_name_en" class="form-control"
                                                    value="<?php echo e($settings['facility_name_en'] ?? ''); ?>"
                                                    placeholder="<?php echo e(__('Enter Facility Name (English)')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Vision (English)')); ?></label>
                                                <textarea name="vision_en" class="form-control summernote" rows="3" placeholder="<?php echo e(__('Enter Vision (English)')); ?>"><?php echo e($settings['vision_en'] ?? ''); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Goals (English)')); ?></label>
                                                <textarea name="goals_en" class="form-control summernote" rows="3" placeholder="<?php echo e(__('Enter Goals (English)')); ?>"><?php echo e($settings['goals_en'] ?? ''); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Report Guidelines (English)')); ?></label>
                                                <textarea name="report_guidelines_en" class="form-control summernote" rows="3"
                                                    placeholder="<?php echo e(__('Enter Report Guidelines (English)')); ?>"><?php echo e($settings['report_guidelines_en'] ?? ''); ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Contact Name (English)')); ?></label>
                                                <input type="text" name="contact_name_en" class="form-control"
                                                    value="<?php echo e($settings['contact_name_en'] ?? ''); ?>"
                                                    placeholder="<?php echo e(__('Enter Contact Name (English)')); ?>">
                                            </div>
                                            <div class="form-group">
                                                <label  class="form-label"><?php echo e(__('Contact Position (English)')); ?></label>
                                                <input type="text" name="contact_position_en" class="form-control"
                                                    value="<?php echo e($settings['contact_position_en'] ?? ''); ?>"
                                                    placeholder="<?php echo e(__('Enter Contact Position (English)')); ?>">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Shared Fields (Common for Both Languages) -->
                                    <div class="row mt-3">

                                        <div class="form-group col-md-4">
                                            <label  class="form-label"><?php echo e(__('Report Date')); ?></label>
                                            <input type="date" name="report_date" class="form-control"
                                                value="<?php echo e($settings['report_date'] ?? ''); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label  class="form-label"><?php echo e(__('Report Preparer Name')); ?></label>
                                            <input type="text" name="report_preparer_name" class="form-control"
                                                value="<?php echo e($settings['report_preparer_name'] ?? ''); ?>"
                                                placeholder="<?php echo e(__('Enter Report Preparer Name')); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label  class="form-label"><?php echo e(__('Contact Email')); ?></label>
                                            <input type="email" name="contact_email" class="form-control"
                                                value="<?php echo e($settings['contact_email'] ?? ''); ?>"
                                                placeholder="<?php echo e(__('Enter Contact Email')); ?>">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label  class="form-label"><?php echo e(__('Contact Phone')); ?></label>
                                            <input type="text" name="contact_phone" class="form-control"
                                                value="<?php echo e($settings['contact_phone'] ?? ''); ?>"
                                                placeholder="<?php echo e(__('Enter Contact Phone')); ?>">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-primary"><?php echo e(__('Save Changes')); ?></button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="tab-pane fade" id="email_settings" role="tabpanel" aria-labelledby="email_settings-tab">
                        <div class="card" id="email_settings">
                            <?php echo e(Form::open(['route' => 'email.setting', 'method' => 'post'])); ?>

                            <div class="card-header">
                                <h5 class="mb-2"><?php echo e(__('Email Settings')); ?></h5>
                                <span
                                    class="text-muted"><?php echo e(__('(This SMTP will be used for system-level email sending. Additionally, if a owner user does not set their SMTP, then this SMTP will be used for sending emails.)')); ?></span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_driver', __('Mail Driver'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_driver', $settings['mail_driver'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Driver')])); ?>

                                        <?php $__errorArgs = ['mail_driver'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_host', __('Mail Host'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_host', $settings['mail_host'], ['class' => 'form-control ', 'placeholder' => __('Enter Mail Host')])); ?>

                                        <?php $__errorArgs = ['mail_host'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_driver" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_port', __('Mail Port'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_port', $settings['mail_port'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Port')])); ?>

                                        <?php $__errorArgs = ['mail_port'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_port" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_username', __('Mail Username'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_username', $settings['mail_username'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Username')])); ?>

                                        <?php $__errorArgs = ['mail_username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_username" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_password', __('Mail Password'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_password', $settings['mail_password'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Password')])); ?>

                                        <?php $__errorArgs = ['mail_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_password" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_encryption', $settings['mail_encryption'], ['class' => 'form-control', 'placeholder' => __('Enter Mail Encryption')])); ?>

                                        <?php $__errorArgs = ['mail_encryption'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_encryption" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_from_address', __('Mail From Address'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_from_address', $settings['mail_from_address'], ['class' => 'form-control', 'placeholder' => __('Enter Mail From Address')])); ?>

                                        <?php $__errorArgs = ['mail_from_address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_address" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <?php echo e(Form::label('mail_from_name', __('Mail From Name'), ['class' => 'col-form-label'])); ?>

                                        <?php echo e(Form::text('mail_from_name', $settings['mail_from_name'], ['class' => 'form-control', 'placeholder' => __('Enter Mail From Name')])); ?>

                                        <?php $__errorArgs = ['mail_from_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                            <span class="invalid-mail_from_name" role="alert">
                                                <strong class="text-danger"><?php echo e($message); ?></strong>
                                            </span>
                                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <a href="#" data-url="<?php echo e(route('test.mail')); ?>" data-ajax-popup="false"
                                            data-title="<?php echo e(__('Send Test Mail')); ?>"
                                            class="send_email btn btn-print-invoice  btn-primary m-r-10">
                                            <?php echo e(__('Send Test Mail')); ?>

                                        </a>
                                    </div>
                                    <div class="form-group col-md-6 d-flex justify-content-end">
                                        <?php echo e(Form::submit(__('Save Changes'), ['class' => 'btn btn-print-invoice  btn-primary m-r-10'])); ?>

                                    </div>
                                </div>
                            </div>
                            <?php echo e(Form::close()); ?>

                        </div>
                    </div>


                    <div class="tab-pane fade" id="clear_cache" role="tabpanel" aria-labelledby="clear_cache-tab">
                        <div class="card" id="clear_cache">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-6">
                                        <h5 class="h6 md-0"><?php echo e(__('Clear Cache')); ?></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <p><?php echo e(__("This is a page meant for more advanced users, simply ignore it if you don't understand what cache is.")); ?>

                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="input-group search-form">
                                        <input type="text" value="<?php echo e(Utility::GetCacheSize()); ?>"
                                            class="form-control">
                                        <span class="input-group-text bg-transparent">MB</span>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer d-flex justify-content-end">
                                <a href="<?php echo e(url('config-cache')); ?>"
                                    class="btn btn-print-invoice  btn-primary m-r-10"><?php echo e(__('Clear Cache')); ?></a>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/jquery-mask-plugin/dist/jquery.mask.min.js')); ?>"></script>
    <script>
        function myFunction() {
            var copyText = document.getElementById("myInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999)
            document.execCommand("copy");
            show_toastr('Success', "<?php echo e(__('Link copied')); ?>", 'success');
        }

        $(document).on('click', 'input[name="theme_color"]', function() {
            var eleParent = $(this).attr('data-theme');
            $('#themefile').val(eleParent);
            var imgpath = $(this).attr('data-imgpath');
            $('.' + eleParent + '_img').attr('src', imgpath);
        });

        $(document).ready(function() {
            setTimeout(function(e) {
                var checked = $("input[type=radio][name='theme_color']:checked");
                $('#themefile').val(checked.attr('data-theme'));
                $('.' + checked.attr('data-theme') + '_img').attr('src', checked.attr('data-imgpath'));
            }, 300);

            // pwa Enable/Disable js

            if ($('.enable_pwa_store').is(':checked')) {

                $('.pwa_is_enable').removeClass('disabledCookie');
            } else {

                $('.pwa_is_enable').addClass('disabledCookie');
            }

            $('#pwa_store').on('change', function() {
                if ($('.enable_pwa_store').is(':checked')) {

                    $('.pwa_is_enable').removeClass('disabledCookie');
                } else {

                    $('.pwa_is_enable').addClass('disabledCookie');
                }
            });

            // Twilio Enable/Disable js

            if ($('.twilio_enabled').is(':checked')) {

                $('.twilio').removeClass('disabledCookie');
            } else {

                $('.twilio').addClass('disabledCookie');
            }

            $('.twilio_enabled').on('change', function() {
                if ($('.twilio_enabled').is(':checked')) {

                    $('.twilio').removeClass('disabledCookie');
                } else {

                    $('.twilio').addClass('disabledCookie');
                }
            });

            // Whatsapp Enable/Disable js

            if ($('.whatsapp_enabled').is(':checked')) {

                $('.whatsapp').removeClass('disabledCookie');
            } else {

                $('.whatsapp').addClass('disabledCookie');
            }

            $('.whatsapp_enabled').on('change', function() {
                if ($('.whatsapp_enabled').is(':checked')) {

                    $('.whatsapp').removeClass('disabledCookie');
                } else {

                    $('.whatsapp').addClass('disabledCookie');
                }
            });

            // Recaptcha Enable/Disable js

            if ($('.recaptcha_module').is(':checked')) {

                $('.recaptcha').removeClass('disabledCookie');
            } else {

                $('.recaptcha').addClass('disabledCookie');
            }

            $('.recaptcha_module').on('change', function() {
                if ($('.recaptcha_module').is(':checked')) {

                    $('.recaptcha').removeClass('disabledCookie');
                } else {

                    $('.recaptcha').addClass('disabledCookie');
                }
            });

        });

        $(".color1").click(function() {
            var dataId = $(this).attr("data-id");
            $('#' + dataId).trigger('click');
            var first_check = $('#' + dataId).find('.color-0').trigger("click");
        });
    </script>

    <script>
        var custdarklayout = document.querySelector("#cust-darklayout");
        custdarklayout.addEventListener("click", function() {
            if (custdarklayout.checked) {
                document.querySelector(".m-header > .b-brand > img").setAttribute("src",
                    "<?php echo e($logo . '/' . $logo_light); ?>");
                document.querySelector("#main-style-link").setAttribute("href",
                    "<?php echo e(asset('assets/css/style-dark.css')); ?>");
                $('.navbar-footer').removeClass("bg-white");
                $('.navbar-footer').addClass("bg-dark");
            } else {
                document.querySelector(".m-header > .b-brand > img").setAttribute("src",
                    "<?php echo e($logo . '/' . $logo_dark); ?>");
                document.querySelector("#main-style-link").setAttribute("href",
                    "<?php echo e(asset('assets/css/style.css')); ?>");
                $('.navbar-footer').removeClass("bg-dark");
                $('.navbar-footer').addClass("bg-white");

            }
        });

        function removeClassByPrefix(node, prefix) {
            for (let i = 0; i < node.classList.length; i++) {
                let value = node.classList[i];
                if (value.startsWith(prefix)) {
                    node.classList.remove(value);
                }
            }
        }
    </script>

    <script>
        $(document).ready(function() {
            var $dragAndDrop = $("body .custom-fields tbody").sortable({
                handle: '.sort-handler'
            });

            var $repeater = $('.custom-fields').repeater({
                initEmpty: true,
                defaultValues: {},
                show: function() {
                    $(this).slideDown();
                    var eleId = $(this).find('input[type=hidden]').val();

                    if (eleId > 6 || eleId == '') {
                        $(this).find(".field_type option[value='file']").remove();
                        $(this).find(".field_type option[value='select']").remove();
                    }
                },
                hide: function(deleteElement) {
                    if (confirm('<?php echo e(__('Are you sure ?')); ?>')) {
                        $(this).slideUp(deleteElement);
                    }
                },
                ready: function(setIndexes) {
                    $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });

            var value = $(".custom-fields").attr('data-value');
            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
            }

            $.each($('[data-repeater-item]'), function(index, val) {
                var elementId = $(this).find('.custom_id').val();
                if (elementId <= 6) {
                    $.each($(this).find('.field_type'), function(index, val) {
                        $(this).prop('disabled', 'disabled');
                    });
                    $(this).find('.delete-icon').remove();
                }
            });
        });
        $(document).ready(function() {
            $('.item :selected').each(function() {
                var id = $(this).val();
                if (id != '') {
                    $(".item option[value=" + id + "]").addClass("d-none");
                }
            });
        });
        $(document).on('click', '[data-repeater-create]', function() {
            $('.item :selected').each(function() {
                var id = $(this).val();
                if (id != '') {
                    $(".item option[value=" + id + "]").addClass("d-none");
                }
            });
        })
    </script>
    <script type="text/javascript">
        function enablecookie() {
            const element = $('#enable_cookie').is(':checked');
            $('.cookieDiv').addClass('disabledCookie');
            if (element == true) {
                $('.cookieDiv').removeClass('disabledCookie');
                $("#cookie_logging").attr('checked', true);
            } else {
                $('.cookieDiv').addClass('disabledCookie');
                $("#cookie_logging").attr('checked', false);
            }
        }
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/settings/index.blade.php ENDPATH**/ ?>