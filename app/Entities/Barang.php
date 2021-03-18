<?php

namespace App\Entities;

use App\Models\ReviewModel;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;

/**
 * @property int $id
 * @property string $nama
 * @property int $harga
 * @property string[] $logo
 * @property string $content
 * @property Toko $toko
 * @property Review[] $reviews
 * @property int $toko_id
 */
class Barang extends Entity
{
    protected $casts = [
        'id' => 'integer',
        'harga' => 'integer',
        'toko_id' => 'integer',
        'logo' => 'json-array',
    ];

    public function getToko()
    {
        return (new TokoModel())->find($this->toko_id);
    }

    /** @return Review[] */
    public function getReviews()
    {
        return (new ReviewModel())->withBarang($this->id)->findAll();
    }
}
