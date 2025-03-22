<?php
    // $profile=asset(Storage::url('uploads/profile/'));
    $profile = \App\Models\Utility::get_file('uploads/profile/');
    $users = \Auth::user();
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Profile')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <div class="d-inline-block">
        <h5 class="h4 d-inline-block text-white font-weight-400 mb-0"> <?php echo e(__('Profile')); ?></h5>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Profile')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
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
<?php $__env->stopPush(); ?>
<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-xl-3">
            <div class="card sticky-top" style="top:30px">
                <div class="list-group list-group-flush" id="useradd-sidenav">
                    <a href="#personal_info" class="list-group-item list-group-item-action"><?php echo e(__('Personal Information')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>

                    <a href="#change_password" class="list-group-item list-group-item-action"><?php echo e(__('Change Password')); ?>

                        <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-9">
            <div id="personal_info" class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Personal information')); ?></h5>
                </div>
                <div class="card-body">
                    <?php echo e(Form::model($userDetail, ['route' => ['update.account'], 'method' => 'put', 'enctype' => 'multipart/form-data'])); ?>

                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-md-6">
                            <div class="card-body pt-0 text-center">
                                <div class=" setting-card">
                                    <h4><?php echo e(__('Profile Picture')); ?></h4>
                                    <div class="logo-content mt-4 d-flex justify-content-center">

                                        <img class="profile_img"
                                            src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>"
                                            id="blah" width="100px" class="rounded-circle-avatar">
                                    </div>
                                    <div class="choose-files mt-4">
                                        <label for="file-1">
                                            <div class=" bg-primary profile_update" style="max-width: 100% !important;"> <i
                                                    class="ti ti-upload px-1"></i><?php echo e(__('Choose file here')); ?>

                                            </div>
                                            <input type="file" class="form-control file" name="profile" id="file-1"
                                                data-filename="profile_update">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6 col-md-6">
                            <div class="card-body pt-0">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group">
                                            <?php echo e(Form::label('name', __('Name'))); ?>

                                            <?php echo e(Form::text('name', null, ['class' => 'form-control font-style'])); ?>

                                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                                <span class="invalid-name" role="alert">
                                                    <strong class="text-danger"><?php echo e($message); ?></strong>
                                                </span>
                                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <?php echo e(Form::label('email', __('Email'))); ?>

                                    <?php echo e(Form::text('email', null, ['class' => 'form-control', 'placeholder' => __('Enter User Email')])); ?>

                                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <span class="invalid-email" role="alert">
                                            <strong class="text-danger"><?php echo e($message); ?></strong>
                                        </span>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="col-lg-12 text-end">
                        <input type="submit" value="<?php echo e(__('Save Changes')); ?>"
                        class="btn btn-print-invoice  btn-primary m-r-10">
                    </div>
                </div>
                <?php echo e(Form::close()); ?>


            </div>
            <div id="change_password" class="card">
                <div class="card-header">
                    <h5><?php echo e(__('Change Password')); ?></h5>
                </div>
                <div class="card-body">
                    <?php echo e(Form::model($userDetail, ['route' => ['update.password', $userDetail->id], 'method' => 'put'])); ?>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('current_password', __('Current Password'))); ?>

                                <?php echo e(Form::password('current_password', ['class' => 'form-control', 'placeholder' => __('Enter Current Password')])); ?>

                                <?php $__errorArgs = ['current_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-current_password" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('new_password', __('New Password'))); ?>

                                <?php echo e(Form::password('new_password', ['class' => 'form-control', 'placeholder' => __('Enter New Password')])); ?>

                                <?php $__errorArgs = ['new_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-new_password" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <?php echo e(Form::label('confirm_password', __('Re-type New Password'))); ?>

                                <?php echo e(Form::password('confirm_password', ['class' => 'form-control', 'placeholder' => __('Enter Re-type New Password')])); ?>

                                <?php $__errorArgs = ['confirm_password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="invalid-confirm_password" role="alert">
                                        <strong class="text-danger"><?php echo e($message); ?></strong>
                                    </span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="col-lg-12 text-end">
                            <input type="submit" value="<?php echo e(__('Change Password')); ?>"
                                class="btn btn-print-invoice  btn-primary m-r-10">
                        </div>
                    </div>
                    <?php echo e(Form::close()); ?>

                </div>

            </div>
        </div>
    <?php $__env->stopSection(); ?>
    <?php $__env->startPush('script-page'); ?>
        <!--     <script !src="">
            $(document).ready(function() {
                $('.custom-list-group-item').on('click', function() {
                    var href = $(this).attr('data-href');
                    if (href == '#personal-info') {
                        $('#personal-info').show();
                        $('#change-password').hide();
                    } else {
                        $('#change-password').show();
                        $('#personal-info').hide();
                    }
                });
            });
        </script> -->
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
        </script>
    <?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/profile.blade.php ENDPATH**/ ?>