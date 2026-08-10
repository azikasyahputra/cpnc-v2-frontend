<?php

namespace App\Http\Livewire;

use URL;

class KosonganTable extends IndexTable
{
    protected $module = 'kosongan';

    protected $name = 'Kosongan';

    protected $defaultSort = ['id_kosongan', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Kosongan', 'url' => route('kosongancreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_kosongan', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_kosongan'],
            ['name' => 'nama_kosongan', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_kosongan'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('kosonganedit', $src->id_kosongan) . '" class="btn btn-sm btn-warning" title="Edit Kosongan">' . $icon . '</a>
                            <a href="' . URL::route('kosonganhapus', $src->id_kosongan) . '" class="btn btn-sm btn-danger" title="Hapus Kosongan" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}