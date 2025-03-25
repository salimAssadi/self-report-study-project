<!-- Children Section -->
@if ($standard->children->isNotEmpty())
    <tr class="collapse" id="children-{{ $standard->id }}">
        <td colspan="10">
            <h5 class="mb-3">{{ __('Sub-Standards') }}</h5>
            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th> {{ __('N') }}</th>
                        <th>{{ __('Name (Arabic)') }}</th>
                        <th>{{ __('Name (English)') }}</th>
                        <th>{{ __('Sequence') }}</th>
                        <th>{{ __('Number of Criteria') }}</th>
                        <th>{{ __('Completion Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standard->children as $child)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $child->name_ar }}</td>
                            <td>{{ $child->name_en }}</td>
                            <td>{{ $child->sequence }}</td>
                            <td>{{ $child->criteria->count() }}</td>
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
                                    <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                        href="{{ route('admin.standards.show', $child->id) }}" data-bs-toggle="tooltip"
                                        title="{{ __('View') }}">
                                        <i class="ti ti-eye f-20"></i>
                                    </a>
                                    <!-- Edit Button -->
                                    <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                        href="{{ route('admin.standards.edit', $child->id) }}" data-bs-toggle="tooltip"
                                        title="{{ __('Edit') }}">
                                        <i class="ti ti-edit f-20"></i>
                                    </a>
                                    <!-- Delete Button -->
                                    {!! Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['admin.standards.destroy', $child->id],
                                        'id' => 'delete-form-' . $child->id,
                                    ]) !!}
                                    <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2" href="#"
                                        data-bs-toggle="tooltip" title="{{ __('Delete') }}"
                                        onclick="event.preventDefault(); if(confirm('{{ __('Are you sure?') }}')) document.getElementById('delete-form-{{ $child->id }}').submit();">
                                        <i class="ti ti-trash f-20"></i>
                                    </a>
                                    {!! Form::close() !!}
                                    @if ($child->criteria->isNotEmpty())
                                        <button class="bg-light-secondary btn btn-rounded btn-sm btn-small mb-3 rounded-3 toggle-criteria"
                                            data-target="#criteria-child-{{ $child->id }}">
                                            {{ __('Show Criterion') }}
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>

                        <!-- Criteria Section for Sub-Standards -->
                        <tr class="collapse" id="criteria-child-{{ $child->id }}">
                            <td colspan="10">
                                <h6 class="mb-3">{{ __('Criteria for ') . $child->name_en }}</h6>
                                @include('self-study.standards._criteria', ['criteria' => $child->criteria])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </td>
    </tr>
@endif
