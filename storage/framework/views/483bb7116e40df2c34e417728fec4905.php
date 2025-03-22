<form method="post" action="<?php echo e(route('criteria.store')); ?>">
    <?php echo csrf_field(); ?>
    <div class="modal-body">
        <div class="row">
            
            <div class="form-group  col-md-12">
                <?php echo e(Form::label('standard_id', __('Standard'), ['class' => 'form-label'])); ?>

                <select name="main_standard_id" id="main_standard_id" class="form-control" required>
                    <option value=""><?php echo e(__('Select Standard')); ?></option>
                    <?php $__currentLoopData = $mainStandards; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mainStandard): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($mainStandard->id); ?>"><?php echo e($mainStandard->name_ar); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Standard ID -->
            <div class="form-group  col-md-12">
                <?php echo e(Form::label('standard_id', __('Standard'), ['class' => 'form-label'])); ?>

                <select name="sub_standard_id" id="sub_standard_id" class="form-control">
                    <option value=""><?php echo e(__('Select Standard')); ?></option>
                   
                </select>
            </div>
            <!-- Sequence -->
            <div class="form-group  col-md-6">
                <?php echo e(Form::label('sequence', __('Sequence'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::number('sequence', null, ['class' => 'form-control', 'placeholder' => __('Enter Sequence'), 'step' => '0.1'])); ?>

            </div>
            <!-- Name (Arabic) -->
            <div class="form-group  col-md-12">
                <?php echo e(Form::label('name_ar', __('Name (Arabic)'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::textarea('name_ar', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => __('Enter Name (Arabic)'), 'required'])); ?>

            </div>
            <div class="form-group  col-md-12">
                <?php echo e(Form::label('name_en', __('Name (English)'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::textarea('name_en', null, ['class' => 'form-control', 'rows' => 1, 'placeholder' => __('Enter Name (English)'), 'required'])); ?>


            </div>

            <div class="form-group col-12 d-flex  justify-content-md-between col-form-label">
                <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary btn-light"
                    data-bs-dismiss="modal">
                <input type="submit" value="<?php echo e(__('Save')); ?>" class="btn btn-primary ms-2">
            </div>
        </div>
    </div>
</form>


<script>
    document.getElementById('main_standard_id').addEventListener('change', function() {
        const main_standard_id = this.value;
        const standardIdDropdown = document.getElementById('sub_standard_id');

        // Clear existing options
        standardIdDropdown.innerHTML = `<option value=""><?php echo e(__('Select Standard')); ?></option>`;

        if (main_standard_id) {
            $.ajax({
                url: `<?php echo e(route('api.standards')); ?>`, // API endpoint
                type: 'GET',
                data: {
                    main_standard_id: main_standard_id // Pass the selected type
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
</script>

<?php /**PATH D:\XAMPP\htdocs\whatsstore_saas\resources\views/criteria/create.blade.php ENDPATH**/ ?>