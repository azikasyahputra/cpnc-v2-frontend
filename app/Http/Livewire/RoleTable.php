<?php

namespace App\Http\Livewire;

use URL;

class RoleTable extends IndexTable
{
    protected $module = 'role';

    protected $name = 'Role';

    protected $defaultSort = ['id_role', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Role', 'url' => route('rolecreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_role', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_role'],
            ['name' => 'nama_role', 'label' => 'Nama Role', 'sortable' => true, 'filter' => 'nama_role'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('roleedit', $src->id_role) . '" class="btn btn-sm btn-warning" title="Edit Role">' . $icon . '</a>
                            <a href="' . URL::route('rolehapus', $src->id_role) . '" class="btn btn-sm btn-danger" title="Hapus Role" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}
