<?php

namespace App\Http\Livewire;

use URL;

class UserTable extends IndexTable
{
    protected $module = 'user';

    protected $name = 'User';

    protected $defaultSort = ['id', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah User', 'url' => route('usercreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id'],
            ['name' => 'username', 'label' => 'Username', 'sortable' => true, 'filter' => 'username'],
            ['name' => 'nama', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama'],
            ['name' => 'email', 'label' => 'Email', 'sortable' => true, 'filter' => 'email'],
            ['name' => 'role', 'label' => 'Role', 'width' => '140px', 'sortable' => true, 'filter' => 'role'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('useredit', $src->id) . '" class="btn btn-sm btn-warning" title="Edit User">' . $icon . '</a>
                            <a href="' . URL::route('userhapus', $src->id) . '" class="btn btn-sm btn-danger" title="Hapus User" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}
