@extends('layout.main_layout')
@section('breadcumbs')
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
                              <li><a href="{{URL::route('invoice')}}">Semua Invoice</a></li>
                              <li class="active">Edit Invoice</li>
                          </ol>
                      </div>
                  </div>
              </div>
          </div>
      </div>
    </div>
@endsection
@section('content')
<div class="col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
                <div id="order">
                    <div class="card-body">
                        <form action="{{URL::route('invoicesaveedit')}}" method="post">
                            {{ csrf_field() }}
                            @foreach($header as $header)
                            <input type="hidden" name="id_invoice" value="{{$header->id_invoice}}">
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
                                            <input type="text" id="tanggal_invoice" class="form-control" name="tanggal_invoice" value="{{$tanggal_invoice}}" readonly />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="nama_client">Nama </label>  
                                        </div>   
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 mb-3 "> 
                                            <input type="text" id="nama_client" class="form-control" name="nama_client" value="{{$header->nama_client}}" readonly />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="alamat_client">Alamat </label>  
                                        </div>   
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 mb-3 "> 
                                            <input type="text" id="alamat_client" class="form-control" name="alamat_client" value="{{$header->nama_client}} {{$header->kodepos_client}}" readonly />
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="kota_client">Kota </label>  
                                        </div>   
                                        <div class="col-lg-9 col-md-8 col-sm-8 col-xs-8 mb-3 "> 
                                            <input type="text" id="kota_client" class="form-control" name="kota_client" value="{{$header->kota_client}}" readonly />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <div class="row">
                                        <?php $option2='';$option3='';$option4='';?>
                                        @foreach($referensi as $referensi)
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
                                        @endforeach
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="pendapatan">Pendapatan </label>  
                                        </div>   
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <select id="kode_pendapatan" name="kode_pendapatan" class="form-control" readonly>
                                            {!! $option2 !!}
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <input type="text" id="pendapatan" class="form-control text-end" name="pendapatan" value="<?php if($header->pendapatan != 0){echo 'Rp. '.number_format($header->pendapatan,0,'','.');}else{echo $header->pendapatan;}?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="piutang">Piutang </label>  
                                        </div>   
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <select id="kode_piutang" name="kode_piutang" class="form-control" readonly>
                                                {{!! $option3 !!}}
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <input type="text" id="piutang" class="form-control text-end" name="piutang" value="<?php if($header->piutang != 0){echo 'Rp. '.number_format($header->piutang,0,'','.');}else{echo $header->piutang;}?>" readonly />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <label for="kas">Kas </label>  
                                        </div>   
                                        <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <select id="kode_kas" name="kode_kas" class="form-control" readonly>
                                                {{!! $option4 !!}}
                                            </select>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                            <input type="text" id="kas" class="form-control text-end" name="kas" value="<?php if($header->kas != 0){echo 'Rp. '.number_format($header->kas,0,'','.');}else{echo $header->kas;}?>" readonly />
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
                                            <input type="text" class="form-control" value="{{$header->no_invoice}}" readonly/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-xs-7">
                                    <div class="row">
                                        <div class="col-lg-5 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                                            <input type="text" id="kode_jenis_invoice" class="form-control" name="kode_jenis_invoice" value="{{$header->kode_jenis_invoice}}" readonly />
                                        </div>
                                        <div class="col-lg-6 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                            <input type="text" id="no_bl" class="form-control" name="no_bl" value="{{$header->no_bl}}" readonly />
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
                                                <input type="text" id="ex_kapal" class="form-control" name="ex_kapal" value="{{$header->nama_kapal_pesawat}}" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="pel_tujuan_negara_asal" class="form-control" name="pel_tujuan_negara_asal" value="{{$header->negara_asal_tujuan}}" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="pelayaran" class="form-control" name="pelayaran" value="{{$header->nama_pelayaran}}" readonly />
                                            </td>
                                            <td>
                                                <?php
                                                    $tanggal_berangkat=DateTime::createFromFormat('Y-m-d', $header->tanggal_berangkat); 
                                                    $tanggal_berangkat=$tanggal_berangkat->format('d/m/Y');
                                                ?>
                                                <input type="text" id="berangkat_tiba" class="form-control" name="berangkat_tiba" value="{{$tanggal_berangkat}}" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="banyaknya_kemasan" class="form-control" name="banyaknya_kemasan" value="{{$header->kemasan}}" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="nama_barang" class="form-control" name="nama_barang" value="{{$header->nama_barang}}" readonly />
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
                                            <td colspan="2">
                                                <label for="export_import">EXPORT IMPORT</label>
                                            </td>
                                            <td>
                                                <label for="keterangan">KETERANGAN</label>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no=1; ?>
                                        @foreach($detail as $detaildata)
                                        <tr>
                                            <td>
                                                <input type="text" id="no_kwitansi" class="form-control" name="no_kwitansi_{{$no}}" value="{{$detaildata->no_kwitansi}}" readonly/>
                                            </td>
                                            <td style="width:520px">
                                                    @foreach($biayadetail as $biaya2)
                                                        @if($detaildata->id_biaya_detail==$biaya2->id_biaya)
                                                        <input type="text" id="biaya_{{$no}}" name="biaya_{{$no}}" class="form-control" value="{{$biaya2->nama_biaya}}" readonly/>
                                                        @endif
                                                    @endforeach
                                            </td>
                                            <td>
                                                <input type="text" id="jumlah_biaya_{{$no}}" class="form-control text-end" style="text-align:right" name="jumlah_biaya_{{$no}}" value="<?php if($detaildata->biaya_detail != 0){echo 'Rp. '.number_format($detaildata->biaya_detail,0,'','.');}else{echo $detaildata->biaya_detail;}?>" readonly/>
                                            </td>
                                            <td>
                                                <input type="text" id="keterangan_{{$no}}" class="form-control" name="keterangan_{{$no}}" value="{{$detaildata->keterangan}}" readonly/>
                                            </td>
                                        </tr>
                                        <?php $no++;?>
                                        @endforeach
                                        <?php $i=$detailcount+1; ?>
                                        @while ($i<16)
                                        <tr>
                                            <td>
                                                <input type="text" id="no_kwitansi" class="form-control" name="no_kwitansi_{{$i}}" readonly/>
                                            </td>
                                            <td style="width:520px">
                                                <input id="biaya_{{$i}}" name="biaya_{{$i}}" class="form-control" value="-" readonly />
                                            </td>
                                            <td>
                                                <input type="text" id="jumlah_biaya_{{$i}}" class="cost form-control text-end" name="jumlah_biaya_{{$i}}" readonly/>
                                            </td>
                                            <td>
                                                <input type="text" id="keterangan_{{$i}}" class="form-control" name="keterangan_{{$i}}" readonly/>
                                            </td>
                                        </tr>
                                        <?php $i++;?>
                                        @endwhile
                                        <tr>
                                            <td colspan="2" style="text-align:right;border:0px!important;">JUMLAH </td>
                                            <td><input type="text" id="sum" class="form-control text-end" name="jumlah_pendapatan" value="<?php if($header->jumlah_biaya != 0){echo 'Rp. '.number_format($header->jumlah_biaya,0,'','.');}else{echo $header->jumlah_biaya;}?>" readOnly /></td>
                                            <td><input type="text" id="keterangan" class="form-control" name="keterangan_pendapatan" value="{{$header->keterangan_jumlah_biaya}}" readonly/></td>
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
                                    <input type="text" id="terbilang" class="form-control" name="terbilang" value="{{$header->biaya_terbilang}}" readonly />
                                </div>
                                <div class="col-md-12 col-sm-12 col-12 mb-3 ">
                                    <br>
                                    <a href="{{URL::route('downloadinvoice',['id'=>$header->id_invoice])}}" class="btn btn-success" target="_blank">Print</a>
                                    <a href="{{URL::route('downloadkwitansi',['id'=>$header->id_invoice])}}" class="btn btn-primary" target="_blank">Print Kwitansi</a>
                                    <a href="{{URL::route('invoice')}}" class="btn btn-danger">Kembali</a>
                                </div>   
                            </div>
                            @endforeach
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('jscript')
<script>
    $(document).ready(function() {
    $('.selectkas').select2();
});
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
@endsection
