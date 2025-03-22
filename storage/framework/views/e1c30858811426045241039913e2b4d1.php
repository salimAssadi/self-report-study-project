<?php
    $currantLang = $users->currentLanguages();
    $profile = \App\Models\Utility::get_file('uploads/profile/');
    if ($currantLang == null) {
        $currantLang = 'en';
    }

    $current_store = \Auth::user()->current_store;
    
    // $setting = App\Models\Utility::settings();
?>
<!-- [ Header ] start -->
<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <header class="dash-header transprent-bg">
    <?php else: ?>
        <header class="dash-header transprent-bg">
<?php endif; ?>
<div class="header-wrapper">
    <div class="me-auto dash-mob-drp">
        <ul class="list-unstyled">
            <li class="dash-h-item mob-hamburger">
                <a href="#!" class="dash-head-link" id="mobile-collapse">
                    <div class="hamburger hamburger--arrowturn">
                        <div class="hamburger-box">
                            <div class="hamburger-inner"></div>
                        </div>
                    </div>
                </a>
            </li>
            <li class="dropdown dash-h-item drp-company">
                <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                    role="button" aria-haspopup="false" aria-expanded="false">
                    <span class="theme-avtar"> <img alt="#" width="35"
                            src="<?php echo e(!empty($users->avatar) ? $profile . '/' . $users->avatar : $profile . '/avatar.png'); ?>"
                            class="img-fluid rounded-circle"></span>
                    <span class="hide-mob ms-2"><?php echo e(__('Hi,')); ?><?php echo e(Auth::user()->name); ?>!</span>
                    <i class="ti ti-chevron-down drp-arrow nocolor hide-mob"></i>
                </a>
                <div class="dropdown-menu dash-h-dropdown">
                    <a href="<?php echo e(route('profile')); ?>" class="dropdown-item">
                        <i class="ti ti-user"></i>
                        <span><?php echo e(__('My Profile')); ?></span>
                    </a>
                    <a href="<?php echo e(route('logout')); ?>" class="dropdown-item"
                        onclick="event.preventDefault();document.getElementById('frm-logout').submit();">
                        <i class="ti ti-power"></i>
                        <span><?php echo e(__('Logout')); ?></span>
                    </a>
                    <form id="frm-logout" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none;">
                        <?php echo csrf_field(); ?></form>
                </div>
            </li>
        </ul>
    </div>

    <div class="ms-auto">
        <ul class="list-unstyled">
            <?php if (is_impersonating($guard = null)) : ?>
                    <li class="dropdown dash-h-item drp-company">
                        <a class="btn btn-danger btn-sm me-3"
                            href="<?php echo e(route('exit.owner')); ?>"><i class="ti ti-ban"></i>
                            <?php echo e(__('Exit Owner Login')); ?>

                        </a>
                    </li>
            <?php endif; ?>
            
           
            <?php if(Auth::user()->type != 'super admin'): ?>
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text"><?php echo e(Str::ucfirst($currantLang->fullname)); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('change.language', $code)); ?>"
                                class="dropdown-item <?php echo e($currantLang->code == $code ? 'text-primary' : ''); ?>">
                                <span><?php echo e(Str::ucfirst($lang)); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </li>
            <?php else: ?>
                <li class="dropdown dash-h-item drp-language">
                    <a class="dash-head-link dropdown-toggle arrow-none me-0" data-bs-toggle="dropdown" href="#"
                        role="button" aria-haspopup="false" aria-expanded="false">
                        <i class="ti ti-world nocolor"></i>
                        <span class="drp-text"><?php echo e(Str::ucfirst($currantLang->fullname)); ?></span>
                        <i class="ti ti-chevron-down drp-arrow nocolor"></i>
                    </a>
                    <div class="dropdown-menu dash-h-dropdown dropdown-menu-end">
                        <?php $__currentLoopData = App\Models\Utility::languages(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $code => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e(route('change.language', $code)); ?>"
                                class="dropdown-item <?php echo e($currantLang->code == $code ? 'text-primary' : ''); ?>">
                                <span><?php echo e(Str::ucfirst($lang)); ?></span>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                     <?php if(Auth::user()->type == 'super admin'): ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Create Language')): ?>
                                <a href="#" data-url="<?php echo e(route('create.language')); ?>" data-size="md"
                                    data-ajax-popup="true" data-title="<?php echo e(__('Create New Language')); ?>"
                                    class="dropdown-item border-top py-1 text-primary"><?php echo e(__('Create Language')); ?></a>
                            <?php endif; ?>
                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Language')): ?>
                                <a href="<?php echo e(route('manage.language', [$currantLang->code])); ?>"
                                    class="dropdown-item border-top py-1 text-primary"><?php echo e(__('Manage Languages')); ?>

                                </a>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</div>
</header>
<!-- [ Header ] end -->
<?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/partials/admin/header.blade.php ENDPATH**/ ?>