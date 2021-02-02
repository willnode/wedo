<?php

namespace App\Models;

use App\Entities\Article;
use App\Entities\Barang;
use App\Entities\Cart;
use CodeIgniter\Model;
use Config\Services;

class CartModel extends Model
{
    protected $table         = 'cart';
    protected $allowedFields = [
        'user_id', 'barang_id', 'qty'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Cart';
    protected $useTimestamps = true;

    public function withToko($id)
    {
        $this->builder()->where([
            'toko_id' => $id,
        ]);
        return $this;
    }

    public function withUser($id)
    {
        $this->builder()->where([
            'user_id' => $id,
        ]);
        return $this;
    }

    public static function getTotal(array $cart)
    {
        return array_sum(array_map(function ($x) {
            return $x->total ?? $x->qty * $x->barang->harga;
        }, $cart));
    }


    /** @return Cart[] */
    public function asCart()
    {
        $this->builder()->join('barang', 'barang.id = cart.barang_id');
        return $this->findAll();
    }

    public function with($filter)
    {
        $this->builder()->where($filter);
        return $this;
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Cart($_POST));
            $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            /** @var Cart $item */
            $item->fill($_POST);
            if ($item->hasChanged()) {
                $this->save($item);
            }
            return $id;
        }
        return false;
    }
}
