@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create Order</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Order</a></li>
                              <li><a href="{{URL::route('order')}}">Semua Order</a></li>
                              <li class="active">Create Order</li>
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
        <form action="{{URL::route('ordersave')}}" method="post">
            {{ csrf_field() }}
        <div class="card">
            <div class="card-body">
                <div id="order">
                    <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="no_aju">No AJU* :</label>
                                    <input type="text" id="no_aju" class="form-control" name="no_aju" required />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="tanggal_order">Tanggal Order* :</label>
                                    <input type="text" id="tanggal_order" class="form-control" name="tanggal_order" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_client">Customer *:</label>
                                    <select id="id_client" name="id_client" class="selectkas form-control" required>
                                        @foreach($klien as $klien)
                                            <option value="{{$klien->id_client}}">{{$klien->nama_client}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="kemasan">Kemasan* :</label>
                                    <input type="text" id="kemasan" class="form-control" name="kemasan" required />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="no_container">No.Container* :</label>
                                    <input type="text" id="no_container" class="form-control" name="no_container" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_jenis_dokumen">Jenis Dokumen* :</label>
                                    <select id="id_jenis_dokumen" name="id_jenis_dokumen" class="form-control" required>
                                    @foreach($jenisdokumen as $jenisdokumen)
                                        <option value="{{$jenisdokumen->id_jenis_dokumen}}">{{$jenisdokumen->nama_dokumen}}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="nama_kapal_pesawat">Kapal/Pesawat* :</label>
                                    <input type="text" id="nama_kapal_pesawat" class="form-control" name="nama_kapal_pesawat" required />
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="tanggal_kapal_pesawat">Tanggal* :</label>
                                    <input type="text" id="tanggal_kapal_pesawat" class="form-control" name="tanggal_kapal_pesawat" required />
                                </div>
                            </div>

                             <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_pelayaran">Pelayaran *:</label>
                                    <select id="id_pelayaran" name="id_pelayaran" class="selectkas form-control" required>
                                        @foreach($pelayaran as $pelayaran)
                                        <option value="{{$pelayaran->id_pelayaran}}">{{$pelayaran->nama_pelayaran}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_lapangan">Lapangan *:</label>
                                    <select id="id_lapangan" name="id_lapangan" class="selectkas form-control" required>
                                        @foreach($lapangan as $lapangan)
                                        <option value="{{$lapangan->id_lapangan}}">{{$lapangan->nama_lapangan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_gudang">Gudang *:</label>
                                    <select id="id_gudang" name="id_gudang" class="selectkas form-control" required>
                                        @foreach($gudang as $gudang)
                                        <option value="{{$gudang->id_gudang}}">{{$gudang->nama_gudang}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="nama_barang">Nama Barang* :</label>
                                    <input type="text" id="nama_barang" class="form-control" name="nama_barang" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="nama_bl">BL* :</label>
                                    <input type="text" id="nama_bl" class="form-control" name="nama_bl" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="nama_pos">Pos* :</label>
                                    <input type="text" id="nama_pos" class="form-control" name="nama_pos" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="id_kosongan">Kosongan *:</label>
                                    <select id="id_kosongan" name="id_kosongan" class="selectkas form-control" required>
                                        @foreach($kosongan as $kosongan)
                                        <option value="{{$kosongan->id_kosongan}}">{{$kosongan->nama_kosongan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="id_status">Status* :</label>
                                    <select id="id_status" name="id_status" class="form-control" required>
                                        @foreach($status as $status)
                                        <option value="{{$status->id_status}}">{{$status->nama_status}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                                    <label for="tanggal_status">Tanggal* :</label>
                                    <input type="text" id="tanggal_status" class="form-control" name="tanggal_status" required />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                                    <label for="negara_asal">Negara Asal/Tujuan* :</label>
                                    <input type="text" id="negara_asal" class="form-control" name="negara_asal_tujuan" required />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mb-3 mt-4">
                <div class="col-md-12 text-end">
                    <a href="{{URL::route('order')}}" class="btn btn-danger">Batal</a>
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
@endsection