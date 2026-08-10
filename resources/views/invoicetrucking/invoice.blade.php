<!doctype html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Invoice Trucking {{ $header->first()->no_invoice ?? '' }}</title>
<style type="text/css">
    body { font-family: sans-serif; font-size: 11px; }
    table { width: 100%; border-collapse: collapse; }
    .no-border { border: none; }
    .bordered td, .bordered th { border: 1px solid #000; padding: 4px; }
    .right { text-align: right; }
    .center { text-align: center; }
    .bold { font-weight: bold; }
    .hdr { font-size: 14px; }
</style>
</head>
<body>
@php
    $head = $header->first();
    $total = 0;
@endphp
    <table class="no-border">
        <tr>
            <td style="width:60%;">
                <div class="bold hdr">PT.CAHYAPRAJA NUSACERIA</div>
                <div>Office : Jl. Fort Barat No,43A Kebon Bawang, Tj. Priok, Jakarta Utara</div>
                <div>Telp. (021) 4358506 &nbsp;&nbsp; Fax. (021) 4358652</div>
            </td>
        </tr>
    </table>
    <br>
    <table class="no-border">
        <tr>
            <td class="bold" style="font-size:13px;">{{ $head->nama_client ?? '' }}</td>
        </tr>
    </table>
    <br>
    <table class="bordered">
        <thead>
            <tr class="bold center">
                <td style="width:6%;">AJU</td>
                <td style="width:10%;">Tanggal</td>
                <td style="width:12%;">Tujuan</td>
                <td style="width:12%;">Party</td>
                <td style="width:12%;">Container</td>
                <td style="width:12%;">Ongkos</td>
                <td style="width:11%;">U.Bongkar</td>
                <td style="width:11%;">Lift Off</td>
                <td style="width:14%;">Tagihan</td>
            </tr>
        </thead>
        <tbody>
            @foreach($detail as $row)
            @php $tagihan = (int) $row->ongkos + (int) $row->uang_bongkar + (int) $row->lift_off; $total += $tagihan; @endphp
            <tr>
                <td class="center">{{ $head->no_aju ?? '' }}</td>
                <td class="center">{{ $row->tanggal_order }}</td>
                <td>{{ $row->tujuan }}</td>
                <td>{{ $row->party }}</td>
                <td>{{ $row->container }}</td>
                <td class="right">{{ number_format((int) $row->ongkos, 0, ',', '.') }}</td>
                <td class="right">{{ number_format((int) $row->uang_bongkar, 0, ',', '.') }}</td>
                <td class="right">{{ number_format((int) $row->lift_off, 0, ',', '.') }}</td>
                <td class="right">{{ number_format($tagihan, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="bold">
                <td colspan="8" class="right">TOTAL TAGIHAN</td>
                <td class="right">{{ number_format($total, 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>
</body>
</html>
