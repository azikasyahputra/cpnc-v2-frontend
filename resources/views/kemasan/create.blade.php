@extends('layout.main_layout')
@section('content')
    <div class="col-md-12 col-sm-12 col-12">
        <div class="x_title">
            <h2>Formulir Kemasan Baru</h2>
            <div class="clearfix"></div>
         </div>
        <div class="x_content">
            <form id="demo-form" action="{{URL::route('kemasansave')}}" method="post">
                {{ csrf_field() }}
                <label for="kemasan">Kemasan* :</label>
                <input type="text" id="kemasan" class="form-control" name="kemasan" required />
                
                <br/>
                <a href="{{URL::route('kemasan')}}" class="btn btn-danger">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>

        </div>
    </div>

@endsection