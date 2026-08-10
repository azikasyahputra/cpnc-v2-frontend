@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Detail Jurnal Kas</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Buku Kas</a></li>
                              <li><a href="{{URL::route('kas')}}">Semua Jurnal Kas</a></li>
                              <li class="active">Detail Jurnal Kas</li>
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
            <form id="demo-form" class="form-horizontal">
                 @foreach($header as $dataheader)
                {{ csrf_field() }}
                <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                              <input type="text" id="tanggal_transaksi" class="form-control" name="tanggal_transaksi" value="{{$dataheader->tanggal_transaksi}}" readonly />
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
                            @foreach($detail as $datadetail)
                            <tr>
                                <td style="width:300px">
                                    @foreach($referensi as $referensi2)
                                        @if(e($referensi2->id_referensi)==$datadetail->id_referensi)
                                          <input type="text" iid="referensi_{{$i}}" name="referensi_{{$i}}" class="form-control" value="{{e($referensi2->kode_referensi)}} - {{$referensi2->keterangan_referensi}}" readonly />
                                        @endif
                                    @endforeach
                                </td>
                                <td style="width:300px">
                                    <input type="text" id="keterangan_{{$i}}" class="form-control" name="keterangan_{{$i}}" value="{{$datadetail->keterangan}}" readonly />
                                </td>
                                <td>
                                    <input type="text" id="debit_{{$i}}" class="cost form-control text-end" name="debit_{{$i}}" value="<?php if($datadetail->biaya_debit != 0){echo 'Rp. '.number_format($datadetail->biaya_debit,0,'','.');}else{echo $datadetail->biaya_debit;}?>" readonly />
                                </td>
                                <td>
                                    <input type="text" id="kredit_{{$i}}" class="cost2 form-control text-end" name="kredit_{{$i}}" value="<?php if($datadetail->biaya_kredit != 0){echo 'Rp. '.number_format($datadetail->biaya_kredit,0,'','.');}else{echo $datadetail->biaya_kredit;}?>" readonly />
                                </td>
                            </tr>
                            <?php $i++;?>
                            @endforeach
                            <?php $n=$detailcount+1;?>
                            @while ($n<7)
                            <tr>
                                <td style="width:300px">
                                    <input id="referensi_{{$n}}" name="referensi_{{$n}}" class="form-control" value="-" readonly />
                                </td>
                                <td style="width:300px">
                                    <input type="text" id="keterangan_{{$n}}" class="form-control" name="keterangan_{{$n}}" readonly/>
                                </td>
                                <td>
                                    <input type="text" id="debit_{{$n}}" class="cost form-control text-end" name="debit_{{$n}}" readonly/>
                                </td>
                                <td>
                                    <input type="text" id="kredit_{{$n}}" class="cost2 form-control text-end" name="kredit_{{$n}}" readonly/>
                                </td>
                            </tr>
                            <?php $n++;?>
                            @endwhile
                        </tbody>
                    </table>
                </div>
                <br>
                <div class="row">
                     <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                           <label for="total_debit">Total Debit :</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 mb-3 ">
                           <input type="text" id="sum" class="form-control text-end" name="total_debit" value="<?php if($dataheader->total_debit != 0){echo 'Rp. '.number_format($dataheader->total_debit,0,'','.');}else{echo $dataheader->total_debit;}?>" readonly />
                    </div>
                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2 mb-3 ">
                           <label for="total_kredit">Total Kredit :</label>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 mb-3 ">
                           <input type="text" id="sum2" class="form-control text-end" name="total_kredit" value="<?php if($dataheader->total_kredit != 0){echo 'Rp. '.number_format($dataheader->total_kredit,0,'','.');}else{echo $dataheader->total_kredit;}?>" readonly />
                    </div>
                    <div class="col-md-12 col-sm-12 col-12 mb-3 ">
                      <br>
                      <a href="{{URL::route('kasdownloadinvoice',['id'=>$dataheader->id_kas])}}" class="btn btn-success" target="_blank">Print</a>
                      <a href="{{URL::route('kas')}}" class="btn btn-danger">Kembali</a>
                    </div>  
                </div>
                @endforeach
            </form>
        </div>
    </div>
</div>
@endsection
@section('jscript')
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("bukukas");
    element.classList.add("active");
  });
</script>
@endsection