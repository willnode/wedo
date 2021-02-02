<?php

namespace App\Models;

use App\Entities\Article;
use App\Entities\Cart;
use App\Entities\Penjualan;
use CodeIgniter\Model;
use Config\Services;

class PenjualanModel extends Model
{
    public static $statuses = [
        'menunggu', 'diproses', 'diterima', 'dibatalkan'
    ];

    public static $statusesInHtml = [
        'menunggu' => '<span class="badge badge-info">Menunggu Respon</span>',
        'diproses' => '<span class="badge badge-warning">Sedang Diproses</span>',
        'diterima' => '<span class="badge badge-success">Sudah Diterima</span>',
        'dibatalkan' => '<span class="badge badge-warning">Dibatalkan</span>',
    ];

    protected $table         = 'penjualan';
    protected $allowedFields = [
        'user_id', 'nota', 'status', 'total'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Penjualan';
    protected $useTimestamps = true;

    public function withUser($user_id)
    {
        $this->builder()->where([
            'user_id' => $user_id,
        ]);
        return $this;
    }

    /** @param Cart[] $cart */
    public static function makePenjualan(array $cart, $user_id)
    {
        $item = new Penjualan();
        $item->user_id = $user_id;
        $item->nota = array_map(function ($x) {
            $d = $x->toArray();
            $d['barang'] = $x->barang->toArray();
            $x->harga = $d['barang']['harga'];
            return $d;
        }, $cart);
        $item->total = CartModel::getTotal($cart);
        $item->status = 'menunggu';
        return $item;
    }
}
