@extends('layout.main_layout')
@section('breadcumbs')
<div class="breadcrumbs">
    <div class="breadcrumbs-inner">
        <div class="row m-0">
            <div class="col-sm-4">
                <div class="page-header float-start">
                    <div class="page-title">
                        <h1>Edit Order Trucking</h1>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="page-header float-end">
                    <div class="page-title">
                        <ol class="breadcrumb text-end">
                            <li><a href="#">Order Trucking</a></li>
                            <li><a href="{{URL::route('trucking')}}">Semua Order Trucking</a></li>
                            <li class="active">Edit Order Trucking</li>
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
    @foreach($trucking as $data)
    <form class="form-horizontal" action="{{URL::route('truckingsaveedit')}}" method="post">
        {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
                <div class="row">
                    <input type="hidden" name="id_order_trucking" value="{{$data->id_order_trucking}}" />
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="no_invoice">No Invoice* :</label>
                        <input type="text" id="no_invoice" class="form-control" name="no_invoice" value="{{$data->no_invoice}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="no_aju">No AJU* :</label>
                        <input type="text" id="no_aju" class="form-control" name="no_aju" value="{{$data->no_aju}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="tanggal_order">Tanggal Order* :</label>
                            <?php $tanggal_order=DateTime::createFromFormat('Y-m-d', $data->tanggal_order); $tanggal_order=$tanggal_order->format('Y-m-d'); ?>
                            <input type="text" id="tanggal_order" class="form-control" name="tanggal_order" value="{{$tanggal_order}}" required />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="id_client">Customer *:</label>
                        <select id="id_client" name="id_client" class="selectkas form-control" required>
                            @foreach($klien as $klien)
                            <option value="{{$klien->id_client}}" @if($data->id_client==$klien->id_client) selected @endif>{{$klien->nama_client}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="id_supir">Supir *:</label>
                        <select id="id_supir" name="id_supir" class="selectkas form-control" required>
                            @foreach($supir as $supir)
                            <option value="{{$supir->id_supir}}" @if($data->id_supir==$supir->id_supir) selected @endif>{{$supir->nama_supir}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="container">Container* :</label>
                            <input type="text" id="container" class="form-control" name="container" value="{{$data->container}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="tujuan">Tujuan* :</label>
                            <input type="text" id="tujuan" class="form-control" name="tujuan" value="{{$data->tujuan}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="kemasan">Kemasan* :</label>
                        <input type="text" id="kemasan" class="form-control" name="kemasan" value="{{$data->kemasan}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="ongkos">Ongkos* :</label>
                            <input type="text" id="ongkos" class="form-control text-end" name="ongkos" value="{{$data->ongkos}}" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="dp">DP* :</label>
                        <input type="text" id="dp" class="form-control text-end" name="dp" value="{{$data->dp}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="uang_jalan">Uang Jalan* :</label>
                            <input type="text" id="uang_jalan" class="form-control text-end" name="uang_jalan" value="{{$data->uang_jalan}}" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="lift_off">Lift Off* :</label>
                        <input type="text" id="lift_off" class="form-control text-end" name="lift_off" value="{{$data->lift_off}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="uang_bongkar">Uang Bongkar* :</label>
                            <input type="text" id="uang_bongkar" class="form-control text-end" name="uang_bongkar" value="{{$data->uang_bongkar}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="lain_lain">Lain-lain* :</label>
                        <input type="text" id="lain_lain" class="form-control text-end" name="lain_lain" value="{{$data->lain_lain}}" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="komisi_supir">Komisi Supir* :</label>
                            <input type="text" id="komisi_supir" class="form-control text-end" name="komisi_supir" value="{{$data->komisi_supir}}" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="komisi_kenek">Komisi Kenek* :</label>
                        <input type="text" id="komisi_kenek" class="form-control text-end" name="komisi_kenek" value="{{$data->komisi_kenek}}" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                            <label for="laba">Laba* :</label>
                            <input type="text" id="laba" class="form-control text-end" name="laba" value="{{$data->laba}}" required />
                    </div>
                    @if($data->flag_pengeluaran=='Sudah')
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                            <label for="uang_kasbon_jalan">Uang Kasbon Jalan* :</label>
                            <input type="text" id="uang_kasbon_jalan" class="form-control text-end" name="uang_kasbon_jalan" value="{{$data->kasbon_uang_jalan}}" required />
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mb-3 mt-1">
            <div class="col-md-12 text-end">
              <a href="{{URL::route('trucking')}}" class="btn btn-danger">Batal</a>
              <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </div>
        </form>
        @endforeach
    </div>
@endsection
@section('jscript')
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
        locale: {
            format: 'YYYY-MM-DD'
        }
    });
});
</script>
<script>
   function jumlah() {
    var a = document.getElementById("ongkos").value;
    var b = document.getElementById("uang_jalan").value;
    var c = document.getElementById("komisi_supir").value;
    var d = document.getElementById("komisi_kenek").value;
    if(a==''){var a = 0;}else{var a = parseInt(document.getElementById("ongkos").value);}
    if(b==''){var b = 0;}else{var b = parseInt(document.getElementById("uang_jalan").value);}
    if(c==''){var c = 0;}else{var c = parseInt(document.getElementById("komisi_supir").value);}
    if(d==''){var d = 0;}else{var d = parseInt(document.getElementById("komisi_kenek").value);}
    
    var total = a - (b+c+d);
    document.getElementById("laba").value = total;
  }
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
@endsection