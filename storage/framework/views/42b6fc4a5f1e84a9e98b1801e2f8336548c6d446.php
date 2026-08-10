<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Detail Invoice Trucking</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Invoice Trucking</a></li>
                              <li><a href="<?php echo e(URL::route('invoicetrucking')); ?>">Semua Invoice Trucking</a></li>
                              <li class="active">Detail Invoice Trucking</li>
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
    <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <label for="no_invoice">No.Invoice :</label>
                    <input type="text" id="no_invoice" class="form-control" value="<?php echo e($data->no_invoice); ?>" readonly />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <label for="tanggal_invoice">Tanggal Invoice :</label>
                    <?php $tgl = DateTime::createFromFormat('Y-m-d', $data->tanggal_invoice); ?>
                    <input type="text" id="tanggal_invoice" class="form-control" value="<?php echo e($tgl ? $tgl->format('d/m/Y') : ''); ?>" readonly />
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                    <label for="no_aju">No AJU :</label>
                    <input type="text" id="no_aju" class="form-control" value="<?php echo e($data->no_aju); ?>" readonly />
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                    <label for="nama_client">Customer :</label>
                    <input type="text" id="nama_client" class="form-control" value="<?php echo e($data->nama_client); ?>" readonly />
                </div>
            </div>

            <div class="table-responsive text-nowrap">
                <table class="table table-bordered">
                    <thead style="background-color: #696cff;">
                        <tr>
                            <th class="text-white" style="width:40px;font-size:12px;">No</th>
                            <th class="text-white" style="font-size:12px;">Tanggal</th>
                            <th class="text-white" style="font-size:12px;">Tujuan</th>
                            <th class="text-white" style="font-size:12px;">Party</th>
                            <th class="text-white" style="font-size:12px;">Container</th>
                            <th class="text-white" style="font-size:12px;">Ongkos</th>
                            <th class="text-white" style="font-size:12px;">U.Bongkar</th>
                            <th class="text-white" style="font-size:12px;">Lift Off</th>
                            <th class="text-white" style="font-size:12px;">Tagihan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $tagihan = (int) $row->ongkos + (int) $row->uang_bongkar + (int) $row->lift_off; $total += $tagihan; ?>
                        <tr>
                            <td class="text-center"><?php echo e($index + 1); ?></td>
                            <td><?php echo e($row->tanggal_order); ?></td>
                            <td><?php echo e($row->tujuan); ?></td>
                            <td><?php echo e($row->party); ?></td>
                            <td><?php echo e($row->container); ?></td>
                            <td class="text-end"><?php echo e(number_format((int) $row->ongkos, 0, ',', '.')); ?></td>
                            <td class="text-end"><?php echo e(number_format((int) $row->uang_bongkar, 0, ',', '.')); ?></td>
                            <td class="text-end"><?php echo e(number_format((int) $row->lift_off, 0, ',', '.')); ?></td>
                            <td class="text-end"><?php echo e(number_format($tagihan, 0, ',', '.')); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8" class="text-end fw-bold">TOTAL TAGIHAN</td>
                            <td class="text-end fw-bold"><?php echo e(number_format($total, 0, ',', '.')); ?></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <div class="row mb-3 mt-1">
        <div class="col-md-12 text-end">
            <a href="<?php echo e(URL::route('invoicetruckingdownload', $data->id_invoice_trucking)); ?>" class="btn btn-warning"><i class="bx bx-file me-1"></i>Download PDF</a>
            <a href="<?php echo e(URL::route('invoicetruckingdownloadxlsx', $data->id_invoice_trucking)); ?>" class="btn btn-success"><i class="bx bx-grid-alt me-1"></i>Download Excel</a>
            <a href="<?php echo e(URL::route('invoicetrucking')); ?>" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/invoicetrucking/detail.blade.php ENDPATH**/ ?>