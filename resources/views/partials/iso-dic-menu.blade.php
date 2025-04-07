@php
    $admin_logo = getSettingsValByName('company_logo');
    $ids = parentId();
    $authUser = \App\Models\User::find($ids);
    $routeName = \Request::route()->getName();
@endphp
<nav class="pc-sidebar">
    <div class="navbar-wrapper">
        <div class="m-header">
            <a href="#" class="b-brand text-primary m-auto">
                <img src="{{ asset(Storage::url('upload/logo')) . '/' . (isset($admin_logo) && !empty($admin_logo) ? $admin_logo : '') }}"
                    alt="" class="logo logo-lg" />
            </a>
        </div>
        <div class="navbar-content mt-2">

            <ul class="pc-navbar">
                <li class="pc-item {{ in_array($routeName, ['dashboard', 'home', '']) ? 'active' : '' }}">
                    <a href="{{ route('admin.home') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-dashboard"></i></span>
                        <span class="pc-mtext">{{ __('Dashboard') }}</span>
                    </a>
                </li>
                @if (Gate::check('Manage Standard'))
                    <li
                        class="pc-item pc-hasmenu {{ in_array($routeName, ['admin.standards', 'admin.standards.index', 'admin.standards.create', 'admin.standards.edit']) ? 'pc-trigger active' : '' }}">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="pc-mtext">{{ __('Standards') }}</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu"
                            style="display: {{ in_array($routeName, ['admin.standards', 'admin.standards.index', 'admin.standards.create', 'admin.standards.edit']) ? 'block' : 'none' }}">
                            <!-- All Standards -->
                            <li
                                class="pc-item {{ request()->query('filter') === null || request()->query('filter') === 'all' ? 'active' : '' }}">
                                <a class="pc-link" href="{{ route('admin.standards.index', ['filter' => 'all']) }}">
                                    {{ __('All') }}
                                    <span class="badge bg-light-primary ms-2">{{ $counts['all'] ?? 0 }}</span>
                                </a>
                            </li>

                            <!-- Completed Standards -->
                            <li class="pc-item {{ request()->query('filter') === 'completed' ? 'active' : '' }}">
                                <a class="pc-link"
                                    href="{{ route('admin.standards.index', ['filter' => 'completed']) }}">
                                    {{ __('Completed') }}
                                    <span class="badge bg-light-success ms-2">{{ $counts['completed'] ?? 0 }}</span>
                                </a>
                            </li>

                            <!-- Partially Completed Standards -->
                            <li
                                class="pc-item {{ request()->query('filter') === 'partially_completed' ? 'active' : '' }}">
                                <a class="pc-link"
                                    href="{{ route('admin.standards.index', ['filter' => 'partially_completed']) }}">
                                    {{ __('Partially Completed') }}
                                    <span
                                        class="badge bg-light-warning ms-2">{{ $counts['partially_completed'] ?? 0 }}</span>
                                </a>
                            </li>

                            <!-- Incomplete Standards -->
                            <li class="pc-item {{ request()->query('filter') === 'incomplete' ? 'active' : '' }}">
                                <a class="pc-link"
                                    href="{{ route('admin.standards.index', ['filter' => 'incomplete']) }}">
                                    {{ __('Incomplete') }}
                                    <span class="badge bg-light-danger ms-2">{{ $counts['incomplete'] ?? 0 }}</span>
                                </a>
                            </li>



                        </ul>
                    </li>
                @endif

                @if (Gate::check('Manage Criteria'))
                    <li
                        class="pc-item pc-hasmenu {{ in_array($routeName, ['admin.criteria', 'admin.criteria.index', 'admin.criteria.create', 'admin.criteria.edit']) ? 'pc-trigger active' : '' }}">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-list-check"></i>
                            </span>
                            <span class="pc-mtext">{{ __('Criteria') }}</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu"
                            style="display: {{ in_array($routeName, ['admin.criteria', 'admin.criteria.index', 'admin.criteria.create', 'admin.criteria.edit']) ? 'block' : 'none' }}">
                            <!-- All Criteria -->
                            <li
                                class="pc-item {{ request()->query('filter') === null || request()->query('filter') === 'all' ? 'active' : '' }}">
                                <a class="pc-link" href="{{ route('admin.criteria.index', ['filter' => 'all']) }}">
                                    {{ __('All') }}
                                    <span class="badge bg-light-primary ms-2">{{ $counts['criteria_all'] ?? 0 }}</span>
                                </a>
                            </li>

                            <!-- Matching Criteria -->
                            <li class="pc-item {{ request()->query('filter') === 'matching' ? 'active' : '' }}">
                                <a class="pc-link"
                                    href="{{ route('admin.criteria.index', ['filter' => 'matching']) }}">
                                    {{ __('Matching') }}
                                    <span
                                        class="badge bg-light-success ms-2">{{ $counts['criteria_matching'] ?? 0 }}</span>
                                </a>
                            </li>

                            <!-- Non-Matching Criteria -->
                            <li class="pc-item {{ request()->query('filter') === 'non_matching' ? 'active' : '' }}">
                                <a class="pc-link"
                                    href="{{ route('admin.criteria.index', ['filter' => 'non_matching']) }}">
                                    {{ __('Not Matching') }}
                                    <span
                                        class="badge bg-light-danger ms-2">{{ $counts['criteria_non_matching'] ?? 0 }}</span>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif


                {{-- @if (Gate::check('Manage Criteria'))
                    <li
                        class="pc-item pc-hasmenu {{ in_array($routeName, ['admin.criteria', 'admin.criteria.index', 'admin.criteria.create', 'admin.criteria.edit']) ? 'pc-trigger active' : '' }}">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="pc-mtext">{{ __('Criteria') }}</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu"
                            style="display: {{ in_array($routeName, ['admin.standards', 'admin.standards.index', 'admin.standards.create', 'admin.standards.edit']) ? 'block' : 'none' }}">
                            @if (Gate::check('Manage Standard'))
                                <li
                                    class="pc-item {{ in_array($routeName, ['admin.standards.index']) ? 'active' : '' }}">
                                    <a class="pc-link"
                                        href="{{ route('admin.standards.index') }}">{{ __('Standards') }}</a>
                                </li>
                            @endif
                            @if (Gate::check('Manage Criteria'))
                                <li
                                    class="pc-item  {{ in_array($routeName, ['admin.criteria', 'admin.criteria.index', 'admin.criteria.create', 'admin.criteria.edit']) ? 'active' : '' }}">
                                    <a class="pc-link" href="{{ route('admin.criteria.index') }}">{{ __('Criteria') }}
                                    </a>
                                </li>
                            @endif

                        </ul>
                    </li>
                @endif --}}

                @if (Gate::check('Manage User'))
                    <li
                        class="pc-item pc-hasmenu {{ in_array($routeName, ['users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'pc-trigger active' : '' }}">
                        <a href="#!" class="pc-link">
                            <span class="pc-micon">
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="pc-mtext">{{ __('Users') }}</span>
                            <span class="pc-arrow"><i data-feather="chevron-right"></i></span>
                        </a>
                        <ul class="pc-submenu"
                            style="display: {{ in_array($routeName, ['admin.users.index', 'logged.history', 'role.index', 'role.create', 'role.edit']) ? 'block' : 'none' }}">
                            @if (Gate::check('Manage User'))
                                <li class="pc-item {{ in_array($routeName, ['admin.users.index']) ? 'active' : '' }}">
                                    <a class="pc-link" href="{{ route('admin.users.index') }}">{{ __('Users') }}</a>
                                </li>
                            @endif
                            @if (Gate::check('Manage Role'))
                                <li
                                    class="pc-item  {{ in_array($routeName, ['role.index', 'role.create', 'role.edit']) ? 'active' : '' }}">
                                    <a class="pc-link" href="{{ route('admin.role.index') }}">{{ __('Roles') }} </a>
                                </li>
                            @endif
                            @if (Gate::check('manage logged history'))
                                <li class="pc-item  {{ in_array($routeName, ['logged.history']) ? 'active' : '' }}">
                                    <a class="pc-link"
                                        href="{{ route('admin.logged.history') }}">{{ __('Logged History') }}</a>
                                </li>
                            @endif
                        </ul>
                    </li>
                @endif
                
                {{-- @if (Gate::check('Manage Comments'))
                    <li class="pc-item {{ in_array($routeName, ['comments']) ? 'active' : '' }} ">
                        <a href="{{ route('admin.comments.all') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-messages"></i></span>
                            <span class="pc-mtext">{{ __('Manage Comments') }}</span>
                        </a>
                    </li>
                @endif --}}

                @if (Gate::check('Manage Settings'))
                    <li class="pc-item {{ in_array($routeName, ['facilityInfo']) ? 'active' : '' }} ">
                        <a href="{{ route('admin.setting.facilityInfo') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">{{ __('Facility Info') }}</span>
                        </a>
                    </li>
                @endif


                @if (Gate::check('Manage Settings'))
                    <li class="pc-item {{ in_array($routeName, ['setting.index']) ? 'active' : '' }} ">
                        <a href="{{ route('admin.setting.index') }}" class="pc-link">
                            <span class="pc-micon"><i class="ti ti-settings"></i></span>
                            <span class="pc-mtext">{{ __('Settings') }}</span>
                        </a>
                    </li>
                @endif

                {{-- <li
                    class="pc-item {{ in_array($routeName, ['iso_systems.index', 'iso_systems.show']) ? 'active' : '' }}">
                    <a href="{{ route('admin.iso_systems.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-apps"></i></span>
                        <span class="pc-mtext">{{ __('ISO Systems') }}</span>
                    </a>
                </li>

                <li
                    class="pc-item {{ in_array($routeName, ['specification_items.index', 'specification_items.show']) ? 'active' : '' }}">
                    <a href="{{ route('admin.specification_items.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-apps"></i></span>
                        <span class="pc-mtext">{{ __('ISO specification items') }}</span>
                    </a>
                </li>

                <li
                    class="pc-item {{ in_array($routeName, ['admin.filemanager']) ? 'active' : '' }}">
                    <a href="{{ route('admin.filemanager') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-folder"></i></span>
                        <span class="pc-mtext">{{ __('File Manager') }}</span>
                    </a>
                </li>

                <li
                    class="pc-item {{ in_array($routeName, ['procedures.index']) ? 'active' : '' }}">
                    <a href="{{ route('admin.procedures.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-propeller"></i></span>
                        <span class="pc-mtext">{{ __('Procedures') }}</span>
                    </a>
                </li>

                <li
                    class="pc-item {{ in_array($routeName, ['samples.index']) ? 'active' : '' }}">
                    <a href="{{ route('admin.samples.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-squares-filled"></i></span>
                        <span class="pc-mtext">{{ __('Samples') }}</span>
                    </a>
                </li> --}}



                {{-- <li class="pc-item pc-caption">
                    <label>{{ __('Business Management') }}</label>
                    <i class="ti ti-chart-arcs"></i>
                </li>

                <li
                    class="pc-item {{ Request::route()->getName() == 'admin.document.index' || Request::route()->getName() == 'admin.document.show' || Request::route()->getName() == 'admin.document.comment' || Request::route()->getName() == 'admin.document.reminder' || Request::route()->getName() == 'admin.document.version.history' || Request::route()->getName() == 'admin.document.share' || Request::route()->getName() == 'admin.document.send.email' ? 'active' : '' }}">
                    <a href="{{ route('admin.document.index') }}" class="pc-link">
                        <span class="pc-micon"><i data-feather="file-text"></i></span>
                        <span class="pc-mtext">{{ __('All Documents') }}</span>
                    </a>
                </li> --}}


                {{-- <li class="pc-item {{ Request::route()->getName() == 'my-reminder' ? 'active' : '' }}">
                    <a href="{{ route('my-reminder') }}" class="pc-link">
                        <span class="pc-micon"><i data-feather="aperture"></i></span>
                        <span class="pc-mtext">{{ __('My Reminders') }}</span>
                    </a>
                </li> --}}


                {{-- <li class="pc-item {{ Request::route()->getName() == 'document.history' ? 'active' : '' }}">
                    <a href="{{ route('document.history') }}" class="pc-link">
                        <span class="pc-micon"><i data-feather="wind"></i></span>
                        <span class="pc-mtext">{{ __('Document History') }}</span>
                    </a>
                </li>

                
                <li class="pc-item {{ Request::route()->getName() == 'category.index' ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}" class="pc-link">
                        <span class="pc-micon"><i data-feather="list"></i></span>
                        <span class="pc-mtext">{{ __('Category') }}</span>
                    </a>
                </li>
                <li class="pc-item {{ Request::route()->getName() == 'sub-category.index' ? 'active' : '' }}">
                    <a href="{{ route('sub-category.index') }}" class="pc-link">
                        <span class="pc-micon"><i data-feather="sliders"></i></span>
                        <span class="pc-mtext">{{ __('Sub Category') }}</span>
                    </a>
                </li>

                <li class="pc-item {{ Request::route()->getName() == 'tag.index' ? 'active' : '' }}">
                    <a href="{{ route('tag.index') }}" class="pc-link">
                        <span class="pc-micon"><i data-feather="layers"></i></span>
                        <span class="pc-mtext">{{ __('Tags') }}</span>
                    </a>
                </li>

                <li class="pc-item pc-caption">
                    <label>{{ __('System Settings') }}</label>
                    <i class="ti ti-chart-arcs"></i>
                </li>

                <li class="pc-item {{ in_array($routeName, ['setting.index']) ? 'active' : '' }} ">
                    <a href="{{ route('setting.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-settings"></i></span>
                        <span class="pc-mtext">{{ __('Settings') }}</span>
                    </a>
                </li>
                <li class="pc-item {{ in_array($routeName, ['users.index', 'users.show']) ? 'active' : '' }}">
                    <a href="{{ route('users.index') }}" class="pc-link">
                        <span class="pc-micon"><i class="ti ti-user-plus"></i></span>
                        <span class="pc-mtext">{{ __('Users') }}</span>
                    </a>
                </li>

                <li class="pc-item  {{ in_array($routeName, ['logged.history']) ? 'active' : '' }}">
                    <a class="pc-link" href="{{ route('logged.history') }}">
                        <span class="pc-micon"><i class="ti ti-report"></i></span>
                        <span class="pc-mtext">{{ __('Logged History') }}</span>

                    </a>
                </li> --}}

            </ul>
            <div class="w-100 text-center">
                <div class="badge theme-version badge rounded-pill bg-light text-dark f-12"></div>
            </div>
        </div>
    </div>
</nav>
