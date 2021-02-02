<?php

namespace App\Entities;

use App\Models\BarangModel;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $user_id
 * @property int $barang_id
 * @property int $qty
 * @property Toko $toko
 * @property Barang $barang
 * @property Time $created_at
 * @property Time $updated_at
 */
class Cart extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'user_id' => 'integer',
        'barang_id' => 'integer',
        'qty' => 'integer',
    ];

    public function getToko()
    {
        return (new TokoModel())->find($this->toko_id);
    }
    public function getBarang()
    {
        return (new BarangModel())->find($this->barang_id);
    }
    public function getTotal()
    {
        return $this->harga * $this->qty;
    }
}
