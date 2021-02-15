<?php

namespace App\Libraries;

use App\Entities\Cart;
use CodeIgniter\Commands\Server\Serve;
use CodeIgniter\Config\Config;
use Config\Services;

class CartProcessor
{
    protected static $savedCart = [];

    /** @return Cart[] */
    public static function load()
    {
        if (static::$savedCart) {
            return static::$savedCart;
        }
        $ses = Services::session();
        if (($cart = $ses->get('cart')) && is_array($cart)) {
            return static::$savedCart = array_map(function ($x)
            {
                return new Cart($x);
            }, $cart);
        }
        return [];
    }

    public static function add(Cart $cart)
    {
        static::load();
        static::$savedCart[] = $cart;
    }

    public static function delete($barang_id = null)
    {
        foreach (static::load() as $k => $c) {
            if (!$barang_id || $c->barang_id == $barang_id) {
                unset(static::$savedCart[$k]);
            }
        }
    }

    public static function save()
    {
        Services::session()->set('cart', array_map(function ($x)
        {
            return $x->toArray();
        }, static::$savedCart));
    }

    /** @param Cart $cart */
    public static function find($barang_id)
    {
        foreach (static::load() as $c) {
            if ($c->barang_id == $barang_id) {
                return $c;
            }
        }
        return null;
    }

}
