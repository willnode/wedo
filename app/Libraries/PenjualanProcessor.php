<?php

namespace App\Libraries;

class PenjualanProcessor extends BaseExcelProcessor
{

    public $table = 'penjualan';

    public $columns = [
        [
            'key' => 'id',
            'title' => '#',
        ], [
            'key' => 'nama',
            'title' => 'Nama Customer',
        ], [
            'key' => 'status',
            'title' => 'Status',
        ], [
            'key' => 'ongkir',
            'title' => 'Ongkir',
        ], [
            'key' => 'total',
            'title' => 'Total',
        ], [
            'key' => 'kurir',
            'title' => 'Kurir',
        ], [
            'key' => 'alamat',
            'title' => 'Alamat',
        ], [
            'key' => 'created_at',
            'title' => 'Waktu Pesanan',
        ]
    ];
}