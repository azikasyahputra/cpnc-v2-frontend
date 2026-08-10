<?php $__env->startSection('content'); ?>
    <div class="col-md-12 col-sm-12 col-12">
        <div class="x_title">
            <h2>Formulir Kemasan Baru</h2>
            <div class="clearfix"></div>
         </div>
        <div class="x_content">
            <form id="demo-form" action="<?php echo e(URL::route('kemasansave')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <label for="kemasan">Kemasan* :</label>
                <input type="text" id="kemasan" class="form-control" name="kemasan" required />
                
                <br/>
                <a href="<?php echo e(URL::route('kemasan')); ?>" class="btn btn-danger">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>

        </div>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/kemasan/create.blade.php ENDPATH**/ ?>