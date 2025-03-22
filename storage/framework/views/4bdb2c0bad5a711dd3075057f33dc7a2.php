<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('MainStandard')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo = \App\Models\Utility::get_file('uploads/is_cover_image/');
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('MainStandard')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('MainStandard')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row gy-4 align-items-center ">
        <div class="col-auto">
            <div class="d-flex">
                

                <a href="<?php echo e(route('main-standards.create')); ?>" class="btn btn-sm btn-icon text-white btn-primary me-2"
                    data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Create')); ?>">
                    <i data-feather="plus"></i>
                </a>
                
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('filter'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('custom/libs/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>
<?php $__env->startPush('script-page'); ?>
    <script src="<?php echo e(asset('custom/libs/summernote/summernote-bs4.js')); ?>"></script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                            <thead>
                                <tr>

                                    <th><?php echo e(__('N')); ?></th>
                                    <th><?php echo e(__('Name ar')); ?></th>
                                    <th><?php echo e(__('Name en')); ?></th>
                                    
                                    
                                    <th><?php echo e(__('Sequence')); ?></th>
                                    <th><?php echo e(__('Sub-Standards Count')); ?></th>
                                    <th><?php echo e(__('Completion Status')); ?></th>
                                    <th><?php echo e(__('Created At')); ?></th>
                                    <th class="text-right" width="200px"><?php echo e(__('Actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $mainStandards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainStandard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($loop->iteration); ?></td>
                                        <td><?php echo e($mainStandard->name_ar); ?></td>

                                        <td><?php echo e($mainStandard->name_en); ?></td>

                                        

                                        

                                        <td><?php echo e($mainStandard->sequence); ?></td>

                                        <td><?php echo e($mainStandard->subStandards->count()); ?></td>
                                        <td>
                                            <?php switch($mainStandard->completion_status):
                                                case ('incomplete'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                                        <?php echo e(__('Incomplete')); ?>

                                                    </span>
                                                <?php break; ?>

                                                <?php case ('partially_complete'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-warning">
                                                        <?php echo e(__('Partially Complete')); ?>

                                                    </span>
                                                <?php break; ?>

                                                <?php case ('complete'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-success">
                                                        <?php echo e(__('Complete')); ?>

                                                    </span>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>
                                        <!-- Created At -->
                                        <td><?php echo e(\App\Models\Utility::dateFormat($mainStandard->created_at)); ?></td>

                                        <!-- Actions -->
                                        <td>
                                            <div class="d-flex">
                                                <!-- View Button -->
                                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="<?php echo e(route('main-standards.show', $mainStandard->id)); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?php echo e(__('View')); ?>">
                                                    <i class="ti ti-eye f-20"></i>
                                                </a>

                                                <!-- Edit Button -->
                                                <a class="btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="<?php echo e(route('main-standards.edit', $mainStandard->id)); ?>"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?php echo e(__('Edit')); ?>">
                                                    <i class="ti ti-edit f-20"></i>
                                                </a>

                                                <!-- Delete Button -->
                                                <?php echo Form::open([
                                                    'method' => 'DELETE',
                                                    'route' => ['main-standards.destroy', $mainStandard->id],
                                                    'id' => 'delete-form-' . $mainStandard->id,
                                                ]); ?>

                                                <a class="show_confirm btn btn-sm btn-icon bg-light-secondary me-2"
                                                    href="#" data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="<?php echo e(__('Delete')); ?>">
                                                    <i class="ti ti-trash f-20"></i>
                                                </a>
                                                <?php echo Form::close(); ?>

                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '#billing_data', function() {
            $("[name='shipping_address']").val($("[name='billing_address']").val());
            $("[name='shipping_city']").val($("[name='billing_city']").val());
            $("[name='shipping_state']").val($("[name='billing_state']").val());
            $("[name='shipping_country']").val($("[name='billing_country']").val());
            $("[name='shipping_postalcode']").val($("[name='billing_postalcode']").val());
        })
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/main_standards/index.blade.php ENDPATH**/ ?>