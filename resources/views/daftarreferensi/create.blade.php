@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create Daftar Referensi</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="{{URL::route('daftarreferensi')}}">Daftar Referensi</a></li>
                              <li class="active">Create Daftar Referensi</li>
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
            <form action="{{URL::route('daftarreferensisave')}}" method="post" class="form-horizontal">
                <div class="card-body ">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="kode_referensi" class=" form-label">Kode Referensi *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="kode_referensi" class="form-control" name="kode_referensi" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="keterangan_referensi" class=" form-label">Keterangan Referensi *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="keterangan_referensi" class="form-control" name="keterangan_referensi" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="flag_buku_kas" class=" form-label">Buku Kas *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9">
                            <select id="flag_buku_kas" name="flag_buku_kas" class="form-control" required>
                                <option value="Kas">Kas</option>
                                <option value="Bank">Bank</option>
                                <option value="Piutang">Piutang</option>
                                <option value="Pendapatan Jasa">Pendapatan Jasa</option>
                                <option value="Pendapatan Operasional">Pendapatan Operasional</option>
                                <option value="Pendapatan Trucking">Pendapatan Trucking</option>
                                <option value="Biaya">Biaya</option>
                                <option value="Penghasilan Luar Usaha">Penghasilan Luar Usaha</option>
                                <option value="Biaya Luar Usaha">Biaya Luar Usaha</option>
                                <option value="Aktiva Tetap">Aktiva Tetap</option>
                                <option value="Kewajiban">Kewajiban</option>
                                <option value="Ekuitas">Ekuitas</option>
                                <option value="Lain-lain">Lain-lain</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{URL::route('daftarreferensi')}}" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection

