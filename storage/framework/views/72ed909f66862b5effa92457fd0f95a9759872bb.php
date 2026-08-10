<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Detail Order</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Order</a></li>
                              <li><a href="<?php echo e(URL::route('order')); ?>">Semua Order</a></li>
                              <li class="active">Detail Order</li>
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
                <div id="order">
                    <div class="card-body">
                        <form>
                        <?php $__currentLoopData = $order; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php echo e(csrf_field()); ?>

                            <input type="hidden" name="id_order" value="<?php echo e($data->id_order); ?>" />
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="no_aju">No AJU* :</label>
                                    <input type="text" id="no_aju" class="form-control" name="no_aju" value="<?php echo e($data->no_aju); ?>" readonly />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="tanggal_order">Tanggal Order* :</label>
                                    <?php $tanggal_order=DateTime::createFromFormat('Y-m-d', $data->tanggal_order); $tanggal_order=$tanggal_order->format('d/m/Y'); ?>
                                    <input type="text" id="tanggal_order" class="form-control" name="tanggal_order" value="<?php echo e($tanggal_order); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_client">Customer *:</label>
                                    <input type="text" id="nama_client" class="form-control" name="nama_client" value="<?php echo e($data->nama_client); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="kemasan">Kemasan* :</label>
                                    <input type="text" id="kemasan" class="form-control" name="kemasan" value="<?php echo e($data->kemasan); ?>" readonly/>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="no_container">No.Container* :</label>
                                    <input type="text" id="no_container" class="form-control" name="no_container" value="<?php echo e($data->no_container); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_jenis_dokumen">Jenis Dokumen* :</label>
                                    <input type="text" id="nama_dokumen" class="form-control" name="nama_dokumen" value="<?php echo e($data->nama_dokumen); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="nama_kapal_pesawat">Kapal/Pesawat* :</label>
                                    <input type="text" id="nama_kapal_pesawat" class="form-control" name="nama_kapal_pesawat" value="<?php echo e($data->nama_kapal_pesawat); ?>" readonly />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="tanggal_kapal_pesawat">Tanggal* :</label>
                                    <?php $tanggal_kapal_pesawat=DateTime::createFromFormat('Y-m-d', $data->tanggal_kapal_pesawat); $tanggal_kapal_pesawat=$tanggal_kapal_pesawat->format('d/m/Y'); ?>
                                    <input type="text" id="tanggal_kapal_pesawat" class="form-control" name="tanggal_kapal_pesawat" value="<?php echo e($tanggal_kapal_pesawat); ?>" readonly />
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_pelayaran">Pelayaran *:</label>
                                    <input type="text" id="nama_pelayaran" class="form-control" name="nama_pelayaran" value="<?php echo e($data->nama_pelayaran); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_lapangan">Lapangan *:</label>
                                    <input type="text" id="nama_lapangan" class="form-control" name="nama_lapangan" value="<?php echo e($data->nama_lapangan); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_gudang">Gudang *:</label>
                                    <select id="id_gudang" name="id_gudang" class="selectkas form-control" required>
                                    <input type="text" id="nama_gudang" class="form-control" name="nama_gudang" value="<?php echo e($data->nama_gudang); ?>" readonly />
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="nama_barang">Nama Barang* :</label>
                                    <input type="text" id="nama_barang" class="form-control" name="nama_barang" value="<?php echo e($data->nama_barang); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="nama_bl">BL* :</label>
                                    <input type="text" id="nama_bl" class="form-control" name="nama_bl" value="<?php echo e($data->nama_bl); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="nama_pos">Pos* :</label>
                                    <input type="text" id="nama_pos" class="form-control" name="nama_pos" value="<?php echo e($data->nama_pos); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_kosongan">Kosongan *:</label>
                                    <input type="text" id="nama_kosongan" class="form-control" name="nama_kosongan" value="<?php echo e($data->nama_kosongan); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="id_status">Status* :</label>
                                    <input type="text" id="nama_status" class="form-control" name="nama_status" value="<?php echo e($data->nama_status); ?>" readonly />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="tanggal_status">Tanggal* :</label>
                                    <?php $tanggal_status=DateTime::createFromFormat('Y-m-d', $data->tanggal_status); $tanggal_status=$tanggal_status->format('d/m/Y'); ?>
                                    <input type="text" id="tanggal_status" class="form-control" name="tanggal_status" value="<?php echo e($tanggal_status); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="negara_asal">Negara Asal/Tujuan* :</label>
                                    <input type="text" id="negara_asal_tujuan" class="form-control" name="negara_asal_tujuan" value="<?php echo e($data->negara_asal_tujuan); ?>" readonly />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 mb-3 ">
                                    <a href="<?php echo e(URL::route('orderedit',['id'=>$data->id_order])); ?>" class="btn btn-warning">Edit</a>
                                    <a href="<?php echo e(URL::route('order')); ?>" class="btn btn-danger">Batal</a>
                                </div>  
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
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
            "locale":{
            "format":"DD/MM/YYYY"
            },
        });
    });

    $(function() {
        $('input[name="tanggal_kapal_pesawat"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            "locale":{
            "format":"DD/MM/YYYY"
            },
        });
    });

    $(function() {
        $('input[name="tanggal_status"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
            "locale":{
            "format":"DD/MM/YYYY"
            },
        });
    });
</script>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("order");
    var element2 = document.getElementById("order2");
    var element3 = document.getElementById("order3");
    element.classList.add("active");
    element.classList.add("show");
    element2.setAttribute("aria-expanded","true");
    element3.classList.add("show");
    document.getElementById("ordersemua1").style.color='#03a9f3';
    document.getElementById("ordersemua2").style.color='#03a9f3';
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/order/detail.blade.php ENDPATH**/ ?>