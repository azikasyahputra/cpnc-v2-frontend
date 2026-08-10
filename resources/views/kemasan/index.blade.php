@extends('layout.main_layout')
@section('title', 'Kemasan')
@section('breadcumbs')
    <div class="row mb-4">
        <div class="col-12">
            <h4 class="fw-bold py-3 mb-0"><span class="text-muted fw-light">Master Input /</span> Kemasan</h4>
        </div>
    </div>
@endsection
@section('content')
    <livewire:kemasan-table />
@endsection
