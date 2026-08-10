@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create Pengeluaran</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Pengeluaran</a></li>
                              <li><a href="{{URL::route('pengeluaran')}}">Semua Pengeluaran</a></li>
                              <li class="active">Create Pengeluaran</li>
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
                    <form action="{{URL::route('pengeluaransave')}}" method="post">
                        {{ csrf_field() }}
                        @foreach($header as $header)
                        <input type="hidden" name="id_invoice" value="{{$header->id_invoice}}">
                        <input type="hidden" name="id_client" value="{{$header->id_client}}">
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
                                            $tanggal_order=DateTime::createFromFormat('Y-m-d', $header->tanggal_order);
                                            $tanggal_order=$tanggal_order->format('m/d/Y');
                                        ?>
                                        <input type="text" id="tanggal_order" class="form-control" name="tanggal_order" value="{{$tanggal_order}}" required />
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
                                        $option2 .= '<option value="'.e($referensi->id_referensi).' " selected>'.e($referensi->kode_referensi).'</option>';
                                        }else{
                                        $option2 .= '<option value="'.e($referensi->id_referensi).'">'.e($referensi->kode_referensi).'</option>';
                                        }
                                        
                                        if($header->id_piutang==e($referensi->id_referensi)){
                                        $option3 .= '<option value="'.e($referensi->id_referensi).'" selected>'.e($referensi->kode_referensi).'</option>';
                                        }else{
                                        $option3 .= '<option value="'.e($referensi->id_referensi).'">'.e($referensi->kode_referensi).'</option>';
                                        }
                                        
                                        if($header->id_kas==e($referensi->id_referensi)){
                                        $option4 .= '<option value="'.e($referensi->id_referensi).' " selected>'.e($referensi->kode_referensi).'</option>';
                                        }else{
                                        $option4 .= '<option value="'.e($referensi->id_referensi).'">'.e($referensi->kode_referensi).'</option>';
                                        }        
                                    ?>
                                    @endforeach
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                        <label for="pendapatan">Pendapatan </label>  
                                    </div>   
                                    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                        <select id="kode_pendapatan" name="kode_pendapatan" class="form-control" required>
                                        {!! $option2 !!}
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                        <input type="text" id="pendapatan" class="form-control text-end" name="pendapatan" value="0" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                        <label for="piutang">Piutang </label>  
                                    </div>   
                                    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                        <select id="kode_piutang" name="kode_piutang" class="form-control" required>
                                            {!! $option3 !!}
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                        <input type="text" id="piutang" class="form-control text-end" name="piutang" value="0" required />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-4 mb-3 ">
                                        <label for="kas">Kas </label>  
                                    </div>   
                                    <div class="col-lg-5 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                        <select id="kode_kas" name="kode_kas" class="form-control" required>
                                        {!! $option4 !!}
                                        </select>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 mb-3 "> 
                                        <input type="text" id="kas" class="form-control text-end" name="kas" value="0" required />
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
                                        <select id="kode_jenis_invoice" name="kode_jenis_invoice" class="form-control" readonly>
                                            <option value="BL NO" @if($header->kode_jenis_invoice=='BL NO') selected @endif>BL NO</option>
                                            <option value="AWB NO" @if($header->kode_jenis_invoice=='AWB NO') selected @endif>AWB NO</option>
                                            <option value="INVOICE NO" @if($header->kode_jenis_invoice=='INVOICE NO') selected @endif>INVOICE NO</option>
                                        </select>
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
                                            <input type="text" id="ex_kapal" class="form-control" name="ex_kapal" value="{{$header->nama_kapal_pesawat}}" required />
                                        </td>
                                        <td>
                                            <input type="text" id="pel_tujuan_negara_asal" class="form-control" name="pel_tujuan_negara_asal" value="{{$header->negara_asal_tujuan}}" required />
                                        </td>
                                        <td>
                                            <input type="text" id="pelayaran" class="form-control" name="pelayaran" value="{{$header->nama_pelayaran}}" required />
                                        </td>
                                        <td>
                                            <input type="text" id="berangkat_tiba" class="form-control" name="berangkat_tiba" value="{{$header->tanggal_kapal_pesawat}}" required />
                                        </td>
                                        <td>
                                            <input type="text" id="banyaknya_kemasan" class="form-control" name="banyaknya_kemasan" value="{{$header->kemasan}}" required />
                                        </td>
                                        <td>
                                            <input type="text" id="nama_barang" class="form-control" name="nama_barang" value="{{$header->nama_barang}}" required />
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
                                    <input type="hidden" name="id_invoice_dt_{{$no}}" value="{{$detaildata->id_invoice_dt}}" />
                                        <td>
                                            <input type="text" id="no_kwitansi" class="form-control" name="no_kwitansi_{{$no}}" value="{{$detaildata->no_kwitansi}}"/>
                                        </td>
                                        <td style="width:520px">
                                            <select id="biaya_{{$no}}" name="biaya_{{$no}}" class="selectkas form-control">
                                                <option value="kosong">-</option>
                                                @foreach($biayadetail as $biaya2)
                                                    @if($detaildata->id_biaya_detail==$biaya2->id_biaya)
                                                    <option value="{{$biaya2->id_biaya}}" selected>{{$biaya2->nama_biaya}}</option>
                                                    @else
                                                    <option value="{{$biaya2->id_biaya}}">{{$biaya2->nama_biaya}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="jumlah_biaya_{{$no}}" class="cost form-control text-end" name="jumlah_biaya_{{$no}}" value="{{$detaildata->biaya_detail}}"/>
                                        </td>
                                        <td>
                                            <input type="text" id="keterangan_{{$no}}" class="form-control" name="keterangan_{{$no}}" value="{{$detaildata->keterangan}}"/>
                                        </td>
                                    </tr>
                                    <?php $no++;?>
                                    @endforeach
                                    <?php $i=$detailcount+1; ?>
                                    @while ($i<16)
                                    <tr>
                                        <td>
                                            <input type="text" id="no_kwitansi" class="form-control" name="no_kwitansi_{{$i}}" />
                                        </td>
                                        <td style="width:520px">
                                            <select id="biaya_{{$i}}" name="biaya_{{$i}}" class="selectkas form-control">
                                                <option value="kosong" selected>-</option>
                                                @foreach($biayadetail as $biaya2)
                                                    <option value="{{$biaya2->id_biaya}}">{{$biaya2->nama_biaya}}</option>
                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" id="jumlah_biaya_{{$i}}" class="cost form-control text-end" name="jumlah_biaya_{{$i}}" />
                                        </td>
                                        <td>
                                            <input type="text" id="keterangan_{{$i}}" class="form-control" name="keterangan_{{$i}}" />
                                        </td>
                                    </tr>
                                    <?php $i++;?>
                                    @endwhile
                                    <tr>
                                        <td colspan="2" style="text-align:right;border:0px!important;">JUMLAH </td>
                                        <td><input type="text" id="sum" class="form-control text-end" name="jumlah_pendapatan" value="{{$header->jumlah_biaya}}" required /></td>
                                        <td><input type="text" id="keterangan" class="form-control" name="keterangan_pendapatan" value="{{$header->keterangan_jumlah_biaya}}"/></td>
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
                                <input type="text" id="terbilang" class="form-control" name="terbilang" value="{{$header->biaya_terbilang}}" required />
                            </div>
                            <div class="col-md-12 col-sm-12 col-12 mb-3 ">
                                <br>
                                <a href="{{URL::route('invoice')}}" class="btn btn-danger">Batal</a>
                                <input type="submit" value="Simpan" class="btn btn-primary">
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
    $(document).ready(function(){
	$(".cost").each(
		function(){
		$(this).keyup(
			function(){
			calculateSum()
				});
			});
		});
			
		function calculateSum(){
			var sum=0;
			$(".cost").each(
			function(){
                console.log(this.value);
                var vl = this.value.split(',').join('');
                console.log('Replaced: ' + vl);
				if(!isNaN(vl) && vl.length!=0){
					sum+=parseFloat(vl);
					}
				});	
            
			$("#sum").val(sum.toFixed(0));
            $("#pendapatan").val(sum.toFixed(0));
            $("#piutang").val(sum.toFixed(0));
            ubah(sum.toFixed(0));
			}

$(document).ready(function(){
  $('input.cost').keyup(function(event){
      // skip for arrow keys
      if(event.which >= 37 && event.which <= 40){
          event.preventDefault();
      }
      var $this = $(this);
      var num = $this.val().replace(/,/gi, "").split("").reverse().join("");
      
      var num2 = RemoveRougeChar(num.replace(/(.{3})/g,"$1,").split("").reverse().join(""));
      
      console.log(num2);
      
      
      // the following line has been simplified. Revision history contains original.
      $this.val(num2);
  });
});

function RemoveRougeChar(convertString){
    
    
    if(convertString.substring(0,1) == ","){
        
        return convertString.substring(1, convertString.length)            
        
    }
    return convertString;
    
}
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
var daftarAngka=new Array("","SATU","DUA","TIGA","EMPAT","LIMA","ENAM","TUJUH","DELAPAN","SEMBILAN");
function terbilang(nilai){
var temp='';
var hasilBagi,sisaBagi;
//batas untuk ribuan
var batas=3;
//untuk menentukan ukuran array, jumlahnya sesuaikan dengan jumlah anggota dari array gradeNilai[]
var maxBagian = 5;
var gradeNilai=new Array("","RIBU","JUTA","MILYAR","TRILIUN");
//cek apakah ada angka 0 didepan ==> 00098, harus diubah menjadi 98
nilai = this.hapusNolDiDepan(nilai);
var nilaiTemp = ubahStringKeArray(batas, maxBagian, nilai);
//ubah menjadi bentuk terbilang
var j = nilai.length;
//menentukan batas array
var banyakBagian = (j % batas) == 0 ? (j / batas) : Math.round(j / batas + 0.5);
var h=0;
    for(var i = banyakBagian - 1; i >=0; i-- ){
        var nilaiSementara = parseInt(nilaiTemp[h]);
        if (nilaiSementara == 1 && i == 1){ 
            temp +="SERIBU ";
            }
        else {
            temp +=this.ubahRatusanKeHuruf(nilaiTemp[h])+" ";
// cek apakah string bernilai 000, maka jangan tambahkan gradeNilai[i]
            if(nilaiTemp[h] != "000"){
                temp += gradeNilai[i]+" ";
                }
            }
        h++;
        }
return temp;
}
function ubahStringKeArray(batas, maxBagian,kata){
// maksimal 999 milyar
var temp= new Array(maxBagian);
var j = kata.length;
//menentukan batas array
var banyakBagian = (j % batas) == 0 ? (j / batas) : Math.round(j / batas + 0.5);
    for(var i = banyakBagian - 1; i >= 0 ; i--){ 
        var k = j - batas;
        if(k < 0) k = 0;
            temp[i]=kata.substring(k,j);
        j = k ;
        if (j == 0)
        break;
        }
 return temp;
 }
 
 function ubahRatusanKeHuruf(nilai){ 
//maksimal 3 karakter 
var batas = 2;
//membagi string menjadi 2 bagian, misal 123 ==> 1 dan 23
var maxBagian = 2;
var temp = this.ubahStringKeArray(batas, maxBagian, nilai);
var j = nilai.length;
var hasil="";
//menentukan batas array
var banyakBagian = (j % batas) == 0 ? (j / batas) : Math.round(j / batas + 0.5);
    for(var i = 0; i < banyakBagian ;i++){
//cek string yang memiliki panjang lebih dari satu ==> belasan atau puluhan
        if(temp[i].length > 1){
//cek untuk yang bernilai belasan ==> angka pertama 1 dan angka kedua 0 - 9, seperti 11,16 dst
            if(temp[i].charAt(0) == '1'){
                if(temp[i].charAt(1) == '1') {
                    hasil += "SEBELAS";
                    }
                else if(temp[i].charAt(1) == '0') {
                    hasil += "SEPULUH";
                    }
            else hasil += daftarAngka[temp[i].charAt(1) - '0']+ " BELAS ";
                }
 //cek untuk string dengan format angka  pertama 0 ==> 09,05 dst
            else if(temp[i].charAt(0) == '0'){
            hasil += daftarAngka[temp[i].charAt(1) - '0'] ;
            }
 //cek string dengan format selain angka pertama 0 atau 1
            else 
            hasil += daftarAngka[temp[i].charAt(0) - '0']+ " PULUH " +daftarAngka[temp[i].charAt(1) - '0'] ;
            }
        else {
//cek string yang memiliki panjang = 1 dan berada pada posisi ratusan
            if(i == 0 && banyakBagian !=1){
                if (temp[i].charAt(0) == '1') 
                    hasil+=" SERATUS ";
                else if (temp[i].charAt(0) == '0')
                    hasil+=" ";
                else hasil+= daftarAngka[parseInt(temp[i])]+" RATUS ";
            }
//string dengan panjang satu dan tidak berada pada posisi ratusan ==> satuan
            else hasil+= daftarAngka[parseInt(temp[i])];
            }
    }
return hasil;
}
function hapusNolDiDepan(nilai){
while(nilai.indexOf("0") == 0){
    nilai = nilai.substring(1, nilai.length);
    }
return nilai;
}
</script>
<script type="text/javascript">
 function ubah(nilai){
 var hasil = terbilang(nilai);
 $("#terbilang").val(hasil);
 }
</script>
<script>
  document.addEventListener("DOMContentLoaded",function(event){
    var element = document.getElementById("pengeluaran");
    element.classList.add("active");
  });
</script>
@endsection