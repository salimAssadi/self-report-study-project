@extends('layouts.admin-app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Self Report') }}</div>

                <div class="card-body">
                    <div class="accordion" id="selfReportAccordion">
                        <!-- Institution Profile -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading1">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1" aria-expanded="true" aria-controls="collapse1">
                                    {{ __('Institution Profile') }}
                                </button>
                            </h2>
                            <div id="collapse1" class="accordion-collapse collapse show" aria-labelledby="heading1" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}" class="institution-profile-form">
                                        @csrf
                                        <input type="hidden" name="section" value="institution_profile">
                                        <div class="mb-3">
                                            <label for="institutionName" class="form-label">{{ __('Institution Name') }}</label>
                                            <input type="text" class="form-control" id="institutionName" name="institution_name">
                                        </div>
                                        <div class="mb-3">
                                            <label for="description" class="form-label">{{ __('Description') }}</label>
                                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Statistical Data -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading2">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                                    {{ __('Statistical Data') }}
                                </button>
                            </h2>
                            <div id="collapse2" class="accordion-collapse collapse" aria-labelledby="heading2" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}" class="statistical-data-form">
                                        @csrf
                                        <input type="hidden" name="section" value="statistical_data">
                                        <div class="mb-3">
                                            <label for="statisticalData" class="form-label">{{ __('Statistical Information') }}</label>
                                            <textarea class="form-control" id="statisticalData" name="statistical_data" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Education and Training Body -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading3">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                                    {{ __('Education and Training Body') }}
                                </button>
                            </h2>
                            <div id="collapse3" class="accordion-collapse collapse" aria-labelledby="heading3" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="education_training">
                                        <div class="mb-3">
                                            <label for="trainingInfo" class="form-label">{{ __('Education and Training Information') }}</label>
                                            <textarea class="form-control" id="trainingInfo" name="training_info" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Classification of the Education and Training Body -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading4">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse4" aria-expanded="false" aria-controls="collapse4">
                                    {{ __('Classification of the Education and Training Body') }}
                                </button>
                            </h2>
                            <div id="collapse4" class="accordion-collapse collapse" aria-labelledby="heading4" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="classification">
                                        <div class="mb-3">
                                            <label for="classification" class="form-label">{{ __('Classification Details') }}</label>
                                            <textarea class="form-control" id="classification" name="classification" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Students -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading5">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                                    {{ __('Students') }}
                                </button>
                            </h2>
                            <div id="collapse5" class="accordion-collapse collapse" aria-labelledby="heading5" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="students">
                                        <div class="mb-3">
                                            <label for="studentInfo" class="form-label">{{ __('Student Information') }}</label>
                                            <textarea class="form-control" id="studentInfo" name="student_info" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Student Classification by Qualification -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading6">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                                    {{ __('Student Classification by Qualification') }}
                                </button>
                            </h2>
                            <div id="collapse6" class="accordion-collapse collapse" aria-labelledby="heading6" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="student_classification">
                                        <div class="mb-3">
                                            <label for="qualificationInfo" class="form-label">{{ __('Qualification Information') }}</label>
                                            <textarea class="form-control" id="qualificationInfo" name="qualification_info" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Discussion of Statistical Data -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading7">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                                    {{ __('Discussion of Statistical Data') }}
                                </button>
                            </h2>
                            <div id="collapse7" class="accordion-collapse collapse" aria-labelledby="heading7" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="statistical_discussion">
                                        <div class="mb-3">
                                            <label for="dataDiscussion" class="form-label">{{ __('Data Discussion') }}</label>
                                            <textarea class="form-control" id="dataDiscussion" name="data_discussion" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Key Performance Indicators and Benchmarking -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading8">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                                    {{ __('Key Performance Indicators and Benchmarking') }}
                                </button>
                            </h2>
                            <div id="collapse8" class="accordion-collapse collapse" aria-labelledby="heading8" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="kpi_benchmarking">
                                        <div class="mb-3">
                                            <label for="kpiInfo" class="form-label">{{ __('KPI Information') }}</label>
                                            <textarea class="form-control" id="kpiInfo" name="kpi_info" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Self-Assessment Based on Quality Assurance Standards -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading9">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                                    {{ __('Self-Assessment Based on Quality Assurance Standards') }}
                                </button>
                            </h2>
                            <div id="collapse9" class="accordion-collapse collapse" aria-labelledby="heading9" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="self_assessment">
                                        <div class="mb-3">
                                            <label for="assessmentInfo" class="form-label">{{ __('Assessment Information') }}</label>
                                            <textarea class="form-control" id="assessmentInfo" name="assessment_info" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Independent Evaluations -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading10">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse10" aria-expanded="false" aria-controls="collapse10">
                                    {{ __('Independent Evaluations (Optional)') }}
                                </button>
                            </h2>
                            <div id="collapse10" class="accordion-collapse collapse" aria-labelledby="heading10" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="independent_evaluations">
                                        <div class="mb-3">
                                            <label for="evaluationInfo" class="form-label">{{ __('Evaluation Information') }}</label>
                                            <textarea class="form-control" id="evaluationInfo" name="evaluation_info" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Executive Recommendations -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading11">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                                    {{ __('Executive Recommendations') }}
                                </button>
                            </h2>
                            <div id="collapse11" class="accordion-collapse collapse" aria-labelledby="heading11" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}">
                                        @csrf
                                        <input type="hidden" name="section" value="executive_recommendations">
                                        <div class="mb-3">
                                            <label for="recommendationInfo" class="form-label">{{ __('Recommendation Information') }}</label>
                                            <textarea class="form-control" id="recommendationInfo" name="recommendation_info" rows="4"></textarea>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!-- Attachments -->
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="heading12">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                                    {{ __('Attachments') }}
                                </button>
                            </h2>
                            <div id="collapse12" class="accordion-collapse collapse" aria-labelledby="heading12" data-bs-parent="#selfReportAccordion">
                                <div class="accordion-body">
                                    <form method="POST" action="{{ route('setting.saveSelfReport') }}" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="section" value="attachments">
                                        <div class="mb-3">
                                            <label for="attachments" class="form-label">{{ __('Upload Attachments') }}</label>
                                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                                        </div>
                                        <button type="submit" class="btn btn-primary">{{ __('Upload') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Initialize any JavaScript enhancements here
    document.addEventListener('DOMContentLoaded', function() {
        // Add any necessary JavaScript initialization
    });
</script>
@endsection
