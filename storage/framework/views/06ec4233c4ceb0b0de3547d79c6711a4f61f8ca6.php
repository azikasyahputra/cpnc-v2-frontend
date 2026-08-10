<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Supir</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="<?php echo e(URL::route('supir')); ?>">Supir</a></li>
                              <li class="active">Edit Supir</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="col-md-12 col-sm-12 col-12">
        <div class="card">
            <form action="<?php echo e(URL::route('supirsaveedit')); ?>" method="post" class="form-horizontal">
            <?php $__currentLoopData = $supir; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card-body ">
                    <?php echo e(csrf_field()); ?>

                    <input type="hidden" name="id_supir" value="<?php echo e($data->id_supir); ?>"/>    
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="supir" class=" form-label">Nama Supir *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="supir" class="form-control" name="supir" value="<?php echo e($data->nama_supir); ?>" required /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(URL::route('supir')); ?>" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/supir/edit.blade.php ENDPATH**/ ?>