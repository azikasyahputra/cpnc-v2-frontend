<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Jurnal Kas</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Buku Kas</a></li>
                              <li><a href="<?php echo e(URL::route('kas')); ?>">Semua Jurnal Kas</a></li>
                              <li class="active">Edit Jurnal Kas</li>
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
    <form id="demo-form" class="form-horizontal" action="<?php echo e(URL::route('kassaveedit')); ?>" method="post">
        <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dataheader): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo e(csrf_field()); ?>

        <input type="hidden" value="<?php echo e($dataheader->id_kas); ?>" name="id_kas">
    <div class="card">
        <div class="card-body">
                <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                              <input type="text" id="tanggal_transaksi" class="form-control" name="tanggal_transaksi" />
                        </div>
                         
                </div>
                <div class="row">
                    <table class="table-bordered">
                        <thead>
                            <tr style="text-align:center;">
                                <td>
                                    <label for="Kode">Kode</label>
                                </td>
                                <td>
                                    <label for="Keterangan">Keterangan</label>
                                </td>
                                <td>
                                    <label for="Debit">Debit</label>
                                </td>
                                <td>
                                    <label for="Kredit">Kredit</label>
                                </td>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; ?>
                            <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $datadetail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <input type="hidden" value="<?php echo e($datadetail->id_kas_dt); ?>" name="id_kas_dt_<?php echo e($i); ?>">
                                <td style="width:300px">
                                    <select id="referensi_<?php echo e($i); ?>" name="referensi_<?php echo e($i); ?>" class="selectkas form-control">
                                        <option value="kosong">-</option>
                                         <?php $__currentLoopData = $referensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referensi2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(e($referensi2->id_referensi)); ?>" <?php if(e($referensi2->id_referensi)==$datadetail->id_referensi): ?> selected <?php endif; ?>><?php echo e(e($referensi2->kode_referensi)); ?> - <?php echo e($referensi2->keterangan_referensi); ?></option>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td style="width:300px">
                                    <input type="text" id="keterangan_<?php echo e($i); ?>" class="form-control" name="keterangan_<?php echo e($i); ?>" value="<?php echo e($datadetail->keterangan); ?>" />
                                </td>
                                <td>
                                    <input type="hidden" id="debit_<?php echo e($i); ?>" class="cost" name="debit_<?php echo e($i); ?>" value="<?php echo e($datadetail->biaya_debit); ?>"/>
                                    <input type="text" id="show_debit_<?php echo e($i); ?>" class="form-control text-end" name="show_debit_<?php echo e($i); ?>" value="<?php if($datadetail->biaya_debit != 0){echo 'Rp. '.number_format($datadetail->biaya_debit,0,'','.');}else{echo $datadetail->biaya_debit;}?>" onkeyup="formatRupiah(event)"/>
                                </td>
                                <td>
                                    <input type="hidden" id="kredit_<?php echo e($i); ?>" class="cost2" name="kredit_<?php echo e($i); ?>" value="<?php echo e($datadetail->biaya_kredit); ?>"/>
                                    <input type="text" id="show_kredit_<?php echo e($i); ?>" class="form-control text-end" name="show_kredit_<?php echo e($i); ?>" value="<?php if($datadetail->biaya_kredit != 0){echo 'Rp. '.number_format($datadetail->biaya_kredit,0,'','.');}else{echo $datadetail->biaya_kredit;}?>" onkeyup="formatRupiah(event)"/>
                                </td>
                            </tr>
                            <?php $i++;?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php $n=$detailcount+1;?>
                            <?php while($n<7): ?>
                            <tr>
                                <input type="hidden" value="" name="id_kas_dt_<?php echo e($n); ?>">
                                <td style="width:300px">
                                    <select id="referensi_<?php echo e($n); ?>" name="referensi_<?php echo e($n); ?>" class="selectkas form-control">
                                        <option value="kosong" selected>-</option>
                                         <?php $__currentLoopData = $referensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referensi2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e(e($referensi2->id_referensi)); ?>"><?php echo e(e($referensi2->kode_referensi)); ?> - <?php echo e($referensi2->keterangan_referensi); ?></option>
                                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </td>
                                <td style="width:300px">
                                    <input type="text" id="keterangan_<?php echo e($n); ?>" class="form-control" name="keterangan_<?php echo e($n); ?>"/>
                                </td>
                                <td>
                                    <input type="text" id="debit_<?php echo e($n); ?>" class="cost form-control text-end" name="debit_<?php echo e($n); ?>"/>
                                </td>
                                <td>
                                    <input type="text" id="kredit_<?php echo e($n); ?>" class="cost2 form-control text-end" name="kredit_<?php echo e($n); ?>"/>
                                </td>
                            </tr>
                            <?php $n++;?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                           <label for="total_debit">Total Debit :</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 mb-3 ">
                           <input type="hidden" id="sum" name="total_debit" value="<?php echo e($dataheader->total_debit); ?>" required />
                           <input type="text" id="show_sum" class="form-control text-end" name="show_total_debit" value="<?php if($dataheader->total_debit != 0){echo 'Rp. '.number_format($dataheader->total_debit,0,'','.');}else{echo $dataheader->total_debit;}?>" required readOnly/>
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                           <label for="total_kredit">Total Kredit :</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 mb-3 ">
                           <input type="hidden" id="sum2" name="total_kredit" value="<?php echo e($dataheader->total_kredit); ?>" required />
                           <input type="text" id="show_sum2" class="form-control text-end" name="show_total_kredit" value="<?php if($dataheader->total_kredit != 0){echo 'Rp. '.number_format($dataheader->total_kredit,0,'','.');}else{echo $dataheader->total_kredit;}?>" required readOnly />
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3 mt-1">
            <div class="col-md-12 text-end">
              <a href="<?php echo e(URL::route('kas')); ?>" class="btn btn-danger">Batal</a>
              <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </form>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('jscript'); ?>
<script>
    $(document).ready(function() {
        $('.selectkas').select2();
    });

    function formatRupiah(e){
        var prefix = "Rp"
        var angka = e.target.value;
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;

        if(number_string === ''){
            e.target.value = '';
        }else if(parseInt(number_string) <= '0' ){
            e.target.value = 0;
        }else{
            e.target.value = prefix+'. '+rupiah;
        }

        var idnilai = e.target.id.replace("show_","");
        document.getElementById(idnilai).value = number_string;

        calculateSum(idnilai);
    }

    function formatTotal(id,nilai){
        var prefix = "Rp"
        var angka = nilai.toString();
        var number_string = angka.replace(/[^,\d]/g, "").toString(),
        split = number_string.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);
        
        if (ribuan) {
            separator = sisa ? "." : "";
            rupiah += separator + ribuan.join(".");
        }
        
        rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;

        if(number_string === ''){
            document.getElementById(id).value = '';
        }else if(parseInt(number_string) <= '0' ){
            document.getElementById(id).value = 0;
        }else{
            document.getElementById(id).value = prefix+'. '+rupiah;
        }
    }

    function calculateSum(id){
        if(id.includes('debit')){
            var total = 0;
            var data = document.getElementsByClassName("cost");
            for(var i=0; i< data.length; i++){
                if(data[i].value !== ''){
                    total = total + parseInt(data[i].value);
                }
            }
            document.getElementById('sum').value = total;
            formatTotal('show_sum',total);
        }else if(id.includes('kredit')){
            var total = 0;
            var data = document.getElementsByClassName("cost2");
            for(var i=0; i< data.length; i++){
                if(data[i].value !== ''){
                    total = total + parseInt(data[i].value);
                }
            }
            document.getElementById('sum2').value = total;
            formatTotal('show_sum2',total);
        }else{
            return false;
        }
       
	}
</script>
<script type="text/javascript">
    var now = moment();
    $(function() {
        $('input[name="tanggal_transaksi"]').daterangepicker({
            singleDatePicker: true,
            showDropdowns: true,
        });
    });
</script>
<script>
    document.addEventListener("DOMContentLoaded",function(event){
        var element = document.getElementById("bukukas");
        element.classList.add("active");
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/bukukas/edit.blade.php ENDPATH**/ ?>