<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create Invoice Trucking</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Invoice Trucking</a></li>
                              <li><a href="<?php echo e(URL::route('invoicetrucking')); ?>">Semua Invoice Trucking</a></li>
                              <li class="active">Create Invoice Trucking</li>
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
    <div class="card mb-3">
        <div class="card-body">
            <form action="<?php echo e(URL::route('invoicetruckingsearch')); ?>" method="post">
                <?php echo e(csrf_field()); ?>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                        <label for="no_aju">No AJU* :</label>
                        <input type="text" id="no_aju" class="form-control" name="no_aju" value="<?php echo e($no_aju ?? ''); ?>" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                        <label for="id_client">Customer *:</label>
                        <select id="id_client" name="id_client" class="selectkas form-control" required>
                            <option value="">- Pilih Customer -</option>
                            <?php $__currentLoopData = $klien; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $klien): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($klien->id_client); ?>" <?php if(isset($id_client) && $id_client == $klien->id_client): ?> selected <?php endif; ?>><?php echo e($klien->nama_client); ?></option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <button type="submit" class="btn btn-primary"><i class="bx bx-search me-1"></i>Cari Data</button>
                        <a href="<?php echo e(URL::route('invoicetruckingcreate')); ?>" class="btn btn-outline-secondary"><i class="bx bx-reset me-1"></i>Reset</a>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <?php if(count($rows) > 0 || isset($id_client)): ?>
    <form action="<?php echo e(URL::route('invoicetruckingsave')); ?>" method="post" id="formInvoiceTrucking">
        <?php echo e(csrf_field()); ?>

        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                        <label for="tanggal_invoice">Tanggal Invoice* :</label>
                        <input type="text" id="tanggal_invoice" class="form-control" name="tanggal_invoice" value="<?php echo e($tanggal_invoice ?? date('d/m/Y')); ?>" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3">
                        <label for="nama_client">Customer *:</label>
                        <input type="hidden" name="id_client" value="<?php echo e($id_client ?? ''); ?>" />
                        <input type="hidden" name="no_aju" value="<?php echo e($no_aju ?? ''); ?>" />
                        <input type="text" id="nama_client" class="form-control" value="<?php echo e($namaclient ?? ''); ?>" readonly />
                    </div>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="detailTable">
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
                                <th class="text-white" style="width:110px;font-size:12px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="text-center"><?php echo e($index + 1); ?></td>
                                <td>
                                    <input type="hidden" name="detail[<?php echo e($index); ?>][id_order_trucking]" value="<?php echo e($row->id_order_trucking ?? ''); ?>" />
                                    <?php $tgl = isset($row->tanggal_order) && $row->tanggal_order ? date('d/m/Y', strtotime($row->tanggal_order)) : ''; ?>
                                    <input type="text" name="detail[<?php echo e($index); ?>][tanggal_order]" class="form-control tanggal-order" value="<?php echo e($tgl); ?>" />
                                </td>
                                <td><input type="text" name="detail[<?php echo e($index); ?>][tujuan]" class="form-control" value="<?php echo e($row->tujuan ?? ''); ?>" /></td>
                                <td><input type="text" name="detail[<?php echo e($index); ?>][party]" class="form-control" value="<?php echo e($row->party ?? ''); ?>" /></td>
                                <td><input type="text" name="detail[<?php echo e($index); ?>][container]" class="form-control" value="<?php echo e($row->container ?? ''); ?>" /></td>
                                <td><input type="text" name="detail[<?php echo e($index); ?>][ongkos]" class="form-control text-end angka" value="<?php echo e($row->ongkos ?? 0); ?>" /></td>
                                <td><input type="text" name="detail[<?php echo e($index); ?>][uang_bongkar]" class="form-control text-end angka" value="<?php echo e($row->uang_bongkar ?? 0); ?>" /></td>
                                <td><input type="text" name="detail[<?php echo e($index); ?>][lift_off]" class="form-control text-end angka" value="<?php echo e($row->lift_off ?? 0); ?>" /></td>
                                <td class="text-end tagihan">0</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button type="button" class="btn btn-sm btn-success" title="Tambah baris di sini" onclick="sisipkanBaris(this)"><i class="bx bx-plus"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus baris" onclick="hapusBaris(this)"><i class="bx bx-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">TOTAL TAGIHAN</td>
                                <td class="text-end fw-bold" id="totalOngkos">0</td>
                                <td class="text-end fw-bold" id="totalBongkar">0</td>
                                <td class="text-end fw-bold" id="totalLiftoff">0</td>
                                <td class="text-end fw-bold" id="totalTagihan">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-success" onclick="tambahBaris()"><i class="bx bx-plus me-1"></i>Tambah Baris</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 mt-1">
            <div class="col-md-12 text-end">
                <a href="<?php echo e(URL::route('invoicetrucking')); ?>" class="btn btn-danger">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </div>
    </form>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
    $(document).ready(function() {
        $('.selectkas').select2();
        $('input[name="tanggal_invoice"]').daterangepicker({ singleDatePicker: true, showDropdowns: true });
        hitungSemua();
    });

    function tambahBaris() {
        var table = document.getElementById("detailTable").getElementsByTagName('tbody')[0];
        var row = table.insertRow(-1);
        row.innerHTML = rowHtml();
        initRow(row);
        hitungSemua();
    }

    function sisipkanBaris(btn) {
        var row = btn.closest('tr');
        var baru = document.createElement('tr');
        baru.innerHTML = rowHtml();
        row.parentNode.insertBefore(baru, row.nextSibling);
        initRow(baru);
        hitungSemua();
    }

    function hapusBaris(btn) {
        $(btn).closest('tr').remove();
        hitungSemua();
    }

    function rowHtml() {
        return '<td class="text-center no"></td>' +
            '<td><input type="text" name="detail[#][tanggal_order]" class="form-control tanggal-order" /></td>' +
            '<td><input type="text" name="detail[#][tujuan]" class="form-control" /></td>' +
            '<td><input type="text" name="detail[#][party]" class="form-control" /></td>' +
            '<td><input type="text" name="detail[#][container]" class="form-control" /></td>' +
            '<td><input type="text" name="detail[#][ongkos]" class="form-control text-end angka" value="0" /></td>' +
            '<td><input type="text" name="detail[#][uang_bongkar]" class="form-control text-end angka" value="0" /></td>' +
            '<td><input type="text" name="detail[#][lift_off]" class="form-control text-end angka" value="0" /></td>' +
            '<td class="text-end tagihan">0</td>' +
            '<td class="text-center"><div class="d-flex justify-content-center gap-1">' +
            '<button type="button" class="btn btn-sm btn-success" title="Tambah baris di sini" onclick="sisipkanBaris(this)"><i class="bx bx-plus"></i></button>' +
            '<button type="button" class="btn btn-sm btn-danger" title="Hapus baris" onclick="hapusBaris(this)"><i class="bx bx-trash"></i></button>' +
            '</div></td>';
    }

    function initRow(row) {
        $('.tanggal-order', row).daterangepicker({ singleDatePicker: true, showDropdowns: true, autoUpdateInput: true });
    }

    function renomerBaris() {
        var rows = document.getElementById("detailTable").getElementsByTagName('tbody')[0].rows;
        for (var i = 0; i < rows.length; i++) {
            var inputs = rows[i].getElementsByTagName('input');
            for (var j = 0; j < inputs.length; j++) {
                inputs[j].name = inputs[j].name.replace(/detail\[\d*\]/g, 'detail[' + i + ']');
            }
        }
    }

    function hitungSemua() {
        var rows = document.getElementById("detailTable").getElementsByTagName('tbody')[0].rows;
        renomerBaris();
        var totalOngkos = 0, totalBongkar = 0, totalLiftoff = 0, totalTagihan = 0;
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('input');
            var ongkos = 0, bongkar = 0, liftoff = 0;
            for (var j = 0; j < cells.length; j++) {
                var name = cells[j].name;
                if (name.indexOf('[ongkos]') !== -1) ongkos = parseFloat(cells[j].value) || 0;
                if (name.indexOf('[uang_bongkar]') !== -1) bongkar = parseFloat(cells[j].value) || 0;
                if (name.indexOf('[lift_off]') !== -1) liftoff = parseFloat(cells[j].value) || 0;
            }
            var tagihan = ongkos + bongkar + liftoff;
            rows[i].getElementsByClassName('tagihan')[0].innerText = tagihan.toLocaleString('id-ID');
            rows[i].getElementsByClassName('no')[0].innerText = i + 1;
            totalOngkos += ongkos; totalBongkar += bongkar; totalLiftoff += liftoff; totalTagihan += tagihan;
        }
        document.getElementById("totalOngkos").innerText = totalOngkos.toLocaleString('id-ID');
        document.getElementById("totalBongkar").innerText = totalBongkar.toLocaleString('id-ID');
        document.getElementById("totalLiftoff").innerText = totalLiftoff.toLocaleString('id-ID');
        document.getElementById("totalTagihan").innerText = totalTagihan.toLocaleString('id-ID');
    }

    $(document).on('keyup', '#detailTable .angka', function() {
        hitungSemua();
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/invoicetrucking/create.blade.php ENDPATH**/ ?>