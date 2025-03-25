@if ($standard->children->isNotEmpty())
    <tr class="collapse" id="children-{{ $standard->id }}">
        <td colspan="10">
            <h5 class="mb-3">{{ __('Sub-Standards') }}</h5>

            <table class="table table-bordered">
                <thead class="bg-brand-color-4">
                    <tr>
                        <th> {{ __('N') }}</th>
                        <th>{{ __('Sub-Name (Arabic)') }}</th>
                        <th>{{ __('Sub-Name (English)') }}</th>
                        <th>{{ __('Sub-Sequence') }}</th>
                        <th>{{ __('Number of Criteria') }}</th>
                        <th>{{ __('Sub-Completion Status') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($standard->children as $child)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $child->name_ar }}</td>
                            <td>{{ $child->name_en }}</td>
                            <td>{{ $child->sequence }}</td>
                            <td>{{ $child->criteria()->count() }}</td>
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
                                        <button class="btn btn-sm btn-icon bg-light-secondary me-2 toggle-criteria"
                                            data-target="#criteria-child-{{ $child->id }}">
                                            <i class="ti ti-chevron-down"></i>
                                        </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </td>
    </tr>
@endif
