<?php

namespace App\Entities;

use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $toko_id
 * @property int $user_id
 * @property string $content
 * @property Time $created_at
 * @property Time $updated_at
 */
class Review extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'toko_id' => 'integer',
        'user_id' => 'integer',
    ];
}
