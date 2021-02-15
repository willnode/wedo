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
 * @property string $nama
 * @property string $email
 * @property string $content
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
    ];

    public function getAvatarUrl()
    {
        if ($this->avatar)
            return '/uploads/avatar/' . $this->avatar;
        else
            return get_gravatar($this->nohp, 80, 'identicon');
    }
}
