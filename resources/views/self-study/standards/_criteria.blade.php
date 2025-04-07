@if ($criteria->isNotEmpty())
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>{{ __('Sequence') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Standard') }}</th>
                <th>{{ __('Compliance') }}</th>
                <th>{{ __('Fulfillment Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($criteria as $criterion)
                <tr>
                    <td>{{ $criterion->sequence }}</td>
                    <td>{{ $criterion->name }}</td>
                    <td>
                        {{ $criterion->standard?->name ?? '-' }}
                    </td>
                    <td>
                        @switch($criterion->is_met)
                            @case(1)
                                <span class="badge rounded p-2 f-w-600 bg-light-success">
                                    {{ __('Matching') }}
                                </span>
                            @break

                            @case(0)
                                <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                    {{ __('Not Matching') }}
                                </span>
                            @break
                        @endswitch
                    </td>

                    <td>
                        @switch($criterion->fulfillment_status)
                            @case('1')
                                <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                    {{ __('Not Fulfilled') }}
                                </span>
                            @break

                            @case('2')
                                <span class="badge rounded p-2 f-w-600 bg-light-warning">
                                    {{ __('Partially Fulfilled') }}
                                </span>
                            @break

                            @case('3')
                                <span class="badge rounded p-2 f-w-600 bg-light-info">
                                    {{ __('Fulfilled') }}
                                </span>
                            @break

                            @case('4')
                                <span class="badge rounded p-2 f-w-600 bg-light-primary">
                                    {{ __('Fulfilled with Excellence') }}
                                </span>
                            @break

                            @case('5')
                                <span class="badge rounded p-2 f-w-600 bg-light-success">
                                    {{ __('Fulfilled with Distinction') }}
                                </span>
                            @break
                        @endswitch
                    </td>




                    <td>
                        <div class="d-flex">
                            <!-- View Button -->
                            @if (Gate::check('Show Criteria'))
                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                    href="{{ route('admin.criteria.show', $criterion->id) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ __('View') }}">
                                    <i class="ti ti-eye f-20"></i>
                                </a>
                            @endif
                            <!-- Edit Button -->
                            @if (Gate::check('Edit Criteria'))
                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                    href="{{ route('admin.criteria.edit', $criterion->id) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ __('Edit') }}">
                                    <i class="ti ti-edit f-20"></i>
                                </a>
                            @endif

                            <!-- Delete Button -->
                            @if (Gate::check('Delete Criteria'))
                                {!! Form::open([
                                    'method' => 'DELETE',
                                    'route' => ['admin.criteria.destroy', $criterion->id],
                                    'id' => 'delete-form-' . $criterion->id,
                                ]) !!}
                                <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2" href="#"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="{{ __('Delete') }}">
                                    <i class="ti ti-trash f-20"></i>
                                </a>
                                {!! Form::close() !!}
                            @endif

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p class="text-muted">{{ __('No criteria available.') }}</p>
@endif
