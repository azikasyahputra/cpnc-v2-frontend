@extends('layout.main_layout')
@section('breadcumbs')
  <div class="breadcrumbs">
      <div class="breadcrumbs-inner">
          <div class="row m-0">
              <div class="col-sm-4">
                  <div class="page-header float-start">
                      <div class="page-title">
                          <h1>Edit Invoice Trucking</h1>
                      </div>
                  </div>
              </div>
              <div class="col-sm-8">
                  <div class="page-header float-end">
                      <div class="page-title">
                          <ol class="breadcrumb text-end">
                              <li><a href="#">Invoice Trucking</a></li>
                              <li><a href="{{URL::route('invoicetrucking')}}">Semua Invoice Trucking</a></li>
                              <li class="active">Edit Invoice Trucking</li>
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
    @foreach($header as $data)
    <form action="{{URL::route('invoicetruckingsaveedit')}}" method="post" id="formInvoiceTrucking">
        {{ csrf_field() }}
        <input type="hidden" name="id_invoice_trucking" value="{{$data->id_invoice_trucking}}" />
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                        <label for="no_invoice">No.Invoice :</label>
                        <input type="text" id="no_invoice" class="form-control" value="{{$data->no_invoice}}" readonly />
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                        <label for="tanggal_invoice">Tanggal Invoice* :</label>
                        <?php $tgl = DateTime::createFromFormat('Y-m-d', $data->tanggal_invoice); ?>
                        <input type="text" id="tanggal_invoice" class="form-control" name="tanggal_invoice" value="{{ $tgl ? $tgl->format('d/m/Y') : '' }}" required />
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 col-12 mb-3">
                        <label for="no_aju">No AJU* :</label>
                        <input type="text" id="no_aju" class="form-control" name="no_aju" value="{{$data->no_aju}}" required />
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-3">
                        <label for="id_client">Customer *:</label>
                        <select id="id_client" name="id_client" class="selectkas form-control" required>
                            @foreach($klien as $klien)
                            <option value="{{$klien->id_client}}" @if($data->id_client==$klien->id_client) selected @endif>{{$klien->nama_client}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="table-responsive text-nowrap">
                    <table class="table table-bordered" id="detailTable">
                        <thead style="background-color: #696cff;">
                            <tr>
                                <th class="text-white" style="width:40px;font-size:12px;">No</th>
                                <th class="text-white" style="font-size:12px;">Tanggal</th>
                                <th class="text-white" style="font-size:12px;">Tujuan</th>
                                <th class="text-white" style="font-size:12px;">Party</th>
                                <th class="text-white" style="font-size:12px;">Container</th>
                                <th class="text-white" style="font-size:12px;">Ongkos</th>
                                <th class="text-white" style="font-size:12px;">U.Bongkar</th>
                                <th class="text-white" style="font-size:12px;">Lift Off</th>
                                <th class="text-white" style="font-size:12px;">Tagihan</th>
                                <th class="text-white" style="width:110px;font-size:12px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $index => $row)
                            <tr>
                                <td class="text-center no">{{ $index + 1 }}</td>
                                <td>
                                    <input type="hidden" name="detail[{{$index}}][id_order_trucking]" value="{{ $row->id_order_trucking ?? '' }}" />
                                    <?php $tgl = isset($row->tanggal_order) && $row->tanggal_order ? date('d/m/Y', strtotime($row->tanggal_order)) : ''; ?>
                                    <input type="text" name="detail[{{$index}}][tanggal_order]" class="form-control tanggal-order" value="{{ $tgl }}" />
                                </td>
                                <td><input type="text" name="detail[{{$index}}][tujuan]" class="form-control" value="{{ $row->tujuan ?? '' }}" /></td>
                                <td><input type="text" name="detail[{{$index}}][party]" class="form-control" value="{{ $row->party ?? '' }}" /></td>
                                <td><input type="text" name="detail[{{$index}}][container]" class="form-control" value="{{ $row->container ?? '' }}" /></td>
                                <td><input type="text" name="detail[{{$index}}][ongkos]" class="form-control text-end angka" value="{{ $row->ongkos ?? 0 }}" /></td>
                                <td><input type="text" name="detail[{{$index}}][uang_bongkar]" class="form-control text-end angka" value="{{ $row->uang_bongkar ?? 0 }}" /></td>
                                <td><input type="text" name="detail[{{$index}}][lift_off]" class="form-control text-end angka" value="{{ $row->lift_off ?? 0 }}" /></td>
                                <td class="text-end tagihan">0</td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-1">
                                        <button type="button" class="btn btn-sm btn-success" title="Tambah baris di sini" onclick="sisipkanBaris(this)"><i class="bx bx-plus"></i></button>
                                        <button type="button" class="btn btn-sm btn-danger" title="Hapus baris" onclick="hapusBaris(this)"><i class="bx bx-trash"></i></button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="5" class="text-end fw-bold">TOTAL TAGIHAN</td>
                                <td class="text-end fw-bold" id="totalOngkos">0</td>
                                <td class="text-end fw-bold" id="totalBongkar">0</td>
                                <td class="text-end fw-bold" id="totalLiftoff">0</td>
                                <td class="text-end fw-bold" id="totalTagihan">0</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="row mt-2">
                    <div class="col-md-12">
                        <button type="button" class="btn btn-sm btn-success" onclick="tambahBaris()"><i class="bx bx-plus me-1"></i>Tambah Baris</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-3 mt-1">
            <div class="col-md-12 text-end">
                <a href="{{URL::route('invoicetrucking')}}" class="btn btn-danger">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </div>
        </div>
    </form>
    @endforeach
</div>
@endsection
@section('jscript')
<script>
    $(document).ready(function() {
        $('.selectkas').select2();
        $('input[name="tanggal_invoice"]').daterangepicker({ singleDatePicker: true, showDropdowns: true });
        hitungSemua();
    });

    function tambahBaris() {
        var table = document.getElementById("detailTable").getElementsByTagName('tbody')[0];
        var row = table.insertRow(-1);
        row.innerHTML = rowHtml();
        initRow(row);
        hitungSemua();
    }

    function sisipkanBaris(btn) {
        var row = btn.closest('tr');
        var baru = document.createElement('tr');
        baru.innerHTML = rowHtml();
        row.parentNode.insertBefore(baru, row.nextSibling);
        initRow(baru);
        hitungSemua();
    }

    function hapusBaris(btn) {
        $(btn).closest('tr').remove();
        hitungSemua();
    }

    function rowHtml() {
        return '<td class="text-center no"></td>' +
            '<td><input type="text" name="detail[#][tanggal_order]" class="form-control tanggal-order" /></td>' +
            '<td><input type="text" name="detail[#][tujuan]" class="form-control" /></td>' +
            '<td><input type="text" name="detail[#][party]" class="form-control" /></td>' +
            '<td><input type="text" name="detail[#][container]" class="form-control" /></td>' +
            '<td><input type="text" name="detail[#][ongkos]" class="form-control text-end angka" value="0" /></td>' +
            '<td><input type="text" name="detail[#][uang_bongkar]" class="form-control text-end angka" value="0" /></td>' +
            '<td><input type="text" name="detail[#][lift_off]" class="form-control text-end angka" value="0" /></td>' +
            '<td class="text-end tagihan">0</td>' +
            '<td class="text-center"><div class="d-flex justify-content-center gap-1">' +
            '<button type="button" class="btn btn-sm btn-success" title="Tambah baris di sini" onclick="sisipkanBaris(this)"><i class="bx bx-plus"></i></button>' +
            '<button type="button" class="btn btn-sm btn-danger" title="Hapus baris" onclick="hapusBaris(this)"><i class="bx bx-trash"></i></button>' +
            '</div></td>';
    }

    function initRow(row) {
        $('.tanggal-order', row).daterangepicker({ singleDatePicker: true, showDropdowns: true, autoUpdateInput: true });
    }

    function renomerBaris() {
        var rows = document.getElementById("detailTable").getElementsByTagName('tbody')[0].rows;
        for (var i = 0; i < rows.length; i++) {
            var inputs = rows[i].getElementsByTagName('input');
            for (var j = 0; j < inputs.length; j++) {
                inputs[j].name = inputs[j].name.replace(/detail\[\d*\]/g, 'detail[' + i + ']');
            }
        }
    }

    function hitungSemua() {
        var rows = document.getElementById("detailTable").getElementsByTagName('tbody')[0].rows;
        renomerBaris();
        var totalOngkos = 0, totalBongkar = 0, totalLiftoff = 0, totalTagihan = 0;
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('input');
            var ongkos = 0, bongkar = 0, liftoff = 0;
            for (var j = 0; j < cells.length; j++) {
                var name = cells[j].name;
                if (name.indexOf('[ongkos]') !== -1) ongkos = parseFloat(cells[j].value) || 0;
                if (name.indexOf('[uang_bongkar]') !== -1) bongkar = parseFloat(cells[j].value) || 0;
                if (name.indexOf('[lift_off]') !== -1) liftoff = parseFloat(cells[j].value) || 0;
            }
            var tagihan = ongkos + bongkar + liftoff;
            rows[i].getElementsByClassName('tagihan')[0].innerText = tagihan.toLocaleString('id-ID');
            rows[i].getElementsByClassName('no')[0].innerText = i + 1;
            totalOngkos += ongkos; totalBongkar += bongkar; totalLiftoff += liftoff; totalTagihan += tagihan;
        }
        document.getElementById("totalOngkos").innerText = totalOngkos.toLocaleString('id-ID');
        document.getElementById("totalBongkar").innerText = totalBongkar.toLocaleString('id-ID');
        document.getElementById("totalLiftoff").innerText = totalLiftoff.toLocaleString('id-ID');
        document.getElementById("totalTagihan").innerText = totalTagihan.toLocaleString('id-ID');
    }

    $(document).on('keyup', '#detailTable .angka', function() {
        hitungSemua();
    });
</script>
@endsection
