<form method="post" action="<?php echo e(route('users.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-body">
        <div class="row">
            <div class="form-group col-md-12">
                <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('name', null, ['class' => 'form-control', 'placeholder' => __('Enter Name'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-md-12">
                <?php echo e(Form::label('Email', __('Email'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::email('email', null, ['class' => 'form-control', 'placeholder' => __('Enter Email'), 'required' => 'required'])); ?>

            </div>
            <div class="form-group col-md-12">
                <?php echo e(Form::label('User Role', __('User Role'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::select('role', $roles, null, ['class' => 'form-control', 'placeholder' => __('Select Role'), 'required' => 'required'])); ?>

            </div>
            <div class="col-6 form-group">
                <label for="password_switch"><?php echo e(__('Login is enable')); ?></label>
                <div class="form-check form-switch custom-switch-v1 float-end">
                    <input type="checkbox" name="password_switch" class="form-check-input input-primary pointer" value="on" id="password_switch">
                    <label class="form-check-label" for="password_switch"></label>
                </div>
            </div>
            <div class="col-12 ps_div d-none">
                <div class="form-group">
                    <?php echo e(Form::label('password', __('Password'), ['class' => 'col-form-label'])); ?>

                    <?php echo e(Form::password('password', ['class' => 'form-control', 'placeholder' => __('Enter Password')])); ?>

                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small class="invalid-password" role="alert">
                            <strong class="text-danger"><?php echo e($message); ?></strong>
                        </small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>
            <div class="form-group col-12 d-flex justify-content-end col-form-label">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light"
                    data-bs-dismiss="modal">
                <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
            </div>
        </div>
    </div>
</form>
<?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/users/create.blade.php ENDPATH**/ ?>