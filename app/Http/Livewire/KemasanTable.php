<?php

namespace App\Http\Livewire;

use URL;

class KemasanTable extends IndexTable
{
    protected $module = 'kemasan';

    protected $name = 'Kemasan';

    protected $defaultSort = ['id_kemasan', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Kemasan', 'url' => route('kemasancreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_kemasan', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_kemasan'],
            ['name' => 'nama_kemasan', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_kemasan'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('kemasanedit', $src->id_kemasan) . '" class="btn btn-sm btn-warning" title="Edit Kemasan">' . $icon . '</a>
                            <a href="' . URL::route('kemasanhapus', $src->id_kemasan) . '" class="btn btn-sm btn-danger" title="Hapus Kemasan" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}