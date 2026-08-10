@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Kosongan</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="{{URL::route('kosongan')}}">Kosongan</a></li>
                              <li class="active">Edit Kosongan</li>
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
            <form action="{{URL::route('kosongansaveedit')}}" method="post" class="form-horizontal">
            @foreach($kosongan as $data)
                {{ csrf_field() }}
                <input type="hidden" name="id_kosongan" value="{{$data->id_kosongan}}"/>
                <div class="card-body ">   
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="kosongan" class=" form-label">Nama Kosongan *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="kosongan" class="form-control" name="kosongan" value="{{$data->nama_kosongan}}" required /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{URL::route('kosongan')}}" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            @endforeach
            </form>
        </div>
    </div>
@endsection

