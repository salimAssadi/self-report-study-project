<!-- Children Section -->
@if ($standard->children->isNotEmpty())
    <tr class="collapse" id="children-{{ $standard->id }}">
        <td colspan="10">
            <li><strong class="mb-4">{{ __('Sub-Standards for') }} <span class="text-danger"> {{ $standard->name }}
                    </span></strong></li>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>{{ __('Sequence') }}</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('Number of Criteria') }}</th>
                        <th>{{ __('Completion Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standard->children as $child)
                        <tr>
                            <td>{{ toArabicNumbers($child->sequence) }}</td>
                            <td>{{ $child->name }}</td>
                            <td>{{ toArabicNumbers($child->criteria->count()) }}</td>
                            <td>
                                @switch($child->completion_status)
                                    @case('incomplete')
                                        <span class="badge rounded p-2 f-w-600 bg-light-danger">{{ __('Incomplete') }}</span>
                                    @break

                                    @case('partially_completed')
                                        <span
                                            class="badge rounded p-2 f-w-600 bg-light-warning">{{ __('Partially Complete') }}</span>
                                    @break

                                    @case('completed')
                                        <span class="badge rounded p-2 f-w-600 bg-light-success">{{ __('Complete') }}</span>
                                    @break
                                @endswitch
                            </td>
                            <td>
                                <div class="d-flex">
                                    <!-- View Button -->
                                    @if (Gate::check('Show Standard'))
                                        <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                            href="{{ route('standards.show', $child->id) }}"
                                            data-bs-toggle="tooltip" title="{{ __('View') }}">
                                            <i class="ti ti-eye f-20"></i>
                                        </a>
                                    @endif
                                    <!-- Edit Button -->
                                    @if (Gate::check('Edit Standard'))
                                        <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                            href="{{ route('standards.edit', $child->id) }}"
                                            data-bs-toggle="tooltip" title="{{ __('Edit') }}">
                                            <i class="ti ti-edit f-20"></i>
                                        </a>
                                    @endif

                                    <!-- Delete Button -->
                                    @if (Gate::check('Delete Standard'))
                                        {!! Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['standards.destroy', $child->id],
                                            'id' => 'delete-form-' . $child->id,
                                        ]) !!}
                                        <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2 confirm_dialog"
                                            href="#" data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                            data-confirm="{{ __('Are You Sure?') }}"
                                            data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                            data-confirm-yes="delete-form-{{ $child->id }}">
                                            <i class="ti ti-trash f-20"></i>
                                        </a>
                                        {!! Form::close() !!}
                                    @endif
                                    @if ($child->criteria->isNotEmpty())
                                        @if (Gate::check('Manage Criteria'))
                                            <button
                                                class="bg-light-secondary btn btn-rounded btn-sm btn-small mb-3 rounded-3 toggle-criteria"
                                                data-target="#criteria-child-{{ $child->id }}">
                                                {{ __('Show Criterion') }}
                                            </button>
                                        @endif
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Criteria Section for Sub-Standards -->
                        <tr class="collapse" id="criteria-child-{{ $child->id }}">
                            <td colspan="10">
                                <li><strong class="mb-4">{{ __('Criteria for') }} <span class="text-danger">
                                            {{ $standard->name }} </span></strong></li>
                                @include('self-study.standards._criteria', [
                                    'criteria' => $child->criteria,
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </td>
    </tr>
@endif
