@extends('layout.main_layout')
@section('content')
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-primary"><i class="bx bx-shopping-bag"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Order Hari Ini</p>
                            <h5 class="mb-0">{{$ordertoday}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-primary"><i class="bx bx-cart"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Order Bulan Ini</p>
                            <h5 class="mb-0">{{$ordermonth}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-file"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Invoice Hari Ini</p>
                            <h5 class="mb-0">{{$invoicetoday}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-success"><i class="bx bx-file-blank"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Invoice Bulan Ini</p>
                            <h5 class="mb-0">{{$invoicemonth}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-wallet"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Laba/Rugi Order Hari Ini</p>
                            <h5 class="mb-0">Rp. {{number_format($labatoday,0,'','.')}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-info"><i class="bx bx-credit-card"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Laba/Rugi Order Bulan Ini</p>
                            <h5 class="mb-0">Rp. {{number_format($labamonth,0,'','.')}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-warning"><i class="bx bx-money"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Biaya Keuangan Rugi/Laba Bulan Ini</p>
                            <h5 class="mb-0">Rp. {{number_format($biayamonth,0,'','.')}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card">
                <div class="card-body py-2">
                    <div class="d-flex align-items-center gap-3">
                        <div class="flex-shrink-0">
                            <span class="avatar"><span class="avatar-initial rounded bg-label-danger"><i class="bx bx-line-chart"></i></span></span>
                        </div>
                        <div class="flex-grow-1">
                            <p class="mb-0 small">Total Pendapatan Keuangan Rugi/Laba Bulan Ini</p>
                            <h5 class="mb-0">Rp. {{number_format($lababrutomonth,0,'','.')}}</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
