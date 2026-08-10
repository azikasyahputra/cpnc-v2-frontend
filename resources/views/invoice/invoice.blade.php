<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Invoice</title>

    <style type="text/css">
        /* ===== Base ===== */
        html {
            margin-left: 15px;
            margin-right: 10px;
            height: 100%;
        }

        * {
            font-family: Verdana, Arial, sans-serif;
        }

        body {
            position: relative;
            margin: 0;
            min-height: 100%;
            font-size: 14px;
        }

        table {
            width: 100%;
            table-layout: fixed;
        }

        td {
            word-wrap: break-word;
            padding: 0;
        }

        /* ===== Fixed sections on the preprinted form ===== */
        .alamat-pelanggan { position: absolute; top: 20px;   left: 0; right: 0; }
        .no-invoice       { position: absolute; top: 180px;  left: 0; right: 0; }
        .detail-pelanggan { position: absolute; top: 290px;  left: 0; right: 0; }
        .bl-no            { position: absolute; top: 310px;  left: 0; right: 0; }
        .detail-invoice   { position: absolute; top: 400px;  left: 0; right: 0; }
        .total            { position: absolute; bottom: 250px; left: 0; right: 0; text-align: center; }
        .terbilang        { position: absolute; bottom: 160px;  left: 0; right: 0; text-align: center; line-height: 1.8; }
        .tanggal          { position: absolute; bottom: 130px;  left: 0; right: 0; text-align: center; }
        .footer           { position: absolute; bottom: 20px;     left: 0; right: 0; text-align: center; }
    </style>
</head>
<body>
@php
    $inv = $header->first();

    $formatTanggal = function ($tanggal) {
        return $tanggal
            ? \Carbon\Carbon::parse($tanggal)->format('d/m/Y')
            : '';
    };

    $formatAngka = function ($angka) {
        return number_format($angka, 0, '', '.');
    };

    $biayaNama = $biayadetail->keyBy('id_biaya');
@endphp

@if ($inv)
    <div class="alamat-pelanggan">
        <table>
            <tr>
                <td>&nbsp;</td>
                <td align="center" style="width:55%;">
                    <h3>&nbsp;</h3>
                    <p style="text-transform:uppercase;">
                        {{ $inv->nama_client }}<br>
                        {{ $inv->alamat_client }}<br>
                        {{ $inv->kota_client }}
                    </p>
                </td>
            </tr>
        </table>
    </div>

    <div class="no-invoice">
        <table>
            <tr>
                <td style="width:18%;">&nbsp;</td>
                <td>{{ $inv->no_invoice }}</td>
            </tr>
        </table>
    </div>

    <div class="detail-pelanggan">
        <table>
            <tr style="text-transform:uppercase;">
                <td align="center">{{ $inv->nama_kapal_pesawat }}</td>
                <td align="center">{{ $inv->negara_asal_tujuan }}</td>
                <td align="center">{{ $inv->nama_pelayaran }}</td>
                <td align="center">{{ $formatTanggal($inv->tanggal_berangkat) }}</td>
                <td align="center">{{ $inv->kemasan }}</td>
                <td align="center">{{ $inv->nama_barang }}</td>
            </tr>
        </table>
    </div>

    <div class="bl-no">
        <table>
            <tr>
                <td align="right" style="width:26%;">{{ $inv->kode_jenis_invoice }}</td>
                <td>&nbsp;&nbsp;{{ $inv->no_bl }}</td>
            </tr>
        </table>
    </div>

    <div class="detail-invoice">
        <table>
            <thead>
                <tr>
                    <td style="width:21%;">&nbsp;</td>
                    <td style="width:34%;">&nbsp;</td>
                    <td style="width:17%;">&nbsp;</td>
                    <td style="width:28%;">&nbsp;</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($detail as $baris)
                    <tr style="text-transform:uppercase;">
                        <td style="width:20%;">{{ $baris->no_kwitansi }}</td>
                        <td style="width:35%;padding-left:8px;">
                            {{ $biayaNama[$baris->id_biaya_detail]->nama_biaya ?? '' }}
                        </td>
                        <td align="right" style="width:17%;padding-right:2px;">
                            {{ $formatAngka($baris->biaya_detail) }}
                        </td>
                        <td style="width:28%;padding-left:7px;">
                            {{ $baris->keterangan }}
                        </td>
                    </tr>
                @endforeach

                @for ($i = $detailcount + 1; $i < 16; $i++)
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                @endfor

                <tr>
                    <td style="height:15%;">&nbsp;</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="total">
        <table>
            <tr style="text-transform:uppercase;">
                <td style="width:55%;">&nbsp;</td>
                <td align="right" style="width:17%;padding-left:8px;">
                    {{ $formatAngka($inv->jumlah_biaya) }}
                </td>
                <td style="width:28%;">&nbsp;</td>
            </tr>
        </table>
    </div>

    <div class="terbilang">
        <table>
            <tr style="text-transform:uppercase;">
                <td>&nbsp;</td>
                <td align="left" style="width:47%;">
                    {{ $inv->biaya_terbilang }}
                </td>
            </tr>
        </table>
    </div>

    <div class="tanggal">
        <table>
            <tr>
                <td align="right">&nbsp;</td>
                <td align="left" style="width:30%;">
                    {{ $formatTanggal($inv->tanggal_invoice) }}
                </td>
            </tr>
        </table>
    </div>

    <div class="footer">
        <table>
            <tr>
                <td align="right">&nbsp;</td>
                <td align="left" style="width:30%;">
                    YOPPY. B
                </td>
            </tr>
        </table>
    </div>
@endif
</body>
</html>
