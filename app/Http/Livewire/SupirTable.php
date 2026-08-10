<?php

namespace App\Http\Livewire;

use URL;

class SupirTable extends IndexTable
{
    protected $module = 'supir';

    protected $name = 'Supir';

    protected $defaultSort = ['id_supir', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Supir', 'url' => route('supircreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_supir', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_supir'],
            ['name' => 'nama_supir', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_supir'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('supiredit', $src->id_supir) . '" class="btn btn-sm btn-warning" title="Edit Supir">' . $icon . '</a>
                            <a href="' . URL::route('supirhapus', $src->id_supir) . '" class="btn btn-sm btn-danger" title="Hapus Supir" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}