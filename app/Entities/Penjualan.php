<?php

namespace App\Entities;

use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $user_id
 * @property int $total
 * @property User $user
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
        'user_id' => 'integer',
        'nota' => 'json',
    ];

    public function getUser()
    {
        return (new UserModel())->find($this->user_id);
    }
}
