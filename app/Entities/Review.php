<?php

namespace App\Entities;

use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property int $rating
 * @property int $barang_id
 * @property int $user_id
 * @property string $content
 * @property User $user
 * @property Toko $toko
 * @property Time $created_at
 * @property Time $updated_at
 */
class Review extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'rating' => 'integer',
        'barang_id' => 'integer',
        'user_id' => 'integer',
    ];

    public function getUser()
    {
        return (new UserModel())->find($this->user_id);
    }

    public function getToko()
    {
        return (new TokoModel())->find($this->user_id);
    }

}
