<div class="dash-container" style="background: #eef2f6;
    border-radius: 10px;">
    <div class="dash-content">
        <!-- [ breadcrumb ] start -->
        <div class="page-header"
            style="min-height: 55px;
                    padding: 13px 25px;
                    box-shadow: none;
                    background: #ffffff;
                    border-radius: 8px;">
            <div class="page-block">
                <div class="row align-items-center ">
                    <div class="col-md-12">
                        <div class="d-block d-sm-flex align-items-center justify-content-between">
                            <div style="flex:none; margin-right:50px;">
                                <div class="page-header-title">
                                    <h4 class=""><?php echo $__env->yieldContent('page-title'); ?></h4>
                                </div>
                                <ul class="breadcrumb">
                                    <?php echo $__env->yieldContent('breadcrumb'); ?>
                                </ul>
                            </div>
                            <div>
                                <?php echo $__env->yieldContent('action-btn'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php echo $__env->yieldContent('content'); ?>
    </div>
</div>
<?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/partials/admin/content.blade.php ENDPATH**/ ?>