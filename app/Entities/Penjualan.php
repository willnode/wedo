<?php

namespace App\Entities;

use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property string $nama
 * @property string $email
 * @property string $hp
 * @property string $linkHp
 * @property string $alamat
 * @property int $total
 * @property string $rpTotal
 * @property Cart[] $nota
 * @property string $status
 * @property Time $created_at
 * @property Time $updated_at
 */
class Penjualan extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'total' => 'integer',
        'nota' => 'json',
    ];

    public function getLinkHp()
    {
        return HP2WA($this->hp);
    }
    public function getRpTotal()
    {
        return rupiah($this->total);
    }
}
