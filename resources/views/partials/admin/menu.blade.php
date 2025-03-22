@php
    $logo = \App\Models\Utility::get_file('uploads/logo/');
    $company_logo = \App\Models\Utility::GetLogo();
@endphp
@if (isset($setting['cust_theme_bg']) && $setting['cust_theme_bg'] == 'on')
    <nav class="dash-sidebar light-sidebar transprent-bg">
    @else
        <nav class="dash-sidebar light-sidebar transprent-bg">
@endif

<div class="navbar-wrapper">
    <div class="m-header justify-content-center">
        <a href="{{ route('dashboard') }}" class="b-brand">
            @if ($setting['cust_darklayout'] == 'on')
                <img src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-light.png') . '?timestamp=' . time() }}"
                    alt="" width="201px" height="41px" />
            @else
                <img src="{{ $logo . (isset($company_logo) && !empty($company_logo) ? $company_logo : 'logo-dark.png') . '?timestamp=' . time() }}"
                    alt="" width="201px" height="41px" />
            @endif
        </a>
    </div>
    <div class="navbar-content">
        <ul class="dash-navbar">
            @if (Auth::user()->type == 'super admin')
                @can('Manage Dashboard')
                    <li class="dash-item {{ Request::segment(1) == 'dashboard' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('dashboard') }}"
                            class="dash-link {{ request()->is('dashboard') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="dash-mtext">{{ __('Dashboard') }}</span>
                        </a>
                    </li>
                @endcan
                <li
                    class="dash-item dash-hasmenu 
                    {{ Request::segment(1) == 'main-standards' || Request::segment(1) == 'sub-standards' || Request::segment(1) == 'criteria' ? 'active dash-trigger' : 'collapsed' }}">
                    <a href="#!" class="dash-link">
                        <span class="dash-micon">
                            <i class="ti ti-list-check"></i> <!-- Updated icon for standards/criteria -->
                        </span>
                        <span class="dash-mtext">{{ __('Standards and Criteria') }}</span>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul
                        class="dash-submenu  {{ Request::segment(1) == 'main-standards' || Request::segment(1) == 'sub-standards' || Request::segment(1) == 'criteria' ? 'show' : '' }}">


                        <!-- Main Standards Link -->
                        @can('Manage Standard')
                        <li
                            class="dash-item {{ Request::route()->getName() == 'main-standards.index' ? 'active' : '' }}">
                            <a class="dash-link" href="{{ route('main-standards.index') }}">{{ __('Standards') }}</a>
                        </li>
                        @endcan
                      
                        <!-- Criteria Link -->
                        @can('Manage Criteria')
                        <li class="dash-item {{ Request::route()->getName() == 'criteria.index' ? 'active' : '' }}">
                            <a class="dash-link" href="{{ route('criteria.index') }}">{{ __('Criteria') }}</a>
                        </li>
                        @endcan
                    </ul>
                </li>

                <li
                    class="dash-item dash-hasmenu {{ Request::segment(1) == 'users' || Request::segment(1) == 'roles' ? ' active dash-trigger' : 'collapsed' }}">
                    <a href="#!" class="dash-link ">
                        <span class="dash-micon">
                            <i class="ti ti-users"></i>
                        </span>
                        <span class="dash-mtext">{{ __('Users') }}</span>
                        <span class="dash-arrow">
                            <i data-feather="chevron-right"></i>
                        </span>
                    </a>
                    <ul
                        class="dash-submenu {{ Request::segment(1) == 'roles' || Request::segment(1) == 'roles' ? ' show' : '' }}">
                        @can('Manage Role')
                            <li class="dash-item {{ Request::route()->getName() == 'roles' ? ' active' : '' }}">
                                <a class="dash-link" href="{{ route('roles.index') }}">{{ __('Roles') }}</a>
                            </li>
                        @endcan
                        @can('Manage User')
                            <li
                                class="dash-item {{ Request::segment(1) == 'users.index' || Request::route()->getName() == 'users.show' ? ' active dash-trigger' : 'collapsed' }}">
                                <a class="dash-link" href="{{ route('users.index') }}">{{ __('Users') }}</a>
                            </li>
                        @endcan
                    </ul>
                </li>

                {{-- @can('Manage Email Template')
                    <li
                        class="dash-item dash-hasmenu {{ Request::route()->getName() == 'manage.email.language' || Request::route()->getName() == 'manage.email.language' ? ' active dash-trigger' : 'collapsed' }}">
                        <a href="{{ route('manage.email.language', \Auth::user()->lang) }}"
                            class="dash-link {{ request()->is('email_template') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-mail"></i>
                            </span>
                            <span class="dash-mtext">{{ __('Email Templates') }}</span>
                        </a>
                    </li>
                @endcan --}}


                @can('Manage Settings')
                    <li
                        class="dash-item dash-hasmenu {{ Request::segment(1) == 'settings' || Request::route()->getName() == 'store.editproducts' ? ' active dash-trigger' : 'collapsed' }}">
                        <a href="{{ route('settings') }}"
                            class="dash-link {{ request()->is('settings') ? 'active' : '' }}">
                            <span class="dash-micon"> <i data-feather="settings"></i>
                            </span>
                            <span class="dash-mtext">
                                @if (Auth::user()->type == 'super admin')
                                    {{ __('Settings') }}
                                @endif
                            </span>
                        </a>
                    </li>
                @endcan
            @else
                    @can('Manage Dashboard')
                        <li class="dash-item {{ Request::segment(1) == 'dashboard' ? ' active' : 'collapsed' }}">
                            <a href="{{ route('dashboard') }}"
                                class="dash-link {{ request()->is('dashboard') ? 'active' : '' }}">
                                <span class="dash-micon">
                                    <i class="ti ti-home"></i>
                                </span>
                                <span class="dash-mtext">{{ __('Dashboard') }}</span>
                            </a>
                        </li>
                    @endcan
                @can('Manage Criteria')
                    <li class="dash-item {{ Request::segment(1) == 'criteria' ? ' active' : 'collapsed' }}">
                        <a href="{{ route('criteria.index') }}"
                            class="dash-link {{ request()->is('criteria') ? 'active' : '' }}">
                            <span class="dash-micon">
                                <i class="ti ti-list-check"></i>
                            </span>
                            <span class="dash-mtext">{{ __('Criteria') }}</span>
                        </a>
                    </li>
                @endcan
            @endif
        </ul>
        @if ($setting['cust_darklayout'] == 'on')
            <div class="navbar-footer border-top bg-dark">
        @else
            <div class="navbar-footer border-top bg-white">
        @endif


    </div>
</div>
</div>
</nav>
