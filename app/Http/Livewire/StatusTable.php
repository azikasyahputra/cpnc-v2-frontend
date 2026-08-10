<?php

namespace App\Http\Livewire;

use URL;

class StatusTable extends IndexTable
{
    protected $module = 'status';

    protected $name = 'Status';

    protected $defaultSort = ['id_status', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Status', 'url' => route('statuscreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_status', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_status'],
            ['name' => 'nama_status', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_status'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('statusedit', $src->id_status) . '" class="btn btn-sm btn-warning" title="Edit Status">' . $icon . '</a>
                            <a href="' . URL::route('statushapus', $src->id_status) . '" class="btn btn-sm btn-danger" title="Hapus Status" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}