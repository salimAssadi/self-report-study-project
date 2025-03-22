<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Criteria')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo = \App\Models\Utility::get_file('uploads/is_cover_image/');
?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Criteria')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Criteria')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="row gy-4 align-items-center ">
        <div class="col-auto">
            <div class="d-flex">
                
                <a class="btn btn-sm btn-icon text-white  btn-primary me-2" data-url="<?php echo e(route('criteria.create')); ?>"
                    data-title="<?php echo e(__('Add Criterion')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip"
                    data-bs-placement="top" title="<?php echo e(__('Add Criterion')); ?>">
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
                                    <th><?php echo e(__('Name (Arabic)')); ?></th>
                                    <th><?php echo e(__('Name (English)')); ?></th>
                                    <th><?php echo e(__('Standard')); ?></th>
                                    <th><?php echo e(__('Compliance')); ?></th>
                                    <th><?php echo e(__('Fulfillment Status')); ?></th>
                                    <th><?php echo e(__('Actions')); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $criteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($criterion->name_ar); ?></td>
                                        <td><?php echo e($criterion->name_en); ?></td>
                                        <td>
                                            <?php echo e($criterion->standard?->name_ar ?? ($criterion->standard?->name_en ?? '-')); ?>

                                        </td>
                                        <td>
                                            <?php switch($criterion->is_met):
                                                case (1): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-success">
                                                        <?php echo e(__('Matching')); ?>

                                                    </span>
                                                <?php break; ?>

                                                <?php case (0): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                                        <?php echo e(__('Not Matching')); ?>

                                                    </span>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>

                                        <td>
                                            <?php switch($criterion->fulfillment_status):
                                                case ('1'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-danger">
                                                        <?php echo e(__('Not Fulfilled')); ?>

                                                    </span>
                                                <?php break; ?>

                                                <?php case ('2'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-warning">
                                                        <?php echo e(__('Partially Fulfilled')); ?>

                                                    </span>
                                                <?php break; ?>

                                                <?php case ('3'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-info">
                                                        <?php echo e(__('Fulfilled')); ?>

                                                    </span>
                                                <?php break; ?>

                                                <?php case ('4'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-primary">
                                                        <?php echo e(__('Fulfilled with Excellence')); ?>

                                                    </span>
                                                <?php break; ?>

                                                <?php case ('5'): ?>
                                                    <span class="badge rounded p-2 f-w-600 bg-light-success">
                                                        <?php echo e(__('Fulfilled with Distinction')); ?>

                                                    </span>
                                                <?php break; ?>
                                            <?php endswitch; ?>
                                        </td>

                                        

                                        <td>
                                            <a href="<?php echo e(route('criteria.show', $criterion->id)); ?>"
                                                class="btn btn-sm btn-info"><?php echo e(__('Manage')); ?></a>
                                            <a href="<?php echo e(route('criteria.edit', $criterion->id)); ?>"
                                                class="btn btn-sm btn-warning"><?php echo e(__('Edit')); ?></a>
                                            <form action="<?php echo e(route('criteria.destroy', $criterion->id)); ?>" method="POST"
                                                style="display: inline;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('<?php echo e(__('Are you sure you want to delete this Criterion?')); ?>')">
                                                    <?php echo e(__('Delete')); ?>

                                                </button>
                                            </form>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/criteria/index.blade.php ENDPATH**/ ?>