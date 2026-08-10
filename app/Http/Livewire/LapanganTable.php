<?php

namespace App\Http\Livewire;

use URL;

class LapanganTable extends IndexTable
{
    protected $module = 'lapangan';

    protected $name = 'Lapangan';

    protected $defaultSort = ['id_lapangan', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Lapangan', 'url' => route('lapangancreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_lapangan', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_lapangan'],
            ['name' => 'nama_lapangan', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_lapangan'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('lapanganedit', $src->id_lapangan) . '" class="btn btn-sm btn-warning" title="Edit Lapangan">' . $icon . '</a>
                            <a href="' . URL::route('lapanganhapus', $src->id_lapangan) . '" class="btn btn-sm btn-danger" title="Hapus Lapangan" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}