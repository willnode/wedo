<?php

namespace App\Models;

use App\Entities\Article;
use App\Entities\Cart;
use App\Entities\Config;
use App\Entities\Penjualan;
use CodeIgniter\Model;
use Config\Database;
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
        'nama', 'email', 'hp', 'alamat', 'nota', 'status', 'total', 'ongkir', 'kurir'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Penjualan';
    protected $useTimestamps = true;

    public function withUser($hp)
    {
        $this->builder()->where([
            'hp' => $hp,
        ]);
        return $this;
    }
    public function with($filter)
    {
        $this->builder()->where($filter);
        return $this;
    }

    public function aggregate()
    {
        return Database::connect()->query(
            "SELECT
            week(created_at) as week,
            min(created_at) as min_date,
            max(created_at) as max_date,
            SUM(total) AS gross,
            COUNT(*) AS qty
                FROM penjualan
                WHERE status = 'diterima'
                GROUP BY WEEK(created_at)"
        )->getResult();
    }

    /** @param Cart[] $cart */
    public static function makePenjualan(array $cart, array $data)
    {
        $item = new Penjualan();
        if ($data['hp'] ?? '') {
            $data['hp'] = normHP($data['hp'] ?? '');
        }
        $item->nama = $data['nama'] ?? '';
        $item->hp = $data['hp'] ?? '';
        $item->alamat = ($data['alamat'] ?? '').', '.($data['alamat_kota'] ?? '').', '.($data['alamat_kab'] ?? '');
        foreach ($data as $key => $value) {
            Services::session()->set($key, $value);
        }
        $item->nota = array_map(function ($x) {
            $d = $x->toArray();
            $d['barang'] = $x->barang->toArray();
            $x->harga = $d['barang']['harga'];
            return $d;
        }, $cart);
        $item->ongkir = startsWith($data['alamat_kota'], 'Kecamatan') ? Config::get()->ongkir_luar : Config::get()->ongkir_dalam;
        $item->total = CartModel::getTotal($cart) + $item->ongkir;
        $item->status = 'menunggu';
        return $item;
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Penjualan($_POST));
            return $this->insert($item);
        } else if ($item = $this->find($id)) {
            /** @var Penjualan $item */
            $item->fill($_POST);
            if ($item->hasChanged()) {
                $this->save($item);
            }
            return $id;
        }
        return false;
    }
}
