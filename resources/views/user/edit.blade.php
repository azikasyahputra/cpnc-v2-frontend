@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit User</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Pengaturan</a></li>
                              <li><a href="{{URL::route('user')}}">User</a></li>
                              <li class="active">Edit User</li>
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
            <form action="{{URL::route('usersaveedit')}}" method="post" class="form-horizontal">
            @foreach($user as $data)
                <div class="card-body ">
                    {{ csrf_field() }}
                    <input type="hidden" name="id_user" value="{{$data->id}}"/>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="username" class=" form-label">Username *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="username" class="form-control" name="username" value="{{$data->username}}" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="nama" class=" form-label">Nama *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama" class="form-control" name="nama" value="{{$data->nama}}" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="email" class=" form-label">Email *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="email" id="email" class="form-control" name="email" value="{{$data->email}}" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="role" class=" form-label">Role *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9">
                            <select id="role" name="role" class="form-control" required>
                                @foreach($roles as $role)
                                    <option value="{{$role->nama_role}}" {{$data->role == $role->nama_role ? 'selected' : ''}}>{{$role->nama_role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="password" class=" form-label">Password</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password" class="form-control" name="password" placeholder="Kosongkan jika tidak diganti" /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{URL::route('user')}}" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            @endforeach
            </form>
        </div>
    </div>
@endsection
