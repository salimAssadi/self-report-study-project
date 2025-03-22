<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Create Standard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Create Standard')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('main-standards.index')); ?>"><?php echo e(__('MainStandard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Create Standard')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="pr-2">

        <a href="<?php echo e(route('main-standards.index')); ?>" class="btn btn-light-secondary me-3"> <i data-feather="x-circle"
                class="me-2"></i><?php echo e(__('Cancel')); ?></a>
        <a type="submit" id="submit-all" class="btn btn-primary text-white"> <i data-feather="check-circle"
                class="me-2"></i><?php echo e(__('Save')); ?></a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
    <script>
        function toggleSubStandardFields() {
            const type = document.getElementById('type').value;
            const mainStandardField = document.querySelectorAll('.main-standard-field');
            const subStandardField = document.querySelector('#sub-standard-field');
            if (type === 'sub') {
                subStandardField.classList.remove('d-none');
                mainStandardField.forEach(field => field.classList.add('d-none'));
            } else {
                subStandardField.classList.add('d-none');
                mainStandardField.forEach(field => field.classList.remove('d-none'));
            }
        }

        document.getElementById('submit-all').addEventListener('click', function() {
            document.getElementById('hidden-submit').click();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <?php echo e(Form::open(['method' => 'post', 'id' => 'frmTarget', 'enctype' => 'multipart/form-data', 'route' => 'main-standards.store'])); ?>

            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border border-primary">
                        <div class="card-body">
                            <!-- Select Type: Main Standard or Sub-Standard -->
                            <div class="form-group">
                                <?php echo e(Form::label('type', __('Type'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('type', ['main' => __('Main Standard'), 'sub' => __('Sub-Standard')], null, ['class' => 'form-control', 'id' => 'type', 'onchange' => 'toggleSubStandardFields()'])); ?>

                            </div>

                            <!-- Parent Main Standard (Visible only for Sub-Standards) -->
                            <div id="sub-standard-field"  class="form-group d-none ">
                                <?php echo e(Form::label('main_standard_id', __('Parent Main Standard'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select('main_standard_id', $mainStandards->pluck('name_ar', 'id'), null, ['class' => 'form-control', ])); ?>

                            </div>

                            <!-- Sequence -->
                            <div class="form-group">
                                <?php echo e(Form::label('sequence', __('Sequence'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::number('sequence', null, ['class' => 'form-control', 'placeholder' => __('Enter Sequence'),'step' => '0.1'])); ?>

                            </div>

                            <!-- Tabbed Interface for AR and EN Fields -->
                            <ul class="nav nav-tabs nav-fill w-25" id="languageTabs" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="ar-tab" data-bs-toggle="tab"
                                        data-bs-target="#ar-fields" type="button" role="tab" aria-controls="ar-fields"
                                        aria-selected="true"><?php echo e(__('Arabic')); ?></button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="en-tab" data-bs-toggle="tab" data-bs-target="#en-fields"
                                        type="button" role="tab" aria-controls="en-fields"
                                        aria-selected="false"><?php echo e(__('English')); ?></button>
                                </li>
                            </ul>
                            <div class="tab-content" id="languageTabsContent">
                                <!-- Arabic Fields -->
                                <div class="tab-pane fade show active" id="ar-fields" role="tabpanel"
                                    aria-labelledby="ar-tab">
                                    <div class="form-group mt-3">
                                        <?php echo e(Form::label('name_ar', __('Name (Arabic)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('name_ar', null, ['class' => 'form-control ', 'placeholder' => __('Enter Name (Arabic)')])); ?>

                                    </div>
                                    <div class="form-group  main-standard-field">
                                        <?php echo e(Form::label('introduction_ar', __('Introduction (Arabic)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('introduction_ar', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Introduction (Arabic)'), ])); ?>

                                    </div>

                                    <div class="form-group">
                                        <?php echo e(Form::label('description_ar', __('Description (Arabic)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('description_ar', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Description (Arabic)'), ])); ?>

                                    </div>
                                    <div class="form-group  main-standard-field">
                                        <?php echo e(Form::label('summary_ar', __('Summary (Arabic)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('summary_ar', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Summary (Arabic)'), ])); ?>

                                    </div>
                                </div>

                                <!-- English Fields -->
                                <div class="tab-pane fade" id="en-fields" role="tabpanel" aria-labelledby="en-tab">
                                    <div class="form-group  mt-3">
                                        <?php echo e(Form::label('name_en', __('Name (English)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('name_en', null, ['class' => 'form-control', 'placeholder' => __('Enter Name (English)'), ])); ?>

                                    </div>
                                    <div class="form-group  main-standard-field">
                                        <?php echo e(Form::label('introduction_en', __('Introduction (English)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('introduction_en', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Introduction (English)'), ])); ?>

                                    </div>

                                    <div class="form-group">
                                        <?php echo e(Form::label('description_en', __('Description (English)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('description_en', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Description (English)'), ])); ?>

                                    </div>
                                    <div class="form-group  main-standard-field">
                                        <?php echo e(Form::label('summary_en', __('Summary (English)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('summary_en', null, ['class' => 'form-control summernote', 'rows' => 2, 'placeholder' => __('Enter Summary (English)'), ])); ?>

                                    </div>



                                </div>

                            </div>

                            <div class="form-group mt-3">
                                <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-primary', 'id' => 'hidden-submit', 'style' => 'display:none;'])); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo e(Form::close()); ?>


        </div>
        <!-- [ sample-page ] end -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/main_standards/create.blade.php ENDPATH**/ ?>