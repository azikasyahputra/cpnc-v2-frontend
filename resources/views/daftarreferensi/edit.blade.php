@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Daftar Referensi</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="{{URL::route('daftarreferensi')}}">Daftar Referensi</a></li>
                              <li class="active">Edit Daftar Referensi</li>
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
            <form action="{{URL::route('daftarreferensisaveedit')}}" method="post" class="form-horizontal">
                @foreach($referensi as $data)
                <div class="card-body ">
                {{ csrf_field() }}
                <input type="hidden" name="id_referensi" value="{{$data->id_referensi}}"/>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="kode_referensi" class=" form-label">Kode Referensi *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="kode_referensi" class="form-control" name="kode_referensi" value="{{$data->kode_referensi}}" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="keterangan_referensi" class=" form-label">Keterangan Referensi *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="keterangan_referensi" class="form-control" name="keterangan_referensi" value="{{$data->keterangan_referensi}}" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="flag_buku_kas" class=" form-label">Buku Kas *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9">
                            <select id="flag_buku_kas" name="flag_buku_kas" class="form-control" required>
                                <option value="Kas" @if($data->flag_buku_kas=='Kas') selected @endif >Kas</option>
                                <option value="Bank" @if($data->flag_buku_kas=='Bank') selected @endif >Bank</option>
                                <option value="Piutang" @if($data->flag_buku_kas=='Piutang') selected @endif>Piutang</option>
                                <option value="Pendapatan Jasa" @if($data->flag_buku_kas=='Pendapatan Jasa') selected @endif>Pendapatan Jasa</option>
                                <option value="Pendapatan Operasional" @if($data->flag_buku_kas=='Pendapatan Operasional') selected @endif>Pendapatan Operasional</option>
                                <option value="Pendapatan Trucking" @if($data->flag_buku_kas=='Pendapatan Trucking') selected @endif>Pendapatan Trucking</option>
                                <option value="Biaya" @if($data->flag_buku_kas=='Biaya') selected @endif>Biaya</option>
                                <option value="Penghasilan Luar Usaha" @if($data->flag_buku_kas=='Penghasilan Luar Usaha') selected @endif>Penghasilan Luar Usaha</option>
                                <option value="Biaya Luar Usaha" @if($data->flag_buku_kas=='Biaya Luar Usaha') selected @endif>Biaya Luar Usaha</option>
                                <option value="Aktiva Tetap" @if($data->flag_buku_kas=='Aktiva Tetap') selected @endif>Aktiva Tetap</option>
                                <option value="Kewajiban" @if($data->flag_buku_kas=='Kewajiban') selected @endif>Kewajiban</option>
                                <option value="Ekuitas" @if($data->flag_buku_kas=='Ekuitas') selected @endif>Ekuitas</option>
                                <option value="Lain-lain" @if($data->flag_buku_kas=='Lain-lain') selected @endif>Lain-lain</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{URL::route('daftarreferensi')}}" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
                @endforeach
            </form>
        </div>
    </div>
@endsection

