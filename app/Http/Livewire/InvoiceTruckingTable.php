<?php

namespace App\Http\Livewire;

use URL;

class InvoiceTruckingTable extends IndexTable
{
    protected $module = 'invoicetrucking';

    protected $name = 'Invoicetrucking';

    protected $defaultSort = ['id_invoice_trucking', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Invoice Trucking', 'url' => route('invoicetruckingcreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'no_invoice', 'label' => 'No.Invoice', 'width' => '180px', 'sortable' => true, 'filter' => 'no_invoice'],
            ['name' => 'nama_client', 'label' => 'Nama Klien', 'sortable' => true, 'filter' => 'nama_client'],
            ['name' => 'no_aju', 'label' => 'No.AJU', 'width' => '120px', 'sortable' => true, 'filter' => 'no_aju'],
            ['name' => 'tanggal_invoice', 'label' => 'Tanggal', 'width' => '120px', 'sortable' => true, 'filter' => 'tanggal_invoice'],
            ['name' => 'jumlah_biaya', 'label' => 'Total', 'width' => '140px', 'html' => function ($src) {
                return number_format((int) ($src->jumlah_biaya ?? 0), 0, ',', '.');
            }],
            ['name' => 'Action', 'label' => 'Action', 'width' => '220px', 'html' => function ($src) {
                $lunas = '';
                if ($src->flag_bayar == 'Belum') {
                    $lunas = '<a href="'.URL::route('invoicetruckinglunas', $src->id_invoice_trucking).'" class="btn btn-sm btn-info" title="Lunas"><i class="bx bx-money"></i></a>';
                }
                $icon = '<i class="bx bx-detail"></i>';
                $iconD = '<i class="bx bx-edit-alt"></i>';
                $iconX = '<i class="bx bx-trash"></i>';
                $pdf = '<a href="'.URL::route('invoicetruckingdownload', $src->id_invoice_trucking).'" class="btn btn-sm btn-secondary" title="Download PDF"><i class="bx bx-file"></i></a>';
                $xlsx = '<a href="'.URL::route('invoicetruckingdownloadxlsx', $src->id_invoice_trucking).'" class="btn btn-sm btn-success" title="Download Excel"><i class="bx bx-grid-alt"></i></a>';

                return '
                    <div class="btn-edit">
                        <a href="'.URL::route('invoicetruckingdetail', $src->id_invoice_trucking).'" class="btn btn-sm btn-primary" title="Detail Invoice Trucking">'.$icon.'</a>
                        '.$lunas.'
                        <a href="'.URL::route('invoicetruckingedit', $src->id_invoice_trucking).'" class="btn btn-sm btn-warning" title="Edit Invoice Trucking">'.$iconD.'</a>
                        '.$pdf.' '.$xlsx.'
                        <a href="'.URL::route('invoicetruckinghapus', $src->id_invoice_trucking).'" class="btn btn-sm btn-danger" title="Hapus Invoice" onclick="return confirm (\'anda akan hapus data?\');">'.$iconX.'</a>
                    </div>';
            }],
        ];
    }
}
