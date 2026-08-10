<?php

namespace App\Http\Livewire;

use URL;

class KlienTable extends IndexTable
{
    protected $module = 'klien';

    protected $name = 'Client';

    protected $defaultSort = ['id_client', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Klien', 'url' => route('kliencreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_client', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_client'],
            ['name' => 'nama_client', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_client'],
            ['name' => 'alamat_client', 'label' => 'Alamat', 'sortable' => true, 'filter' => 'alamat_client'],
            ['name' => 'kota_client', 'label' => 'Kota', 'sortable' => true, 'filter' => 'kota_client'],
            ['name' => 'kodepos_client', 'label' => 'Kodepos', 'width' => '100px', 'sortable' => true, 'filter' => 'kodepos_client'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('klienedit', $src->id_client) . '" class="btn btn-sm btn-warning" title="Edit Klien">' . $icon . '</a>
                            <a href="' . URL::route('klienhapus', $src->id_client) . '" class="btn btn-sm btn-danger" title="Hapus Klien" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}