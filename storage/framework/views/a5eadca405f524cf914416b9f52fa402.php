    <?php echo e(Form::model($user, ['route' => ['users.update', $user->id], 'method' => 'PUT'])); ?>

    <div class="modal-body">
        <?php echo csrf_field(); ?>
        <div class="row">
            <div class="form-group col-md-12">
                <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-md-12">
                <?php echo e(Form::label('Email', __('Email'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::email('email', $user->email, ['class' => 'form-control', 'placeholder' => __('Enter Email'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-md-12">
                <?php echo e(Form::label('User Role', __('User Role'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::select('role', $roles, $user->roles, ['class' => 'form-control', 'placeholder' => __('Select Role'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-12 d-flex justify-content-end col-form-label">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light"
                    data-bs-dismiss="modal">
                <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
            </div>
        </div>
    </div>
    <?php echo Form::close(); ?>

<?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/users/edit.blade.php ENDPATH**/ ?>