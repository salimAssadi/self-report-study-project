 <!-- Criteria Section for Main Standards -->
 @if ($standard->criteria->isNotEmpty())
 <tr class="collapse" id="criteria-{{ $standard->id }}">
     <td colspan="10">
         <h5 class="mb-3">{{ __('Criteria for ') . $standard->name_en }}</h5>
         <table class="table table-bordered">
             <thead>
                 <tr>
                     <th>{{ __('Name (Arabic)') }}</th>
                     <th>{{ __('Name (English)') }}</th>
                     <th>{{ __('Content (Arabic)') }}</th>
                     <th>{{ __('Content (English)') }}</th>
                     <th>{{ __('Is Met?') }}</th>
                     <th>{{ __('Fulfillment Status') }}</th>
                     <th>{{ __('Completion Status') }}</th>
                 </tr>
             </thead>
             <tbody>
                 @foreach ($standard->criteria as $criterion)
                     <tr>
                         <td>{{ $criterion->name_ar }}</td>
                         <td>{{ $criterion->name_en }}</td>
                         <td>{{ $criterion->content_ar }}</td>
                         <td>{{ $criterion->content_en }}</td>
                         <td>
                             @if ($criterion->is_met)
                                 <span class="badge rounded p-2 f-w-600 bg-light-success">{{ __('Yes') }}</span>
                             @else
                                 <span class="badge rounded p-2 f-w-600 bg-light-danger">{{ __('No') }}</span>
                             @endif
                         </td>
                         <td>{{ $criterion->fulfillment_status ?? '-' }}</td>
                         <td>
                             @switch($criterion->completion_status)
                                 @case('incomplete')
                                     <span class="badge rounded p-2 f-w-600 bg-light-danger">{{ __('Incomplete') }}</span>
                                 @break
                                 @case('partially_completed')
                                     <span class="badge rounded p-2 f-w-600 bg-light-warning">{{ __('Partially Complete') }}</span>
                                 @break
                                 @case('completed')
                                     <span class="badge rounded p-2 f-w-600 bg-light-success">{{ __('Complete') }}</span>
                                 @break
                             @endswitch
                         </td>
                     </tr>
                 @endforeach
             </tbody>
         </table>
     </td>
 </tr>
@endif