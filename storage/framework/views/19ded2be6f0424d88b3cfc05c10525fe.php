<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Edit Criterion')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Edit Criterion')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><a href="<?php echo e(route('criteria.index')); ?>"><?php echo e(__('Criteria')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Edit Criterion')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="pr-2">

        <a href="<?php echo e(route('criteria.index')); ?>" class="btn btn-light-secondary me-3"> <i data-feather="x-circle"
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

        let linkIndex = 1;

        document.getElementById('add-link').addEventListener('click', function() {
            const tableBody = document.querySelector('#links-table tbody');
            const newRow = document.createElement('tr');
            newRow.classList.add('link-row');
            newRow.innerHTML = `
                        <td>
                            <input type="text" name="links[${linkIndex}][name_ar]" class="form-control" placeholder="<?php echo e(__('Link Name (Arabic)')); ?>">
                        </td>
                        <td>
                            <input type="text" name="links[${linkIndex}][name_en]" class="form-control" placeholder="<?php echo e(__('Link Name (English)')); ?>">
                        </td>
                        <td>
                            <input type="text" name="links[${linkIndex}][url]" class="form-control" placeholder="<?php echo e(__('Link URL')); ?>">
                        </td>
                        <td class="w-10 text-center">
                            <button type="button" class="btn btn-sm btn-danger remove-link"><i class="fa fa-minus"></i></button>
                        </td>
                    `;
            tableBody.appendChild(newRow);
            linkIndex++;
        });

        // Remove link row
        document.querySelector('#links-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-link')) {
                e.target.closest('tr').remove();
            }
        });


        let attachmentIndex = 1;

        document.getElementById('add-attachment').addEventListener('click', function() {
            const tableBody = document.querySelector('#attachments-table tbody');
            const newRow = document.createElement('tr');
            newRow.classList.add('attachment-row');
            newRow.innerHTML = `
                                <td>
                                    <input type="text" name="attachments[${attachmentIndex}][name_ar]" class="form-control" placeholder="<?php echo e(__('Attachment Name (Arabic)')); ?>">
                                </td>
                                <td>
                                    <input type="text" name="attachments[${attachmentIndex}][name_en]" class="form-control" placeholder="<?php echo e(__('Attachment Name (English)')); ?>">
                                </td>
                                <td>
                                    <input type="file" name="attachments[${attachmentIndex}][file]" class="form-control">
                                </td>
                                <td class="w-10 text-center">
                                    <button type="button" class="btn btn-sm btn-danger remove-attachment"><i class="fa fa-minus"></i></button>
                                </td>
                            `;
            tableBody.appendChild(newRow);
            attachmentIndex++;
        });

        // Remove attachment row
        document.querySelector('#attachments-container').addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('remove-attachment')) {
                e.target.closest('tr').remove();
            }
        });

        // Dynamically populate the Standard dropdown based on the selected Standard Type
        document.getElementById('standard_type').addEventListener('change', function() {
            const standardType = this.value;
            const standardIdDropdown = document.getElementById('standard_id');
            // Clear existing options
            standardIdDropdown.innerHTML = `<option value=""><?php echo e(__('Select Standard')); ?></option>`;
            if (standardType) {
                $.ajax({
                    url: `<?php echo e(route('api.standards')); ?>`,
                    type: 'GET',
                    data: {
                        type: standardType
                    },
                    success: function(data) {
                        // Populate the dropdown with received data
                        data.forEach(standard => {
                            const option = document.createElement('option');
                            option.value = standard.id;
                            option.textContent = standard.name_ar || standard.name_en;
                            standardIdDropdown.appendChild(option);
                        });
                    },
                    error: function(error) {
                        console.error('Error fetching standards:', error);
                    }
                });
            }
        });
        document.getElementById('submit-all').addEventListener('click', function() {
            document.getElementById('hidden-submit').click();
        });
    </script>
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
            <?php echo e(Form::open(['method' => 'PUT', 'route' => ['criteria.update', $criteria], 'enctype' => 'multipart/form-data'])); ?>

            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow-none border border-primary">
                        <div class="card-body">
                            <div class="form-group">
                                <?php echo e(Form::label('standard_type', __('Standard Type'), ['class' => 'form-label'])); ?>

                                <?php echo e(Form::select(
                                    'standard_type',
                                    [
                                        'main' => __('Main Standard'),
                                        'sub' => __('Sub-Standard'),
                                    ],
                                    $criteria->standard_type,
                                    ['class' => 'form-control', 'id' => 'standard_type'],
                                )); ?>

                            </div>

                            <!-- Standard ID -->
                            <div class="form-group">
                                <?php echo e(Form::label('standard_id', __('Standard'), ['class' => 'form-label'])); ?>

                                <select name="standard_id" id="standard_id" class="form-control" required>
                                    <option value=""><?php echo e(__('Select Standard')); ?></option>
                                    <?php $__currentLoopData = $Standards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $standard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($standard->id); ?>" <?php if($standard->id == $criteria->standard_id): echo 'selected'; endif; ?>>
                                            <?php echo e($standard->name_ar); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
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
                                <div class="tab-pane fade show active" id="ar-fields" role="tabpanel"
                                    aria-labelledby="ar-tab">
                                    <!-- Name (Arabic) -->
                                    <div class="form-group mt-3">
                                        <?php echo e(Form::label('name_ar', __('Name (Arabic)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('name_ar', $criteria->name_ar, ['class' => 'form-control', 'placeholder' => __('Enter Name (Arabic)')])); ?>

                                    </div>

                                    <!-- Content (Arabic) -->
                                    <div class="form-group">
                                        <?php echo e(Form::label('content_ar', __('Content (Arabic)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('content_ar', $criteria->content_ar, ['class' => 'form-control summernote', 'rows' => 3, 'placeholder' => __('Enter Content (Arabic)')])); ?>

                                    </div>

                                </div>
                                <div class="tab-pane fade" id="en-fields" role="tabpanel" aria-labelledby="en-tab">
                                    <!-- Name (English) -->
                                    <div class="form-group mt-3">
                                        <?php echo e(Form::label('name_en', __('Name (English)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::text('name_en', $criteria->name_en, ['class' => 'form-control', 'placeholder' => __('Enter Name (English)')])); ?>

                                    </div>

                                    <!-- Content (English) -->
                                    <div class="form-group">
                                        <?php echo e(Form::label('content_en', __('Content (English)'), ['class' => 'form-label'])); ?>

                                        <?php echo e(Form::textarea('content_en', $criteria->content_en, ['class' => 'form-control summernote', 'rows' => 3, 'placeholder' => __('Enter Content (English)')])); ?>

                                    </div>

                                </div>
                            </div>




                            <!-- Links -->
                            <div class="form-group">
                                <?php echo e(Form::label('links', __('Links'), ['class' => 'form-label'])); ?>

                                <div id="links-container">
                                    <table class="table table-bordered" id="links-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Link Name (Arabic)')); ?></th>
                                                <th><?php echo e(__('Link Name (English)')); ?></th>
                                                <th><?php echo e(__('Link URL')); ?></th>
                                                <th class="w-10 text-center">
                                                    <button type="button" id="add-link" class="btn btn-sm btn-primary"><i
                                                            class="fa fa-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php $__currentLoopData = $criteria->links; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $link): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr class="link-row">
                                                    <td>
                                                        <input type="hidden" name="links[<?php echo e($loop->index); ?>][id]"
                                                            value="<?php echo e($link->id); ?>">
                                                        <input type="text" name="links[<?php echo e($loop->index); ?>][name_ar]"
                                                            class="form-control"
                                                            placeholder="<?php echo e(__('Link Name (Arabic)')); ?>"
                                                            value="<?php echo e($link->name_ar); ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="links[<?php echo e($loop->index); ?>][name_en]"
                                                            class="form-control"
                                                            placeholder="<?php echo e(__('Link Name (English)')); ?>"
                                                            value="<?php echo e($link->name_en); ?>">
                                                    </td>
                                                    <td>
                                                        <input type="text" name="links[<?php echo e($loop->index); ?>][url]"
                                                            class="form-control" placeholder="<?php echo e(__('Link URL')); ?>"
                                                            value="<?php echo e($link->url); ?>">
                                                    </td>
                                                    <td class="w-10 text-center">
                                                        <button type="button" class="btn btn-sm btn-danger remove-link"><i
                                                                class="fa fa-minus"></i></button>
                                                    </td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>



                            <!-- Attachments -->
                            <div class="form-group">
                                <?php echo e(Form::label('attachments', __('Attachments'), ['class' => 'form-label'])); ?>

                                <div id="attachments-container">
                                    <table class="table table-bordered" id="attachments-table">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Attachment Name (Arabic)')); ?></th>
                                                <th><?php echo e(__('Attachment Name (English)')); ?></th>
                                                <th><?php echo e(__('File')); ?></th>
                                                <th class="w-10 text-center">
                                                    <button type="button" id="add-attachment"
                                                        class="btn btn-sm btn-primary"><i class="fa fa-plus"></i>
                                                    </button>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if($criteria->attachments): ?>
                                                <?php $__currentLoopData = $criteria->attachments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $attachment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <tr class="attachment-row">
                                                        <td>
                                                            <?php echo e(Form::text("attachments[$index][name_ar]", $attachment->name_ar, ['class' => 'form-control', 'placeholder' => __('Attachment Name (Arabic)')])); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e(Form::text("attachments[$index][name_en]", $attachment->name_en, ['class' => 'form-control', 'placeholder' => __('Attachment Name (English)')])); ?>

                                                        </td>
                                                        <td>
                                                            <?php echo e(Form::file("attachments[$index][file]", ['class' => 'form-control'])); ?>

                                                        </td>
                                                        <td class="w-10 text-center">
                                                            <button type="button"
                                                                class="btn btn-sm btn-danger remove-attachment">
                                                                <i class="fa fa-minus"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <?php endif; ?>
                                        </tbody>

                                    </table>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/criteria/edit.blade.php ENDPATH**/ ?>