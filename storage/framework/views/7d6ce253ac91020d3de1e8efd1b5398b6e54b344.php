<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Pelayaran</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="<?php echo e(URL::route('pelayaran')); ?>">Pelayaran</a></li>
                              <li class="active">Edit Pelayaran</li>
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
            <form action="<?php echo e(URL::route('pelayaransaveedit')); ?>" method="post" class="form-horizontal">
            <?php $__currentLoopData = $pelayaran; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id_pelayaran" value="<?php echo e($data->id_pelayaran); ?>"/>    
                <div class="card-body ">
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="pelayaran" class=" form-label">Nama Pelayaran *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="pelayaran" class="form-control" name="pelayaran" value="<?php echo e($data->nama_pelayaran); ?>" required /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(URL::route('pelayaran')); ?>" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/pelayaran/edit.blade.php ENDPATH**/ ?>