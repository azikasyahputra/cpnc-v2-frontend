@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Laporan Komisi Supir</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Laporan Trucking</a></li>
                              <li class="active">Laporan Laporan Komisi Supir</li>
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
            <form action="{{URL::route('downloadlaporankomisisupir')}}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="tanggal_awal">Tanggal Awal* :</label>
                        <input type="text" id="tanggal_awal" class="form-control" name="tanggal_awal" required />
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-12 mb-3 ">
                        <label for="tanggal_akhir">Tanggal Akhir* :</label>
                        <input type="text" id="tanggal_akhir" class="form-control" name="tanggal_akhir" required />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="id_supir">Supir *:</label>
                        <select id="id_supir" name="id_supir" class="selectkas form-control" required>
                            @foreach($supir as $supir)
                            <option value="{{$supir->id_supir}}">{{$supir->nama_supir}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="Alasan Pemotongan">Alasan Pemotongan :</label>
                        <input type="text" id="alasan_pemotongan" class="form-control" name="alasan_pemotongan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <label for="biaya_pemotongan">Biaya Pemotongan :</label>
                        <input type="text" id="biaya_pemotongan" class="form-control" name="biaya_pemotongan" />
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3 ">
                        <input type="submit" name="download" value="Download Excel" class="btn btn-success">
                        <input type="submit" name="download" value="Download PDF" class="btn btn-warning">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('jscript')
<script>
    $(function() {
    $('input[name="tanggal_awal"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
$(function() {
    $('input[name="tanggal_akhir"]').daterangepicker({
        singleDatePicker: true,
        showDropdowns: true,
    });
});
</script>
@endsection