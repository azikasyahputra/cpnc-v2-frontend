<?php $__env->startSection('content'); ?>
    <div class="col-md-12 col-sm-12 col-12">
        <div class="x_title">
            <h2>Edit Kemasan</h2>
            <div class="clearfix"></div>
         </div>
        <div class="x_content">
            <?php $__currentLoopData = $kemasan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <form id="demo-form" action="<?php echo e(URL::route('kemasansaveedit')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id_kemasan" value="<?php echo e($data->id_kemasan); ?>"/>
                
                <label for="kemasan">Nama Kemasan* :</label>
                <input type="text" id="kemasan" class="form-control" name="kemasan" value="<?php echo e($data->nama_kemasan); ?>" required />

                <br/>
                <a href="<?php echo e(URL::route('kemasan')); ?>" class="btn btn-danger">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/kemasan/edit.blade.php ENDPATH**/ ?>