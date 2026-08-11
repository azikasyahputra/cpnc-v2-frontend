@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Create User</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Pengaturan</a></li>
                              <li><a href="{{URL::route('user')}}">User</a></li>
                              <li class="active">Create User</li>
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
            <form action="{{URL::route('usersave')}}" method="post" class="form-horizontal">
                <div class="card-body ">
                    {{ csrf_field() }}
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="username" class=" form-label">Username *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="username" class="form-control" name="username" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="nama" class=" form-label">Nama *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="text" id="nama" class="form-control" name="nama" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="email" class=" form-label">Email *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="email" id="email" class="form-control" name="email" required /></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="role" class=" form-label">Role *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9">
                            <select id="role" name="role" class="form-control" required>
                                @foreach($roles as $role)
                                    <option value="{{$role->nama_role}}">{{$role->nama_role}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col col-md-3"><label for="password" class=" form-label">Password *</label><label class="float-end">:</label></div>
                        <div class="col-12 col-md-9"><input type="password" id="password" class="form-control" name="password" required /></div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{URL::route('user')}}" class="btn btn-danger">Batal</a>
                    <input type="submit" value="Simpan" class="btn btn-primary">
                </div>
            </form>
        </div>
    </div>
@endsection
