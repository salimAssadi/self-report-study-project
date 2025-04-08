@extends('layouts.admin-app')
@php
    $profile = asset(Storage::url('upload/profile/'));
@endphp
@section('page-title')
    {{ __('User') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item" aria-current="page">
        {{ __('Users') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card table-card">
                <div class="card-header">
                    <div class="row align-items-center g-2">
                        <div class="col">
                            <h5>

                                {{ __('Users') }}
                            </h5>
                        </div>
                        @if (Gate::check('Create User'))
                            <div class="col-auto">
                                <a href="{{ route('users.create') }}" class="btn btn-secondary ">
                                    <i class="ti ti-circle-plus align-text-bottom"></i>
                                    {{ __('Add User') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    <div class="dt-responsive table-responsive">
                        <table class="table table-hover advance-datatable">
                            <thead>
                                <tr>
                                    <th>{{ __('Profile') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Role') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th>{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <div class="flex-shrink-0 wid-40">
                                                    <img class="img-radius img-fluid wid-40"
                                                        src="{{ !empty($user->profile) ? asset(Storage::url('upload/profile')) . '/' . $user->profile : asset(Storage::url('upload/profile')) . '/avatar.png' }}"
                                                        alt="User image">
                                                </div>
                                                <div class="flex-grow-1 ms-3">
                                                    <h5 class="mb-1">
                                                        {{ $user->full_name }}

                                                    </h5>
                                                    <p class="text-muted f-12 mb-0">
                                                        {{ !empty($user->phone_number) ? $user->phone_number : '' }} </p>
                                                </div>
                                            </div>

                                        </td>

                                        <td>{{ $user->email }} </td>

                                        <td>{{ ucfirst($user->type) }} </td>
                                        <td>
                                            @switch($user->is_disable)
                                            @case(1)
                                            <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                                {{ __('Disable') }}
                                            </span>
                                            
                                            @break
        
                                            @case(0)
                                            <span class="badge rounded p-2 f-w-600 bg-light-success">
                                                {{ __('Enable') }}
                                            </span>
                                            @break
                                            @endswitch
                                        </td>
                                        <td>
                                            <div class="cart-action">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['users.destroy', $user->id]]) !!}

                                            @can('Show User')
                                                    <a class="avtar avtar-xs btn-link-warning text-warning"
                                                        data-bs-toggle="tooltip" data-bs-original-title="{{ __('Show') }}"
                                                        href="{{ route('users.show', $user->id) }}"
                                                        data-title="{{ __('Edit User') }}"> <i data-feather="eye"></i></a>
                                             @endif
                                            @can('Edit User')
                                                <a class="avtar avtar-xs btn-link-secondary text-secondary " data-bs-toggle="tooltip"
                                                    data-size="lg" data-bs-original-title="{{ __('Edit') }}"
                                                    href="{{ route('users.edit', $user->id) }}" data-title="{{ __('Edit User') }}"> <i
                                                        data-feather="edit"></i></a>
                                            @endif
                                            @can('Delete User')
                                                    <a class="avtar avtar-xs btn-link-danger text-danger confirm_dialog"
                                                        data-bs-toggle="tooltip" data-bs-original-title="{{ __('Detete') }}" href="#">
                                                        <i data-feather="trash-2"></i></a>
                                            @endif
                                            {!! Form::close() !!}
                                </div>

                                </td>
                                </tr>
                                @endforeach
                                </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            @endsection
            @push('script-page')
                {{-- Password  --}}
                <script>
                    $(document).on('change', '#password_switch', function() {
                        if ($(this).is(':checked')) {
                            $('.ps_div').removeClass('d-none');
                            $('#password').attr("required", true);

                        } else {
                            $('.ps_div').addClass('d-none');
                            $('#password').val(null);
                            $('#password').removeAttr("required");
                        }
                    });
                    $(document).on('click', '.login_enable', function() {
                        setTimeout(function() {
                            $('.modal-body').append($('<input>', {
                                type: 'hidden',
                                val: 'true',
                                name: 'login_enable'
                            }));
                        }, 2000);
                    });
                    $(document).on('change', '#standard_switch', function() {
                        if ($(this).is(':checked')) {
                            $('.standardsSection').removeClass('d-none');
                        } else {
                            $('.standardsSection').addClass('d-none');
                            $('#standards-section').find('input[type="checkbox"]').prop('checked', false);
                        }
                    });
                </script>
            @endpush
