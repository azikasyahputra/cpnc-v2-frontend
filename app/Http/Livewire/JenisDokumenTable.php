<?php

namespace App\Http\Livewire;

use URL;

class JenisDokumenTable extends IndexTable
{
    protected $module = 'jenisdokumen';

    protected $name = 'JenisDokumen';

    protected $defaultSort = ['id_jenis_dokumen', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Jenis Dokumen', 'url' => route('jenisdokumencreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_jenis_dokumen', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_jenis_dokumen'],
            ['name' => 'nama_dokumen', 'label' => 'Nama', 'sortable' => true, 'filter' => 'nama_dokumen'],
            ['name' => 'alias', 'label' => 'Alias', 'sortable' => true, 'filter' => 'alias'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('jenisdokumenedit', $src->id_jenis_dokumen) . '" class="btn btn-sm btn-warning" title="Edit Jenis Dokumen">' . $icon . '</a>
                            <a href="' . URL::route('jenisdokumenhapus', $src->id_jenis_dokumen) . '" class="btn btn-sm btn-danger" title="Hapus Jenis Dokumen" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}