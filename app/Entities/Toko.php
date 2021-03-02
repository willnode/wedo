<?php

namespace App\Entities;

use App\Models\BarangModel;
use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property string $nama
 * @property string $logo
 * @property string $lokasi
 * @property string $deskripsi
 */
class Toko extends Entity
{
    protected $casts = [
        'id' => 'integer',
    ];
    /**
    * @return Barang[]
    */
    public function getBarang()
    {
        return (new BarangModel())->withToko($this->id)->findAll();
    }
}

