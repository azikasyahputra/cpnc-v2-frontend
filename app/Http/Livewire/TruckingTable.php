<?php

namespace App\Http\Livewire;

use URL;

class TruckingTable extends IndexTable
{
    protected $module = 'trucking';

    protected $name = 'Ordertrucking';

    protected $defaultSort = ['id_order_trucking', 'desc'];

    protected function addButton()
    {
        return ['label' => 'Tambah Order Trucking', 'url' => route('truckingcreate')];
    }

    protected function columns(): array
    {
        return [
            ['name' => 'no_invoice', 'label' => 'ID', 'width' => '150px', 'sortable' => true, 'filter' => 'no_invoice'],
            ['name' => 'nama_client', 'label' => 'Nama Klien', 'sortable' => true, 'filter' => 'nama_client'],
            ['name' => 'tanggal_order', 'label' => 'Tanggal', 'width' => '120px', 'sortable' => true, 'filter' => 'tanggal_order'],
            ['name' => 'flag_pengeluaran', 'label' => 'Uang Jalan', 'width' => '120px', 'sortable' => true, 'filter' => 'flag_pengeluaran'],
            ['name' => 'flag_bayar', 'label' => 'Lunas', 'width' => '120px', 'sortable' => true, 'filter' => 'flag_bayar'],
            ['name' => 'Action', 'label' => 'Action', 'width' => '200px',                 'html' => function ($src) {
                    $lunas = '';
                    $belumlunas = '';
                    if ($src->flag_bayar == 'Belum') {
                        $lunas = '<a href="' . URL::route('truckinglunas', $src->id_order_trucking) . '" class="btn btn-sm btn-info" title="Lunas"><i class="bx bx-money"></i></a>';
                    }
                    if ($src->flag_pengeluaran == 'Belum') {
                        $belumlunas = '<a href="' . URL::route('truckingkasbonjalan', $src->id_order_trucking) . '" class="btn btn-sm btn-success" title="Buat Pengeluaran"><i class="bx bx-plus"></i></a>';
                    }
                    $icon = '<i class="bx bx-detail"></i>';
                    $iconD = '<i class="bx bx-edit-alt"></i>';
                    $iconX = '<i class="bx bx-trash"></i>';
                    return '
                        <div class="btn-edit">
                            <a href="' . URL::route('truckingdetail', $src->id_order_trucking) . '" class="btn btn-sm btn-primary" title="Detail Order Trucking">' . $icon . '</a>
                            ' . $lunas . ' ' . $belumlunas . '
                            <a href="' . URL::route('truckingedit', $src->id_order_trucking) . '" class="btn btn-sm btn-warning" title="Edit Order Trucking">' . $iconD . '</a>
                            <a href="' . URL::route('truckinghapus', $src->id_order_trucking) . '" class="btn btn-sm btn-danger" title="Hapus Order" onclick="return confirm (\'anda akan hapus data?\');">' . $iconX . '</a>
                        </div>';
                }],
        ];
    }
}