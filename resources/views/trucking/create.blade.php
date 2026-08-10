@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create Order Trucking</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Order Trucking</a></li>
                              <li><a href="{{URL::route('trucking')}}">Semua Order Trucking</a></li>
                              <li class="active">Create Order Trucking</li>
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
    <form class="form-horizontal" action="{{URL::route('truckingsave')}}" method="post">
        {{ csrf_field() }}
    <div class="card">
        <div class="card-body">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                            <label for="no_invoice">No Invoice* :</label>
                            <input type="text" id="no_invoice" class="form-control" name="no_invoice" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="no_aju">No AJU* :</label>
                            <input type="text" id="no_aju" class="form-control" name="no_aju" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                            <label for="tanggal_order">Tanggal Order* :</label>
                            <input type="text" id="tanggal_order" class="form-control" name="tanggal_order" required />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="id_client">Customer *:</label>
                        <select id="id_client" name="id_client" class="selectkas form-control" required>
                            @foreach($klien as $klien)
                            <option value="{{$klien->id_client}}">{{$klien->nama_client}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="id_supir">Supir *:</label>
                        <select id="id_supir" name="id_supir" class="selectkas form-control" required>
                            @foreach($supir as $supir)
                            <option value="{{$supir->id_supir}}">{{$supir->nama_supir}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                          <label for="container">Container* :</label>
                          <input type="text" id="container" class="form-control" name="container" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                          <label for="tujuan">Tujuan* :</label>
                          <input type="text" id="tujuan" class="form-control" name="tujuan" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
						<label for="kemasan">Kemasan* :</label>
                        <input type="text" id="kemasan" class="form-control" name="kemasan" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                          <label for="ongkos">Ongkos* :</label>
                          <input type="text" id="ongkos" class="form-control text-end" name="ongkos" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
						<label for="dp">DP* :</label>
                        <input type="text" id="dp" class="form-control text-end" name="dp" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                          <label for="uang_jalan">Uang Jalan* :</label>
                          <input type="text" id="uang_jalan" class="form-control text-end" name="uang_jalan" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
						<label for="lift_off">Lift Off* :</label>
                        <input type="text" id="lift_off" class="form-control text-end" name="lift_off" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                          <label for="uang_bongkar">Uang Bongkar* :</label>
                          <input type="text" id="uang_bongkar" class="form-control text-end" name="uang_bongkar" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
						<label for="lain_lain">Lain-lain* :</label>
                        <input type="text" id="lain_lain" class="form-control text-end" name="lain_lain" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                          <label for="komisi_supir">Komisi Supir* :</label>
                          <input type="text" id="komisi_supir" class="form-control text-end" name="komisi_supir" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
						<label for="komisi_kenek">Komisi Kenek* :</label>
                        <input type="text" id="komisi_kenek" class="form-control text-end" name="komisi_kenek" onchange="jumlah()" required />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                          <label for="laba">Laba* :</label>
                          <input type="text" id="laba" class="form-control text-end" name="laba" required />
                    </div>
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
</div>

@endsection
@section('jscript')
<script>
    $(document).ready(function() {
    $('.selectkas').select2();
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
<script type="text/javascript">
var now = moment();
$(function() {
    $('input[name="tanggal_order"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
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
            
			$("#laba").val(sum.toFixed(0));
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