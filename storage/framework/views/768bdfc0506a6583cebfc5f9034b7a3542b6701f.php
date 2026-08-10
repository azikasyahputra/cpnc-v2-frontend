<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Laporan Neraca</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Laporan Keuangan</a></li>
                              <li class="active">Laporan Neraca</li>
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
        <div class="card-body">
            <form action="<?php echo e(URL::route('downloadlaporanneraca')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="tanggal_awal">Tanggal Awal* :</label>
                        <input type="text" id="tanggal_awal" class="form-control" name="tanggal_awal" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="tanggal_akhir">Tanggal Akhir* :</label>
                        <input type="text" id="tanggal_akhir" class="form-control" name="tanggal_akhir" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <input type="submit" name="download" value="Download Excel" class="btn btn-success">
                        <input type="submit" name="download" value="Download PDF" class="btn btn-warning">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
    $(function() {
    $('input[name="tanggal_awal"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
$(function() {
    $('input[name="tanggal_akhir"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/laporankeuangan/indexlaporanneraca.blade.php ENDPATH**/ ?>