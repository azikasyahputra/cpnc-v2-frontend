<?php

namespace App\Http\Livewire;

use URL;

class BukuKasTable extends IndexTable
{
    protected $module = 'kas';

    protected $name = 'Kas';

    protected $defaultSort = ['id_kas', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Jurnal Kas', 'url' => route('kascreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'no_transaksi', 'label' => 'No. Jurnal', 'sortable' => true, 'filter' => 'no_transaksi'],
            ['name' => 'tanggal_transaksi', 'label' => 'Tanggal Transaksi', 'sortable' => true, 'filter' => 'tanggal_transaksi'],
            ['name' => 'total_kredit', 'label' => 'Total Kredit', 'sortable' => true, 'filter' => 'total_kredit'],
            ['name' => 'total_debit', 'label' => 'Total Debit', 'sortable' => true, 'filter' => 'total_debit'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '200px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('kasdetail', $src->id_kas) . '" class="btn btn-sm btn-primary" title="Detail Buku Kas">' . $icon . '</a>
                            <a href="' . URL::route('kasedit', $src->id_kas) . '" class="btn btn-sm btn-warning" title="Edit Buku Kas">' . $iconD . '</a>
                            <a href="' . URL::route('kashapus', $src->id_kas) . '" class="btn btn-sm btn-danger" title="Hapus Buku Kas" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}