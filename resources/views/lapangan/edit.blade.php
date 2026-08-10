@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create Lapangan</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="{{URL::route('lapangan')}}">Lapangan</a></li>
                              <li class="active">Create Lapangan</li>
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
            <form action="{{URL::route('lapangansaveedit')}}" method="post" class="form-horizontal">
            @foreach($lapangan as $data)
                {{ csrf_field() }}
                <input type="hidden" name="id_lapangan" value="{{$data->id_lapangan}}"/>
                <div class="card-body ">
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="lapangan" class=" form-label">Nama Lapangan *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="lapangan" class="form-control" name="lapangan" value="{{$data->nama_lapangan}}" required /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{URL::route('lapangan')}}" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            @endforeach
            </form>
        </div>
    </div>
@endsection

