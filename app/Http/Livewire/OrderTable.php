<?php

namespace App\Http\Livewire;

use URL;

class OrderTable extends IndexTable
{
    protected $module = 'order';

    protected $name = 'Order';

    protected $defaultSort = ['id_order', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Order', 'url' => route('ordercreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'id_order', 'label' => 'ID', 'width' => '10px', 'sortable' => true, 'filter' => 'id_order'],
            ['name' => 'no_order', 'label' => 'No.Order', 'sortable' => true, 'filter' => 'no_order'],
            ['name' => 'nama_client', 'label' => 'Nama Klien', 'sortable' => true, 'filter' => 'nama_client'],
            ['name' => 'nama_dokumen', 'label' => 'Jenis', 'width' => '100px', 'sortable' => true, 'filter' => 'nama_dokumen'],
            ['name' => 'tanggal_order', 'label' => 'Tanggal', 'width' => '120px', 'sortable' => true, 'filter' => 'tanggal_order'],
            ['name' => 'flag_invoice', 'label' => 'Invoice', 'width' => '100px', 'sortable' => true, 'filter' => 'flag_invoice'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '200px',                 'html' => function ($src) {
                    $buatinvoice = '';
                    if ($src->flag_invoice == 'Belum') {
                        $buatinvoice = '<a href="' . URL::route('invoicecreate', $src->id_order) . '" class="btn btn-sm btn-success" title="Buat Invoice"><i class="bx bx-plus"></i></a>';
                    }
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('orderdetail', $src->id_order) . '" class="btn btn-sm btn-primary" title="Detail Order">' . $icon . '</a>
                            ' . $buatinvoice . '
                            <a href="' . URL::route('orderedit', $src->id_order) . '" class="btn btn-sm btn-warning" title="Edit Order">' . $iconD . '</a>
                            <a href="' . URL::route('orderhapus', $src->id_order) . '" class="btn btn-sm btn-danger" title="Hapus Order" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}