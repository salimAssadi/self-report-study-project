<style>
    .standard, .standard * {
        font-size: 12px !important;
    }
    .standard td {
        padding: 5px !important;
    }
    .standard thead td {
        font-weight: bold !important;
        font-size: 12px !important;
    }
</style>
@foreach ($standards as $standard)
    @php
        $totalScore = 0;
        $matchingCriteria = 0;
        $averageScore = 0;
        $totalEvaluation = 0;
    @endphp
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-white d-flex justify-content-between align-items-center">
                    <div>
                        <h5 style="margin-bottom: 0px;">{{ toArabicNumbers($standard->sequence) }} - {{ $standard->name }}</h5>
                        <small class="text-muted">{{ __('Standard Details and Information') }}</small>
                    </div>

                </div>
                <div class="card-body">
                    <div class="row">
                        <table class="table table-bordered text-center table-striped standard"
                            style="border-collapse: collapse !important; border-style: solid 2px black !important;"
                            cellpadding="10">
                            <thead style="background-color: rgb(76, 61, 142) !important; color:white !important;">
                                <tr style="color:white !important; background-color: rgb(76, 61, 142) !important">
                                    <td rowspan="3">{{ __('Sequence') }}</td>
                                    <td style=" width: 600px; text-wrap: wrap"  rowspan="3">
                                        {{ __('Criteria') }}</td>
                                        <td style="width: 15px; " rowspan="3">{{ __('Compliance') }}</td>
                                        <td colspan="2" >{{ __('Not Satisfactory') }}</td>
                                        <td colspan="3" >{{ __('Satisfactory') }}</td>

                                </tr>

                                <tr style="color:white !important; background-color: rgb(76, 61, 142) !important">

                                    <td > {{ __('Not Fulfilled') }} </td>
                                    <td > {{ __('Partially Fulfilled') }} </td>
                                    <td > {{ __('Fulfilled') }} </td>
                                    <td > {{ __('Fulfilled with Excellence') }} </td>
                                    <td > {{ __('Fulfilled with Distinction') }} </td>

                                </tr>
                                <tr style="color:white !important; background-color: rgb(76, 61, 142) !important">

                                    <td colspan="">{{toArabicNumbers(1)}}</td>
                                    <td colspan="">{{toArabicNumbers(2)}}</td>
                                    <td colspan="">{{toArabicNumbers(3)}}</td>
                                    <td colspan="">{{toArabicNumbers(4)}}</td>
                                    <td colspan="">{{toArabicNumbers(5)}}</td>

                                </tr>

                            </thead>
                            <tbody border="1">

                                <tr style="background-color: #52B5C2;">
                                    <td
                                        style="width: 10px;
                                        max-width: 10px;
                                        overflow: hidden;
                                        text-overflow: ellipsis;
                                        white-space: nowrap;
                                        text-align: center;">
                                        {{ toArabicNumbers($standard->sequence)}}</td>
                                    <td style=" text-align: start; text-wrap: wrap" colspan="7">{{ $standard->name }}
                                        {!! $standard->introduction !!} </td>

                                </tr>
                                @foreach ($standard->children as $child)
                                    <tr style="background-color: #52B5C2;">
                                        <td
                                            style="width: 15px;
                                            max-width: 15px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;
                                            text-align: center;
                                            ">
                                            {{ toArabicNumbers($child->sequence) }}</td>
                                        <td style="width: 15px; text-align: start; text-wrap: wrap" colspan="7">
                                            {{ $child->name }} <br>
                                            {!! $child->introduction !!} </td>
                                    </tr>
                                    @foreach ($child->criteria as $criterion)
                                        <tr style="background-color: #c3c5c5; color:black !important;">
                                            <td style="width: 10px; color:black !important;
                                            max-width: 10px;
                                            overflow: hidden;
                                            text-overflow: ellipsis;
                                            white-space: nowrap;
                                            text-align: center;
                                            padding: 0;"
                                                class="sequence">{{ toArabicNumbers($criterion->sequence) }}</td>
                                            <td style="width: 15px; text-align: start; text-wrap: wrap; color:black !important">
                                                {!! $criterion->name !!}</td>
                                            <td style="width: 15px; color:black !important">{{ $criterion->is_met ? __('Yes') : __('No') }}
                                            </td>
                                            @for ($i = 1; $i <= 5; $i++)
                                                <td style="width: 15px; text-align: center; vertical-align: middle; color: #28a745;">
                                                    @if($criterion->fulfillment_status == "$i")
                                                        <span style="font-family: icons; font-size: 15px;">&#xf00c;</span>
                                                    @endif
                                                </td>
                                            @endfor
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
                                    $totalEvaluation = round($totalScore);
                                @endphp
                                <tr style="background-color: #52B5C2; text-align: start">
                                    <td colspan="8">{{ __('Overall Standard Evaluation') }}</td>
                                </tr>
                                <tr  style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: start; text-wrap: wrap" colspan="2">{{ __('Total Score of Criteria') }}</td>
                                    <td style="" colspan="6">{{ toArabicNumbers($totalScore) }}</td>


                                </tr>
                                <tr  style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: start; text-wrap: wrap" colspan="2">{{ __('Number of Matching Criteria') }}</td>
                                    <td  colspan="6">{{ toArabicNumbers($matchingCriteria )}}</td>


                                </tr>
                                <tr  style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: start; text-wrap: wrap" colspan="2">{{ __('Average Standard Evaluation') }}</td>
                                    <td  colspan="6">{{ toArabicNumbers($averageScore) }}</td>


                                </tr>
                                <tr  style="background-color: #3e6ba5;">
                                    <td style="width: 15px; text-align: start; text-wrap: wrap" colspan="2">{{ __('Total Standard Evaluation') }}</td>
                                    <td  colspan="6">{{ toArabicNumbers($totalEvaluation).''}} {{__('Points')}} / {{''.__(getDegree($totalEvaluation))}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('self-report.partials.standard-details', ['standard' => $standard])
    </div>
@endforeach
