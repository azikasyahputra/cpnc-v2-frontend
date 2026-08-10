<?php

namespace App\Http\Livewire;

use URL;

class PelayaranTable extends IndexTable
{
    protected $module = 'pelayaran';

    protected $name = 'Pelayaran';

    protected $defaultSort = ['id_pelayaran', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Pelayaran', 'url' => route('pelayarancreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_pelayaran', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_pelayaran'],
            ['name' => 'nama_pelayaran', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_pelayaran'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('pelayaranedit', $src->id_pelayaran) . '" class="btn btn-sm btn-warning" title="Edit Pelayaran">' . $icon . '</a>
                            <a href="' . URL::route('pelayaranhapus', $src->id_pelayaran) . '" class="btn btn-sm btn-danger" title="Hapus Pelayaran" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}