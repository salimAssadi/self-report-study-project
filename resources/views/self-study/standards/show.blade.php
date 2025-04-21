@extends('layouts.admin-app')

@section('page-title')
    {{ __('Standard Details') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item">
        <a href="{{ route('home') }}">{{ __('Dashboard') }}</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{ route('standards.index') }}">{{ __('Standards') }}</a>
    </li>
    <li class="breadcrumb-item active">
        {{ __('Standard Details') }}
    </li>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h5 class="mb-0">{{ $standard->name }}</h5>
                        <small class="text-muted">{{ __('Standard Details and Information') }}</small>
                    </div>
                    <div class="d-flex gap-2">
                        @can('Edit Standards')
                            <a href="{{ route('standards.edit', $standard->id) }}" class="btn btn-primary">
                                <i class="ti ti-edit me-1"></i>{{ __('Edit') }}
                            </a>
                        @endcan
                        <a href="{{ route('standards.index') }}" class="btn btn-secondary">
                            <i class="ti ti-arrow-left me-1"></i>{{ __('Back') }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered text-center table-striped" style="border-collapse: separate">
                            <thead style="background-color: #0a178d; color:white !important;">
                                <tr style="color:white !important;">
                                    <td rowspan="3">{{ __('Sequence') }}</td>
                                    <td style="width: 600px; text-wrap: wrap"  rowspan="3">{{ __('Criteria') }}</td>
                                    <td style="width: 15px; " rowspan="3">{{ __('Compliance') }}</td>
                                    <td colspan="2">{{ __('Not Satisfactory') }}</td>
                                    <td colspan="3">{{ __('Satisfactory') }}</td>

                                </tr>

                                <tr style="color:white !important;">
                                    
                                    <td colspan=""> {{ __('Not Fulfilled') }} </td>
                                    <td colspan=""> {{ __('Partially Fulfilled') }} </td>
                                    <td colspan=""> {{ __('Fulfilled') }} </td>
                                    <td colspan=""> {{ __('Fulfilled with Excellence') }} </td>
                                    <td colspan=""> {{ __('Fulfilled with Distinction') }} </td>
                                </tr>
                                <tr style="color:white !important;">
                                    
                                    <td colspan="">1</td>
                                    <td colspan="">2</td>
                                    <td colspan="">3</td>
                                    <td colspan="">4</td>
                                    <td colspan="">5</td>

                                </tr>

                            </thead>
                            <tbody>

                                <tr style="background-color: #52B5C2;">
                                    <td style="width: 10px;" class="sequence">{{ $standard->sequence }}</td>
                                    <td style=" text-align: right; text-wrap: wrap" colspan="7">{{ $standard->name }} <br>
                                        {!! $standard->introduction !!} </td>

                                </tr>
                                @php 
                                $totalScore = 0;
                                $matchingCriteria = 0;
                                $averageScore = 0;
                                $totalEvaluation = 0;
                                @endphp
                                @foreach ($standard->children as $child)
                                    <tr style="background-color: #52B5C2;">
                                        <td style="width: 10px;" class="sequence">{{ $child->sequence }}</td>
                                        <td style="width: 15px; text-align: right; text-wrap: wrap" colspan="7">{{ $child->name }} <br>
                                            {!! $child->introduction !!} </td>
                                    </tr>
                                    @foreach ($child->criteria as $criterion)
                                        <tr style="background-color: #c3c5c5;">
                                            <td style="width: 10px; " class="sequence">{{ $criterion->sequence }}</td>
                                            <td style="width: 15px; text-align: right; text-wrap: wrap">{!! $criterion->content !!}</td>
                                            <td style="width: 15px;">{{ $criterion->is_met  ? __('Yes') : __('No') }}</td>
                                            <td style="width: 15px;">{{ $criterion->fulfillment_status =='1' ? '1' : '' }}</td>
                                            <td style="width: 15px;">{{ $criterion->fulfillment_status =='2' ? '2' : '' }}</td>
                                            <td style="width: 15px;">{{ $criterion->fulfillment_status =='3' ? '3' : '' }}</td>
                                            <td style="width: 15px;">{{ $criterion->fulfillment_status =='4' ? '4' : '' }}</td>
                                            <td style="width: 15px;">{{ $criterion->fulfillment_status =='5' ? '5' : '' }}</td>
                                          
                                        </tr>
                                        @php 
                                        if($criterion->is_met){
                                            $totalScore += $criterion->fulfillment_status;
                                            $matchingCriteria++;
                                        }
                                        @endphp
                                    @endforeach

                                @endforeach
                                @php
                                    $averageScore = $matchingCriteria > 0 ? $totalScore / $matchingCriteria : 0;
                                @endphp

                                <tr style="background-color: #52B5C2; text-align: start">
                                    <td colspan="8">{{ __('Overall Standard Evaluation') }}</td>
                                </tr>
                                <tr style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: right; text-wrap: wrap" colspan="2">{{ __('Total Score of Criteria') }}</td>
                                    <td style="width: 15px;">{{ $totalScore }}</td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                  
                                </tr>
                                <tr style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: right; text-wrap: wrap" colspan="2">{{ __('Number of Matching Criteria') }}</td>
                                    <td style="width: 15px;">{{ $matchingCriteria }}</td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                  
                                </tr>
                                <tr style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: right; text-wrap: wrap" colspan="2">{{ __('Average Standard Evaluation') }}</td>
                                    <td style="width: 15px;">{{ $averageScore }}</td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                  
                                </tr>
                                <tr style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: right; text-wrap: wrap" colspan="2">{{ __('Total Standard Evaluation') }}</td>
                                    <td style="width: 15px;">{{ round($totalScore) }}</td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                    <td style="width: 15px;"></td>
                                  
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('css-page')
    <style>
        .avatar-text {
            width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 16px;
            color: #fff;
        }

        .list-group-item {
            border-left: 0;
            border-right: 0;
        }

        .list-group-item:first-child {
            border-top: 0;
        }

        .list-group-item:last-child {
            border-bottom: 0;
        }
        .sequence{
            width: 10px;
            max-width: 10px;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0;
        }
        thead td {
            color: #ffffff !important;
        }
    </style>
@endpush
