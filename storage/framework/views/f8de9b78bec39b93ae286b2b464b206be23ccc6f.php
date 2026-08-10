<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Daftar Referensi</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="<?php echo e(URL::route('daftarreferensi')); ?>">Daftar Referensi</a></li>
                              <li class="active">Edit Daftar Referensi</li>
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
            <form action="<?php echo e(URL::route('daftarreferensisaveedit')); ?>" method="post" class="form-horizontal">
                <?php $__currentLoopData = $referensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card-body ">
                <?php echo e(csrf_field()); ?>

                <input type="hidden" name="id_referensi" value="<?php echo e($data->id_referensi); ?>"/>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="kode_referensi" class=" form-label">Kode Referensi *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="kode_referensi" class="form-control" name="kode_referensi" value="<?php echo e($data->kode_referensi); ?>" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="keterangan_referensi" class=" form-label">Keterangan Referensi *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="keterangan_referensi" class="form-control" name="keterangan_referensi" value="<?php echo e($data->keterangan_referensi); ?>" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="flag_buku_kas" class=" form-label">Buku Kas *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9">
                            <select id="flag_buku_kas" name="flag_buku_kas" class="form-control" required>
                                <option value="Kas" <?php if($data->flag_buku_kas=='Kas'): ?> selected <?php endif; ?> >Kas</option>
                                <option value="Bank" <?php if($data->flag_buku_kas=='Bank'): ?> selected <?php endif; ?> >Bank</option>
                                <option value="Piutang" <?php if($data->flag_buku_kas=='Piutang'): ?> selected <?php endif; ?>>Piutang</option>
                                <option value="Pendapatan Jasa" <?php if($data->flag_buku_kas=='Pendapatan Jasa'): ?> selected <?php endif; ?>>Pendapatan Jasa</option>
                                <option value="Pendapatan Operasional" <?php if($data->flag_buku_kas=='Pendapatan Operasional'): ?> selected <?php endif; ?>>Pendapatan Operasional</option>
                                <option value="Pendapatan Trucking" <?php if($data->flag_buku_kas=='Pendapatan Trucking'): ?> selected <?php endif; ?>>Pendapatan Trucking</option>
                                <option value="Biaya" <?php if($data->flag_buku_kas=='Biaya'): ?> selected <?php endif; ?>>Biaya</option>
                                <option value="Penghasilan Luar Usaha" <?php if($data->flag_buku_kas=='Penghasilan Luar Usaha'): ?> selected <?php endif; ?>>Penghasilan Luar Usaha</option>
                                <option value="Biaya Luar Usaha" <?php if($data->flag_buku_kas=='Biaya Luar Usaha'): ?> selected <?php endif; ?>>Biaya Luar Usaha</option>
                                <option value="Aktiva Tetap" <?php if($data->flag_buku_kas=='Aktiva Tetap'): ?> selected <?php endif; ?>>Aktiva Tetap</option>
                                <option value="Kewajiban" <?php if($data->flag_buku_kas=='Kewajiban'): ?> selected <?php endif; ?>>Kewajiban</option>
                                <option value="Ekuitas" <?php if($data->flag_buku_kas=='Ekuitas'): ?> selected <?php endif; ?>>Ekuitas</option>
                                <option value="Lain-lain" <?php if($data->flag_buku_kas=='Lain-lain'): ?> selected <?php endif; ?>>Lain-lain</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?php echo e(URL::route('daftarreferensi')); ?>" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/daftarreferensi/edit.blade.php ENDPATH**/ ?>