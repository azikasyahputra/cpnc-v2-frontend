<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-primary"><i class="bx bx-shopping-bag"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Order Hari Ini</p>
                            <h5 class="mb-0"><?php echo e($ordertoday); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-primary"><i class="bx bx-cart"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Order Bulan Ini</p>
                            <h5 class="mb-0"><?php echo e($ordermonth); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-file"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Invoice Hari Ini</p>
                            <h5 class="mb-0"><?php echo e($invoicetoday); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-file-blank"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Invoice Bulan Ini</p>
                            <h5 class="mb-0"><?php echo e($invoicemonth); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-wallet"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Laba/Rugi Order Hari Ini</p>
                            <h5 class="mb-0">Rp. <?php echo e(number_format($labatoday,0,'','.')); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-credit-card"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Laba/Rugi Order Bulan Ini</p>
                            <h5 class="mb-0">Rp. <?php echo e(number_format($labamonth,0,'','.')); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-warning"><i class="bx bx-money"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Biaya Keuangan Rugi/Laba Bulan Ini</p>
                            <h5 class="mb-0">Rp. <?php echo e(number_format($biayamonth,0,'','.')); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-danger"><i class="bx bx-line-chart"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Pendapatan Keuangan Rugi/Laba Bulan Ini</p>
                            <h5 class="mb-0">Rp. <?php echo e(number_format($lababrutomonth,0,'','.')); ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("dashboard");
    element.classList.add("active");
  })
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/dashboard/dashboard.blade.php ENDPATH**/ ?>