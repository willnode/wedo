<?php

namespace App\Entities;

use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property string $nama
 * @property int $harga
 * @property string $logo
 * @property string $content
 * @property int $toko_id
 */
class Barang extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'harga' => 'integer',
        'toko_id' => 'integer',
    ];

    
}
