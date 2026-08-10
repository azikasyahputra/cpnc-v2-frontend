@extends('layout.main_layout')
@section('content')
    <div class="col-md-12 col-sm-12 col-12">
        <div class="x_title">
            <h2>Edit Kemasan</h2>
            <div class="clearfix"></div>
         </div>
        <div class="x_content">
            @foreach($kemasan as $data)
            <form id="demo-form" action="{{URL::route('kemasansaveedit')}}" method="post">
                {{ csrf_field() }}
                <input type="hidden" name="id_kemasan" value="{{$data->id_kemasan}}"/>
                
                <label for="kemasan">Nama Kemasan* :</label>
                <input type="text" id="kemasan" class="form-control" name="kemasan" value="{{$data->nama_kemasan}}" required />

                <br/>
                <a href="{{URL::route('kemasan')}}" class="btn btn-danger">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
            @endforeach
        </div>
    </div>

@endsection