<?php

namespace App\Http\Livewire;

use URL;

class PengeluaranTable extends IndexTable
{
    protected $module = 'pengeluaran';

    protected $name = 'Pengeluaran';

    protected $defaultSort = ['id_pengeluaran', 'desc'];


    protected function columns(): array
    {
        return [
            ['name' => 'id_pengeluaran', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_pengeluaran'],
            ['name' => 'no_invoice', 'label' => 'No.Invoice', 'sortable' => true, 'filter' => 'no_invoice'],
            ['name' => 'nama_client', 'label' => 'Nama Klien', 'sortable' => true, 'filter' => 'nama_client'],
            ['name' => 'dCreated', 'label' => 'Tanggal Pembuatan', 'width' => '120px', 'sortable' => true, 'filter' => 'dCreated'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '200px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('pengeluarandetail', $src->id_pengeluaran) . '" class="btn btn-sm btn-primary" title="Detail Pengeluaran">' . $icon . '</a>
                            <a href="' . URL::route('pengeluaranedit', $src->id_pengeluaran) . '" class="btn btn-sm btn-warning" title="Edit Pengeluaran">' . $iconD . '</a>
                            <a href="' . URL::route('pengeluaranhapus', $src->id_pengeluaran) . '" class="btn btn-sm btn-danger" title="Hapus Pengeluaran" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}