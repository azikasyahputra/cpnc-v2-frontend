@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create Status</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Master Input</a></li>
                              <li><a href="{{URL::route('status')}}">Status</a></li>
                              <li class="active">Create Status</li>
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
            <form action="{{URL::route('statussaveedit')}}" method="post" class="form-horizontal">
            @foreach($status as $data)    
                <div class="card-body ">
                {{ csrf_field() }}
                <input type="hidden" name="id_status" value="{{$data->id_status}}"/>
                
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="nama_status" class=" form-label">Nama Status *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama_status" class="form-control" name="nama_status" value="{{$data->nama_status}}" required /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{URL::route('status')}}" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            @endforeach
            </form>
        </div>
    </div>
@endsection

