<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Standard Detail')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Standard Detail')); ?>

<?php $__env->stopSection(); ?>
<?php
    $logo = \App\Models\Utility::get_file('uploads/is_cover_image/');
    $p_logo = \App\Models\Utility::get_file('uploads/product_image/');
?>
<?php $__env->startSection('action-btn'); ?>
    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('Edit Products')): ?>
        <div class="row  m-1">
            <div class="col-12 pe-0">
                <a href="<?php echo e(route('main-standards.edit', $mainStandard->id)); ?>" class="btn btn-sm btn-primary btn-icon"
                    class="btn btn-sm btn-primary btn-icon" data-bs-toggle="tooltip" data-bs-placement="top"
                    title="<?php echo e(__('Edit Standard')); ?>"><i class="ti ti-edit text-white"></i></a>
            </div>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>

    <li class="breadcrumb-item"><a href="<?php echo e(route('main-standards.index')); ?>"><?php echo e(__('MainStandard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Standard Detail')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <!-- [ sample-page ] start -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border border-primary shadow-none">
                        <div class="card-body">
                            <div
                                class="d-flex mb-3 align-items-center gap-2 flex-sm-row flex-column justify-content-between">
                                <h4 style="width: 80%;"><?php echo e($criteria->name_ar); ?></h4>
                                <div class="ps-3 d-flex align-items-center ">
                                    <?php switch($criteria->fulfillment_status):
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
                                    <div class="text-end ms-3">
                                        <?php if($criteria->is_met == '1'): ?>
                                            <span class="badge rounded p-2 f-w-600  bg-light-info">
                                                <?php echo e(__('Matching')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="badge rounded p-2 f-w-600  bg-light-danger">
                                                <?php echo e(__('Not Matching')); ?>

                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <p class="border  mb-4 rounded border-primary"></p>
                            <p class="mb-2"><?php echo e(__('Description')); ?>:</p>
                            <p> </p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 d-none">
                    <div class="row">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4><?php echo e(__('Express Checkout')); ?></h4>
                                        <small
                                            class="text-dark font-weight-bold"><?php echo e(__('Note:Create Express Checkout Url For Direct Order')); ?></small>
                                    </div>
                                    <a href="#" class="btn btn-primary" data-ajax-popup="true"
                                        data-url="<?php echo e(route('criteria.create', [$criteria->id])); ?>"
                                        data-title="<?php echo e(__('Add Product')); ?>" data-bs-toggle="tooltip"
                                        data-bs-placement="top" title="<?php echo e(__('Create')); ?>" data-tooltip="Create">
                                        <?php echo e(__('Add')); ?>

                                    </a>
                                </div>
                            </div>
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table mb-0 pc-dt-simple" id="pc-dt-simple">
                                        <thead>
                                            <tr>
                                                <th><?php echo e(__('Name')); ?></th>
                                                <th><?php echo e(__('Quantity')); ?></th>
                                                <th><?php echo e(__('Variant Name')); ?></th>
                                                <th><?php echo e(__('URL')); ?></th>
                                                <th><?php echo e(__('Action')); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row gy-3 gx-3">
                        <div class="col-sm-6">
                            <div class="card border  shadow-none">
                                <div class="card-body">
                                    <h4><?php echo e(__('Color')); ?></h4>
                                    <div class="row align-items-center">
                                        <input type="hidden" id="product_id">
                                        <input type="hidden" id="variant_id" value="">
                                        <input type="hidden" id="variant_qty" value="">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border  shadow-none">
                                <div class="card-body">
                                    <div class="row align-items-center">
                                        <div class="col-sm-6 mb-4 mb-sm-0">
                                            <span class="d-block h6 mb-0">
                                                <span class="d-block h3 mb-0 variasion_price">


                                                </span>
                                            </span>
                                        </div>
                                        <div class="col-sm-6 mb-4 mb-sm-0 text-end">
                                            <span class="d-block h6 mb-0">
                                                <button type="button" class="btn btn-primary btn-icon">
                                                    <span class="btn-inner--icon variant_qty">

                                                    </span>
                                                    <span class="btn-inner--text">
                                                        <?php echo e(__('Total Avl.Quantity')); ?>

                                                    </span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card border  shadow-none">
                        <div class="card-header">
                            <h4><?php echo e(__('Gallery')); ?></h4>
                        </div>
                        <div class="card-body">
                            <div class="row gy-3 gx-3">

                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- [ sample-page ] end -->
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/criteria/show.blade.php ENDPATH**/ ?>