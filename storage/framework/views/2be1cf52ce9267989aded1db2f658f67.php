<?php
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::GetLogo();
?>
<?php if(isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on'): ?>
    <nav class="dash-sidebar light-sidebar transprent-bg">
    <?php else: ?>
        <nav class="dash-sidebar light-sidebar transprent-bg">
<?php endif; ?>

<div class="navbar-wrapper">
    <div class="m-header justify-content-center">
        <a href="<?php echo e(route('dashboard')); ?>" class="b-brand">
            <?php if($setting['cust_darklayout'] == 'on'): ?>
                <img src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-light.png') . '?timestamp=' . time()); ?>"
                    alt="" width="201px" height="41px" />
            <?php else: ?>
                <img src="<?php echo e($logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') . '?timestamp=' . time()); ?>"
                    alt="" width="201px" height="41px" />
            <?php endif; ?>
        </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">
            <?php if(Auth::user()->type == 'super admin'): ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Dashboard')): ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('dashboard')); ?>"
                            class="dash-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
                            <span class="dash-micon">
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
                <li
                    class="dash-item dash-hasmenu 
                    <?php echo e(Request::segment(1) == 'main-standards' || Request::segment(1) == 'sub-standards' || Request::segment(1) == 'criteria' ? 'active dash-trigger' : 'collapsed'); ?>">
                    <a href="#!" class="dash-link">
                        <span class="dash-micon">
                            <i class="ti ti-list-check"></i> <!-- Updated icon for standards/criteria -->
                        </span>
                        <span class="dash-mtext"><?php echo e(__('Standards and Criteria')); ?></span>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul
                        class="dash-submenu  <?php echo e(Request::segment(1) == 'main-standards' || Request::segment(1) == 'sub-standards' || Request::segment(1) == 'criteria' ? 'show' : ''); ?>">


                        <!-- Main Standards Link -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Standard')): ?>
                        <li
                            class="dash-item <?php echo e(Request::route()->getName() == 'main-standards.index' ? 'active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('main-standards.index')); ?>"><?php echo e(__('Standards')); ?></a>
                        </li>
                        <?php endif; ?>
                      
                        <!-- Criteria Link -->
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Criteria')): ?>
                        <li class="dash-item <?php echo e(Request::route()->getName() == 'criteria.index' ? 'active' : ''); ?>">
                            <a class="dash-link" href="<?php echo e(route('criteria.index')); ?>"><?php echo e(__('Criteria')); ?></a>
                        </li>
                        <?php endif; ?>
                    </ul>
                </li>

                <li
                    class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'users' || Request::segment(1) == 'roles' ? ' active dash-trigger' : 'collapsed'); ?>">
                    <a href="#!" class="dash-link ">
                        <span class="dash-micon">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="dash-mtext"><?php echo e(__('Users')); ?></span>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul
                        class="dash-submenu <?php echo e(Request::segment(1) == 'roles' || Request::segment(1) == 'roles' ? ' show' : ''); ?>">
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Role')): ?>
                            <li class="dash-item <?php echo e(Request::route()->getName() == 'roles' ? ' active' : ''); ?>">
                                <a class="dash-link" href="<?php echo e(route('roles.index')); ?>"><?php echo e(__('Roles')); ?></a>
                            </li>
                        <?php endif; ?>
                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage User')): ?>
                            <li
                                class="dash-item <?php echo e(Request::segment(1) == 'users.index' || Request::route()->getName() == 'users.show' ? ' active dash-trigger' : 'collapsed'); ?>">
                                <a class="dash-link" href="<?php echo e(route('users.index')); ?>"><?php echo e(__('Users')); ?></a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </li>

                


                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Settings')): ?>
                    <li
                        class="dash-item dash-hasmenu <?php echo e(Request::segment(1) == 'settings' || Request::route()->getName() == 'store.editproducts' ? ' active dash-trigger' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('settings')); ?>"
                            class="dash-link <?php echo e(request()->is('settings') ? 'active' : ''); ?>">
                            <span class="dash-micon"> <i data-feather="settings"></i>
                            </span>
                            <span class="dash-mtext">
                                <?php if(Auth::user()->type == 'super admin'): ?>
                                    <?php echo e(__('Settings')); ?>

                                <?php endif; ?>
                            </span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php else: ?>
                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Dashboard')): ?>
                        <li class="dash-item <?php echo e(Request::segment(1) == 'dashboard' ? ' active' : 'collapsed'); ?>">
                            <a href="<?php echo e(route('dashboard')); ?>"
                                class="dash-link <?php echo e(request()->is('dashboard') ? 'active' : ''); ?>">
                                <span class="dash-micon">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="dash-mtext"><?php echo e(__('Dashboard')); ?></span>
                            </a>
                        </li>
                    <?php endif; ?>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Manage Criteria')): ?>
                    <li class="dash-item <?php echo e(Request::segment(1) == 'criteria' ? ' active' : 'collapsed'); ?>">
                        <a href="<?php echo e(route('criteria.index')); ?>"
                            class="dash-link <?php echo e(request()->is('criteria') ? 'active' : ''); ?>">
                            <span class="dash-micon">
                                <i class="ti ti-list-check"></i>
                            </span>
                            <span class="dash-mtext"><?php echo e(__('Criteria')); ?></span>
                        </a>
                    </li>
                <?php endif; ?>
            <?php endif; ?>
        </ul>
        <?php if($setting['cust_darklayout'] == 'on'): ?>
            <div class="navbar-footer border-top bg-dark">
        <?php else: ?>
            <div class="navbar-footer border-top bg-white">
        <?php endif; ?>


    </div>
</div>
</div>
</nav>
<?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/partials/admin/menu.blade.php ENDPATH**/ ?>