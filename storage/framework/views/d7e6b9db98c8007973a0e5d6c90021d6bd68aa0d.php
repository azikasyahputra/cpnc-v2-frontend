<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Klien</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="<?php echo e(URL::route('klien')); ?>">Master Klien</a></li>
                              <li class="active">Edit Klien</li>
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
            <form action="<?php echo e(URL::route('kliensaveedit')); ?>" method="post" class="form-horizontal">
                <?php echo e(csrf_field()); ?>

                <?php $__currentLoopData = $klien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <input type="hidden" name="id_client" value="<?php echo e($data->id_client); ?>"/>
                
                <div class="card-body ">
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="nama" class=" form-label">Nama *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama" class="form-control" name="nama" value="<?php echo e($data->nama_client); ?>" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="alamat" class=" form-label">Alamat *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><textarea id="alamat" required="required" class="form-control" name="alamat"><?php echo e($data->alamat_client); ?></textarea></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="kota" class=" form-label">Kota *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="kota" class="form-control" name="kota" value="<?php echo e($data->kota_client); ?>" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="kodepos" class=" form-label">Kodepos *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="kodepos" class="form-control" name="kodepos" value="<?php echo e($data->kodepos_client); ?>" required /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(URL::route('klien')); ?>" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/klien/edit.blade.php ENDPATH**/ ?>