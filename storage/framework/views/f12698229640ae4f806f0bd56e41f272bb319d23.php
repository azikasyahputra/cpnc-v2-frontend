<?php $__env->startSection('breadcumbs'); ?>
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Invoice</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Invoice</a></li>
                              <li><a href="<?php echo e(URL::route('invoice')); ?>">Semua Invoice</a></li>
                              <li class="active">Edit Invoice</li>
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
        <form action="<?php echo e(URL::route('invoicesaveedit')); ?>" method="post">
            <?php echo e(csrf_field()); ?>

            <?php $__currentLoopData = $header; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <input type="hidden" name="id_invoice" value="<?php echo e($header->id_invoice); ?>">
        <div class="card">
            <div class="card-body">
                <div id="order">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label>Kepada Yth,</label>
                                        </div>
                                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label>JAKARTA, </label>
                                            
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <?php
                                                $tanggal_invoice=DateTime::createFromFormat('Y-m-d', $header->tanggal_order);
                                                $tanggal_invoice=$tanggal_invoice->format('m/d/Y');
                                            ?>
                                            <input type="text" id="tanggal_invoice" class="form-control" name="tanggal_invoice" value="<?php echo e($tanggal_invoice); ?>" required />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="nama_client">Nama </label>  
                                        </div>   
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 mb-3 "> 
                                            <input type="text" id="nama_client" class="form-control" name="nama_client" value="<?php echo e($header->nama_client); ?>" readonly />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="alamat_client">Alamat </label>  
                                        </div>   
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 mb-3 "> 
                                            <input type="text" id="alamat_client" class="form-control" name="alamat_client" value="<?php echo e($header->nama_client); ?> <?php echo e($header->kodepos_client); ?>" readonly />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="kota_client">Kota </label>  
                                        </div>   
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 mb-3 "> 
                                            <input type="text" id="kota_client" class="form-control" name="kota_client" value="<?php echo e($header->kota_client); ?>" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="row">
                                        <?php $option2='';$option3='';$option4='';?>
                                        <?php $__currentLoopData = $referensi; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $referensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            if($header->id_pendapatan==e($referensi->id_referensi)){
                                            $option2 .= '<option value="'.e($referensi->id_referensi).'" selected>'.e($referensi->kode_referensi).'</option>';
                                            }else{
                                            $option2 .= '<option value="'.e($referensi->id_referensi).'">'.e($referensi->kode_referensi).'</option>';
                                            }
                                            
                                            if($header->id_piutang==e($referensi->id_referensi)){
                                            $option3 .= '<option value="'.e($referensi->id_referensi).'" selected>'.e($referensi->kode_referensi).'</option>';
                                            }else{
                                            $option3 .= '<option value="'.e($referensi->id_referensi).'">'.e($referensi->kode_referensi).'</option>';
                                            }
                                            
                                            if($header->id_kas==e($referensi->id_referensi)){
                                            $option4 .= '<option value="'.e($referensi->id_referensi).'" selected>'.e($referensi->kode_referensi).'</option>';
                                            }else{
                                            $option4 .= '<option value="'.e($referensi->id_referensi).'">'.e($referensi->kode_referensi).'</option>';
                                            }        
                                        ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="pendapatan">Pendapatan </label>  
                                        </div>   
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <select id="kode_pendapatan" name="kode_pendapatan" class="form-control" required>
                                            <?php echo $option2; ?>

                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <input type="hidden" id="pendapatan" name="pendapatan" value="<?php echo e($header->pendapatan); ?>" required/>
                                            <input type="text" id="show_pendapatan" class="form-control text-end" name="show_pendapatan" value="<?php if($header->pendapatan != 0){echo 'Rp. '.number_format($header->pendapatan,0,'','.');}else{echo $header->pendapatan;}?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="piutang">Piutang </label>  
                                        </div>   
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <select id="kode_piutang" name="kode_piutang" class="form-control" required>
                                                {<?php echo $option3; ?>}
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <input type="hidden" id="piutang" name="piutang" value="<?php echo e($header->piutang); ?>" required/>
                                            <input type="text" id="show_piutang" class="form-control text-end" name="show_piutang" value="<?php if($header->piutang != 0){echo 'Rp. '.number_format($header->piutang,0,'','.');}else{echo $header->piutang;}?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="kas">Kas </label>  
                                        </div>   
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <select id="kode_kas" name="kode_kas" class="form-control" required>
                                                {<?php echo $option4; ?>}
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <input type="hidden" id="kas" name="kas" value="<?php echo e($header->kas); ?>" required/>
                                            <input type="text" id="show_kas" class="form-control text-end" name="show_kas" value="<?php if($header->kas != 0){echo 'Rp. '.number_format($header->kas,0,'','.');}else{echo $header->kas;}?>" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-xs-5">
                                    <div class="row">
                                        <div class="col-lg-3 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                                            <label>INV NO</label>
                                        </div>
                                        <div class="col-lg-9 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <input type="text" class="form-control" value="<?php echo e($header->no_invoice); ?>" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                                            <select id="kode_jenis_invoice" name="kode_jenis_invoice" class="form-control" required>
                                                <option value="BL NO" <?php if($header->kode_jenis_invoice=='BL NO'): ?> selected <?php endif; ?>>BL NO</option>
                                                <option value="AWB NO" <?php if($header->kode_jenis_invoice=='AWB NO'): ?> selected <?php endif; ?>>AWB NO</option>
                                                <option value="INVOICE NO" <?php if($header->kode_jenis_invoice=='INVOICE NO'): ?> selected <?php endif; ?>>INVOICE NO</option>
                                            </select>
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <input type="text" id="no_bl" class="form-control" name="no_bl" value="<?php echo e($header->no_bl); ?>" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <table class="table-bordered">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <td>
                                                <label for="ex_kapal">EX KAPAL</label>
                                            </td>
                                            <td>
                                                <label for="pel_tujuan_negara_asal">PEL.TUJUAN NEGARA ASAL</label>
                                            </td>
                                            <td>
                                                <label for="pelayaran">PELAYARAN</label>
                                            </td>
                                            <td>
                                                <label for="berangkat_tiba">BERANGKAT TIBA</label>
                                            </td>
                                            <td>
                                                <label for="banyaknya_kemasan">BANYAKNYA KEMASAN</label>
                                            </td>
                                            <td>
                                                <label for="nama_barang">NAMA BARANG</label>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <input type="text" id="ex_kapal" class="form-control" name="ex_kapal" value="<?php echo e($header->nama_kapal_pesawat); ?>" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="pel_tujuan_negara_asal" class="form-control" name="pel_tujuan_negara_asal" value="<?php echo e($header->negara_asal_tujuan); ?>" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="pelayaran" class="form-control" name="pelayaran" value="<?php echo e($header->nama_pelayaran); ?>" readonly />
                                            </td>
                                            <td>
                                                <?php
                                                    $tanggal_berangkat=DateTime::createFromFormat('Y-m-d', $header->tanggal_berangkat); 
                                                    $tanggal_berangkat=$tanggal_berangkat->format('d/m/Y');
                                                ?>
                                                <input type="text" id="berangkat_tiba" class="form-control" name="berangkat_tiba" value="<?php echo e($tanggal_berangkat); ?>" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="banyaknya_kemasan" class="form-control" name="banyaknya_kemasan" value="<?php echo e($header->kemasan); ?>" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="nama_barang" class="form-control" name="nama_barang" value="<?php echo e($header->nama_barang); ?>" readonly />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row">
                                <table class="table-bordered">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <td>
                                                <label for="no_kwitansi">KWITANSI NO</label>
                                            </td>
                                            <td colspan="3">
                                                <label for="export_import">EXPORT IMPORT</label>
                                            </td>
                                            <td>
                                                <label for="keterangan">KETERANGAN</label>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1;?>
                                        <?php $__currentLoopData = $detail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detaildata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <input type="hidden" name="id_invoice_dt_<?php echo e($no); ?>" id="id_invoice_dt_<?php echo e($no); ?>" value="<?php echo e($detaildata->id_invoice_dt); ?>" />
                                            <td>
                                                <input type="text" id="no_kwitansi_<?php echo e($no); ?>" class="form-control" name="no_kwitansi_<?php echo e($no); ?>" value="<?php echo e($detaildata->no_kwitansi); ?>" />
                                            </td>
                                            <td style="width:450px">
                                                <select id="biaya_<?php echo e($no); ?>" name="biaya_<?php echo e($no); ?>" class="selectkas form-control" onchange="checkPpn(this.value,this.id)">
                                                    <option value="kosong">-</option>
                                                    <?php $__currentLoopData = $biayadetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biaya2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <?php if($detaildata->id_biaya_detail==$biaya2->id_biaya): ?>
                                                        <option value="<?php echo e($biaya2->id_biaya); ?>" selected><?php echo e($biaya2->nama_biaya); ?></option>
                                                        <?php else: ?>
                                                        <option value="<?php echo e($biaya2->id_biaya); ?>"><?php echo e($biaya2->nama_biaya); ?></option>
                                                        <?php endif; ?>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" id="jumlah_biaya_<?php echo e($no); ?>" class="cost" name="jumlah_biaya_<?php echo e($no); ?>" value="<?php echo e($detaildata->biaya_detail); ?>"/>
                                                <input type="text" id="show_jumlah_biaya_<?php echo e($no); ?>" class="form-control text-end" name="show_jumlah_biaya_<?php echo e($no); ?>" value="<?php if($detaildata->biaya_detail != 0){echo 'Rp. '.number_format($detaildata->biaya_detail,0,'','.');}else{echo $detaildata->biaya_detail;}?>" onkeyup="formatRupiah(event)"/>
                                            </td>
                                            <td style="width:70px">
                                                <div class="text-center" id="ppn_<?php echo e($no); ?>">
                                                    <?php if($detaildata->id_biaya_detail == '30' || $detaildata->id_biaya_detail == '90'){ ?>
                                                        -
                                                    <?php }else{?>
                                                        <select id="check_ppn_<?php echo e($no); ?>" name="check_ppn_<?php echo e($no); ?>" class="form-control" onchange="addPpn(this.value,this.id)">
                                                            <option value="-">-</option>
                                                            <option value="30"  <?php if(!empty($detail[$no])){ if($detail[$no]->id_biaya_detail == '30'){ echo 'selected';}else{ echo '';}}?>>PPN</option>
                                                            <option value="90"  <?php if(!empty($detail[$no])){ if($detail[$no]->id_biaya_detail == '90'){ echo 'selected';}else{ echo '';}}?>>PPN 11%</option>
                                                        </select>
                                                    <?php }?>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" id="keterangan_<?php echo e($no); ?>" class="form-control" name="keterangan_<?php echo e($no); ?>" value="<?php echo e($detaildata->keterangan); ?>"/>
                                            </td>
                                        </tr>
                                        <?php $no++;?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $i=$detailcount+1; ?>
                                        <?php while($i<16): ?>
                                        <tr>
                                            <input type="hidden" name="id_invoice_dt_<?php echo e($i); ?>" id="id_invoice_dt_<?php echo e($i); ?>" value="" />
                                            <td>
                                                <input type="text" id="no_kwitansi_<?php echo e($i); ?>" class="form-control" name="no_kwitansi_<?php echo e($i); ?>" />
                                            </td>
                                            <td style="width:450px">
                                                <select id="biaya_<?php echo e($i); ?>" name="biaya_<?php echo e($i); ?>" class="selectkas form-control" onchange="checkPpn(this.value,this.id)">
                                                    <option value="kosong" selected>-</option>
                                                    <?php $__currentLoopData = $biayadetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $biaya2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($biaya2->id_biaya); ?>"><?php echo e($biaya2->nama_biaya); ?></option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="hidden" id="jumlah_biaya_<?php echo e($i); ?>" class="cost" name="jumlah_biaya_<?php echo e($i); ?>"/>
                                                <input type="text" id="show_jumlah_biaya_<?php echo e($i); ?>" class="form-control text-end" name="show_jumlah_biaya_<?php echo e($i); ?>" onkeyup="formatRupiah(event)"/>
                                            </td>
                                            <td style="width:110px">
                                                <div class="text-center" id="ppn_<?php echo e($i); ?>">
		                                        <select id="check_ppn_<?php echo e($i); ?>" name="check_ppn_<?php echo e($i); ?>" class="form-control" onchange="addPpn(this.value,this.id)">
		                                            <option value="-">-</option>
		                                            <option value="30">PPN</option>
		                                            <option value="90">PPN 11%</option>
		                                        </select>
                                                </div>
                                            </td>
                                            <td>
                                                <input type="text" id="keterangan_<?php echo e($i); ?>" class="form-control" name="keterangan_<?php echo e($i); ?>" />
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                        <?php endwhile; ?>
                                        <tr>
                                            <td colspan="2" style="text-align:right;border:0px!important;">JUMLAH </td>
                                            <input type="hidden" id="sum" name="jumlah_pendapatan" value="<?php echo e($header->jumlah_biaya); ?>" required />
                                            <td><input type="text" id="show_sum" class="form-control text-end" name="show_jumlah_pendapatan" value="<?php if($header->jumlah_biaya != 0){echo 'Rp. '.number_format($header->jumlah_biaya,0,'','.');}else{echo $header->jumlah_biaya;}?>" required /></td>
                                            <td><input type="text" id="keterangan" class="form-control" name="keterangan_pendapatan" value="<?php echo e($header->keterangan_jumlah_biaya); ?>"/></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                                    <label for="terbilang">Terbilang :</label>
                                </div>
                                <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 mb-3 ">
                                    <input type="text" id="terbilang" class="form-control text-end" name="terbilang" value="<?php echo e($header->biaya_terbilang); ?>" required />
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row mb-3 mt-1">
                <div class="col-md-12 text-end">
                    <a href="<?php echo e(URL::route('invoice')); ?>" class="btn btn-danger">Batal</a>
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
        var total = 0;
        var data = document.getElementsByClassName("cost");
        for(var i=0; i< data.length; i++){
            if(data[i].value !== ''){
                total = total + parseInt(data[i].value);
            }
        }
        document.getElementById('sum').value = total;
        formatTotal('show_sum',total);
        document.getElementById('pendapatan').value = total;
        formatTotal('show_pendapatan',total);
        document.getElementById('piutang').value = total;
        formatTotal('show_piutang',total);
        ubah(total.toString());
	}
</script>
<script type="text/javascript">
var now = moment();
$(function() {
    $('input[name="tanggal_invoice"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
</script>
<script>
    function terbilang(bilangan, sufix){
        if(bilangan=="" || bilangan==null || bilangan=="null" || bilangan==undefined){
            return "";
        } else {
            bilangan = bilangan.replace(/[^,\d]/g, '');
            var kalimat="";
            var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
            var kata    = new Array('','SATU','DUA','TIGA','EMPAT','LIMA','ENAM','TUJUH','DELAPAN','SEMBILAN');
            var tingkat = new Array('','RIBU','JUTA','MILYAR','TRILIUN');
            var panjang_bilangan = bilangan.length;
    
            /* pengujian panjang bilangan */
            if(panjang_bilangan > 15){
                kalimat = "Diluar Batas";
            }else{
                /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
                for(i = 1; i <= panjang_bilangan; i++) {
                    angka[i] = bilangan.substr(-(i),1);
                }
    
                var i = 1;
                var j = 0;
    
                /* mulai proses iterasi terhadap array angka */
                while(i <= panjang_bilangan){
                    subkalimat = "";
                    kata1 = "";
                    kata2 = "";
                    kata3 = "";
    
                    /* untuk Ratusan */
                    if(angka[i+2] != "0"){
                        if(angka[i+2] == "1"){
                            kata1 = "SERATUS";
                        }else{
                            kata1 = kata[angka[i+2]] + " RATUS";
                        }
                    }
    
                    /* untuk Puluhan atau Belasan */
                    if(angka[i+1] != "0"){
                        if(angka[i+1] == "1"){
                            if(angka[i] == "0"){
                                kata2 = "SEPULUH";
                            }else if(angka[i] == "1"){
                                kata2 = "SEBELAS";
                            }else{
                                kata2 = kata[angka[i]] + " BELAS";
                            }
                        }else{
                            kata2 = kata[angka[i+1]] + " PULUH";
                        }
                    }
    
                    /* untuk Satuan */
                    if (angka[i] != "0"){
                        if (angka[i+1] != "1"){
                            kata3 = kata[angka[i]];
                        }
                    }
    
                    /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
                    if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")){
                        subkalimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
                    }
    
                    /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
                    kalimat = subkalimat + kalimat;
                    i = i + 3;
                    j = j + 1;
                }
    
                /* mengganti Satu Ribu jadi Seribu jika diperlukan */
                if ((angka[5] == "0") && (angka[6] == "0")){
                    kalimat = kalimat.replace("SATU RIBU","SERIBU");
                }
            }
            return sufix == undefined ? kalimat : kalimat + sufix;
        }
    }
</script>
<script type="text/javascript">
    function ubah(nilai){
        var hasil = terbilang(nilai,'RUPIAH');
        $("#terbilang").val(hasil);
    }
</script>
<script>
    document.addEventListener("DOMContentLoaded",function(event){
        var element = document.getElementById("invoice");
        var element2 = document.getElementById("invoice2");
        var element3 = document.getElementById("invoice3");
        element.classList.add("active");
        element.classList.add("show");
        element2.setAttribute("aria-expanded","true");
        element3.classList.add("show");
        document.getElementById("invoicesemua1").style.color='#03a9f3';
        document.getElementById("invoicesemua2").style.color='#03a9f3';
    });
</script>
<script>
    function checkPpn(nilai, id){
        var idppn = id.replace("biaya","ppn");
        var idcheckppn = id.replace("biaya","check_ppn");
        if(nilai === '30' || nilai === '90'){
            document.getElementById(idppn).innerHTML = '-'; 
        }else{
            document.getElementById(idppn).innerHTML =  '<select id="'+idcheckppn+'" name="'+idcheckppn+'" class="form-control" onchange="addPpn(this.value,this.id)">'+
                                                            '<option value="-">-</option>'+
                                                            '<option value="30">PPN</option>'+
                                                            '<option value="90">PPN 11%</option>'+
                                                        '</select>';
        }
    }

    function addPpn(nilai, id){
        var idppn = document.getElementById(id).parentElement.id;
        var idcount = idppn.split('_');
        var idinvoice           = 'id_invoice_dt_'+(parseInt(idcount[1])+1);
        var idkwitansi          = 'no_kwitansi_'+(parseInt(idcount[1])+1);
        var idbiaya             = 'biaya_'+(parseInt(idcount[1])+1);
        var idmasterbiaya       = 'jumlah_biaya_'+parseInt(idcount[1]);
        var idjumlahbiaya       = 'jumlah_biaya_'+(parseInt(idcount[1])+1);
        var idshowjumlahbiaya   = 'show_jumlah_biaya_'+(parseInt(idcount[1])+1);
        var idppnnew            = 'ppn_'+(parseInt(idcount[1])+1);
        var idketerangan        = 'keterangan_'+(parseInt(idcount[1])+1);

        if(nilai === '30' || nilai === '90'){
            // var bottomvalue = document.getElementById(idbiaya).value;
            // if(bottomvalue !== '' || bottomvalue !== 'kosong'){
            //     let count = parseInt(idcount[1]);
            //     let valuebottom = document.getElementById('biaya_'+count).value;
            //     while(valuebottom !== 'kosong'){
            //         count = count + 1;
            //         valuebottom = document.getElementById('biaya_'+count).value;
            //     }
            // }else{
                document.getElementById(idinvoice).value = '';
                document.getElementById(idkwitansi).value = '';
                $("#"+idbiaya).val(nilai).trigger('change');
                document.getElementById(idjumlahbiaya).value = Math.round(parseInt(document.getElementById(idmasterbiaya).value) * 0.11);
                document.getElementById(idshowjumlahbiaya).value = Math.round(parseInt(document.getElementById(idmasterbiaya).value) * 0.11);
                $('#'+idshowjumlahbiaya).trigger('keyup');
                document.getElementById(idppnnew).innerHTML = '-';
                document.getElementById(idketerangan).value = '';
            // }
        }else{
            document.getElementById(idinvoice).value = '';
            document.getElementById(idkwitansi).value = '';
            $("#"+idbiaya).val('kosong').trigger('change');
            document.getElementById(idjumlahbiaya).value = '';
            document.getElementById(idshowjumlahbiaya).value = '';
            $('#'+idshowjumlahbiaya).trigger('keyup');
            document.getElementById(idppnnew).innerHTML = '-';
            document.getElementById(idketerangan).value = '';
        }
    }
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/azikasyahputra/Documents/Independent/cpnc/resources/views/invoice/edit.blade.php ENDPATH**/ ?>