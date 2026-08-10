<?php

namespace App\Http\Livewire;

use URL;

class GudangTable extends IndexTable
{
    protected $module = 'gudang';

    protected $name = 'Gudang';

    protected $defaultSort = ['id_gudang', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Gudang', 'url' => route('gudangcreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_gudang', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_gudang'],
            ['name' => 'nama_gudang', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_gudang'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('gudangedit', $src->id_gudang) . '" class="btn btn-sm btn-warning" title="Edit Gudang">' . $icon . '</a>
                            <a href="' . URL::route('gudanghapus', $src->id_gudang) . '" class="btn btn-sm btn-danger" title="Hapus Gudang" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}