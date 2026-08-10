<?php

namespace App\Http\Livewire;

use URL;

class BiayaTable extends IndexTable
{
    protected $module = 'biaya';

    protected $name = 'Biaya';

    protected $defaultSort = ['id_biaya', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Biaya', 'url' => route('biayacreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_biaya', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_biaya'],
            ['name' => 'nama_biaya', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_biaya'],
            ['name' => 'kategori_biaya', 'label' => 'Kategori', 'sortable' => true, 'filter' => 'kategori_biaya'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('biayaedit', $src->id_biaya) . '" class="btn btn-sm btn-warning" title="Edit Biaya">' . $icon . '</a>
                            <a href="' . URL::route('biayahapus', $src->id_biaya) . '" class="btn btn-sm btn-danger" title="Hapus Biaya" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}