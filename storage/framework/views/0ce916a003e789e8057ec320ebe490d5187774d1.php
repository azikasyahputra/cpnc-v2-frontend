<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Kasbon Uang Jalan Order Trucking</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Order Trucking</a></li>
                              <li><a href="<?php echo e(URL::route('trucking')); ?>">Semua Order Trucking</a></li>
                              <li class="active">Kasbon Uang Jalan Order Trucking</li>
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
    <?php $__currentLoopData = $trucking; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <form id="demo-form" class="form-horizontal" action="<?php echo e(URL::route('truckingkasbonjalansaveedit')); ?>" method="post">
        <?php echo e(csrf_field()); ?>

    <div class="card">
        <div class="card-body">
                <div class="row">
                    <input type="hidden" name="id_order_trucking" value="<?php echo e($data->id_order_trucking); ?>" />
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="no_invoice">No Invoice* :</label>
                        <input type="text" id="no_invoice" class="form-control" name="no_invoice" value="<?php echo e($data->no_invoice); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="no_aju">No AJU* :</label>
                        <input type="text" id="no_aju" class="form-control" name="no_aju" value="<?php echo e($data->no_aju); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="tanggal_order">Tanggal Order* :</label>
                        <?php $tanggal_order=DateTime::createFromFormat('Y-m-d', $data->tanggal_order); $tanggal_order=$tanggal_order->format('m/d/Y'); ?>
                        <input type="text" id="tanggal_order" class="form-control" name="tanggal_order" value="<?php echo e($tanggal_order); ?>" readonly />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="nama_client">Customer *:</label>
                        <input type="text" id="nama_client" class="form-control" name="nama_client" value="<?php echo e($data->nama_client); ?>" readonly />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="nama_supir">Supir *:</label>
                        <input type="text" id="nama_supir" class="form-control" name="nama_supir" value="<?php echo e($data->nama_supir); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="container">Container* :</label>
                        <input type="text" id="container" class="form-control" name="container" value="<?php echo e($data->container); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="tujuan">Tujuan* :</label>
                        <input type="text" id="tujuan" class="form-control" name="tujuan" value="<?php echo e($data->tujuan); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="kemasan">Kemasan* :</label>
                        <input type="text" id="kemasan" class="form-control" name="kemasan" value="<?php echo e($data->kemasan); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="ongkos">Ongkos* :</label>
                        <input type="text" id="ongkos" class="form-control text-end" name="ongkos" value="<?php echo e($data->ongkos); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="dp">DP* :</label>
                        <input type="text" id="dp" class="form-control text-end" name="dp" value="<?php echo e($data->dp); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="uang_jalan">Uang Jalan* :</label>
                        <input type="text" id="uang_jalan" class="form-control text-end" name="uang_jalan" value="<?php echo e($data->uang_jalan); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="lift_off">Lift Off* :</label>
                        <input type="text" id="lift_off" class="form-control text-end" name="lift_off" value="<?php echo e($data->lift_off); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="uang_bongkar">Uang Bongkar* :</label>
                        <input type="text" id="uang_bongkar" class="form-control text-end" name="uang_bongkar" value="<?php echo e($data->uang_bongkar); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="lain_lain">Lain-lain* :</label>
                        <input type="text" id="lain_lain" class="form-control text-end" name="lain_lain" value="<?php echo e($data->lain_lain); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="komisi_supir">Komisi Supir* :</label>
                        <input type="text" id="komisi_supir" class="form-control text-end" name="komisi_supir" value="<?php echo e($data->komisi_supir); ?>" readonly />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="komisi_kenek">Komisi Kenek* :</label>
                        <input type="text" id="komisi_kenek" class="form-control text-end" name="komisi_kenek" value="<?php echo e($data->komisi_kenek); ?>" readonly />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="laba">Laba* :</label>
                        <input type="text" id="laba" class="form-control text-end" name="laba" value="<?php echo e($data->laba); ?>" readonly />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="uang_kasbon_jalan">Uang Kasbon Jalan* :</label>
                        <input type="text" id="uang_kasbon_jalan" class="form-control text-end" name="uang_kasbon_jalan" required />
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 mt-1">
            <div class="col-md-12 text-end">
              <a href="<?php echo e(URL::route('trucking')); ?>" class="btn btn-danger">Batal</a>
              <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </div>
        </form>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
    $(document).ready(function() {
    $('.selectkas').select2();
});
</script>
<script type="text/javascript">
var now = moment();
$(function() {
    $('input[name="tanggal_order"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
$(function() {
    $('input[name="tanggal_kapal_pesawat"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
$(function() {
    $('input[name="tanggal_status"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
</script>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("ordertrucking");
    var element2 = document.getElementById("ordertrucking2");
    var element3 = document.getElementById("ordertrucking3");
    element.classList.add("active");
    element.classList.add("show");
    element2.setAttribute("aria-expanded","true");
    element3.classList.add("show");
   
    var mystr = document.URL;
    var myarr = mystr.split("/");
    var sorting = myarr[myarr.length-1];
    if(sorting=='belumlunas'){
        document.getElementById("ordertruckingbelumlunas1").style.color='#03a9f3';
        document.getElementById("ordertruckingbelumlunas1").style.color='#03a9f3';
    }else if(sorting=='sudahlunas'){
        document.getElementById("ordertruckinglunas1").style.color='#03a9f3';
        document.getElementById("ordertruckinglunas2").style.color='#03a9f3';
    }else{
        document.getElementById("semuaordertrucking1").style.color='#03a9f3';
        document.getElementById("semuaordertrucking2").style.color='#03a9f3';
    }
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/trucking/uangkasbonjalan.blade.php ENDPATH**/ ?>