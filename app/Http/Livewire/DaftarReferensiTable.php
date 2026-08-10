<?php

namespace App\Http\Livewire;

use URL;

class DaftarReferensiTable extends IndexTable
{
    protected $module = 'referensi';

    protected $name = 'DaftarReferensi';

    protected $defaultSort = ['id_referensi', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Daftar Referensi', 'url' => route('daftarreferensicreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_referensi', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_referensi'],
            ['name' => 'kode_referensi', 'label' => 'Kode Referensi', 'sortable' => true, 'filter' => 'kode_referensi'],
            ['name' => 'keterangan_referensi', 'label' => 'Keterangan Referensi', 'sortable' => true, 'filter' => 'keterangan_referensi'],
            ['name' => 'flag_buku_kas', 'label' => 'Buku Kas', 'sortable' => true, 'filter' => 'flag_buku_kas'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '120px',                 'html' => function ($src) {
                    $icon = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('daftarreferensiedit', $src->id_referensi) . '" class="btn btn-sm btn-warning" title="Edit Daftar Referensi">' . $icon . '</a>
                            <a href="' . URL::route('daftarreferensihapus', $src->id_referensi) . '" class="btn btn-sm btn-danger" title="Hapus Daftar Referensi" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}