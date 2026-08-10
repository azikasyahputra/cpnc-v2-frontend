<?php

namespace App\Http\Livewire;

use URL;

class InvoiceTable extends IndexTable
{
    protected $module = 'invoice';

    protected $name = 'Invoice';

    protected $defaultSort = ['id_invoice', 'desc'];


    protected function columns(): array
    {
        return [
            ['name' => 'no_invoice', 'label' => 'No.Invoice', 'width' => '200px', 'sortable' => true, 'filter' => 'no_invoice'],
            ['name' => 'nama_client', 'label' => 'Nama Klien', 'sortable' => true, 'filter' => 'nama_client'],
            ['name' => 'dCreated', 'label' => 'Tanggal Pembuatan', 'width' => '220px', 'sortable' => true, 'filter' => 'dCreated'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '200px',                 'html' => function ($src) {
                    $lunas = '';
                    $pengeluaran = '';
                    if ($src->flag_bayar == 'Belum') {
                        $lunas = '<a href="' . URL::route('invoicelunas', $src->id_invoice) . '" class="btn btn-sm btn-info" title="Lunas"><i class="bx bx-money"></i></a>';
                    }
                    if ($src->flag_pengeluaran == 'Belum') {
                        $pengeluaran = '<a href="' . URL::route('pengeluarancreate', $src->id_invoice) . '" class="btn btn-sm btn-success" title="Buat Pengeluaran"><i class="bx bx-plus"></i></a>';
                    }
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('invoicedetail', $src->id_invoice) . '" class="btn btn-sm btn-primary" title="Detail Invoice">' . $icon . '</a>
                            ' . $lunas . ' ' . $pengeluaran . '
                            <a href="' . URL::route('invoiceedit', $src->id_invoice) . '" class="btn btn-sm btn-warning" title="Edit Invoice">' . $iconD . '</a>
                            <a href="' . URL::route('invoicehapus', $src->id_invoice) . '" class="btn btn-sm btn-danger" title="Hapus Invoice" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}