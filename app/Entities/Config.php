<?php

namespace App\Entities;

use App\Models\BarangModel;
use App\Models\TokoModel;
use App\Models\UserModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;
use Config\Database;

/**
 * @property string $kecamatan_dalam
 * @property string $kecamatan_luar
 * @property int $ongkir_dalam
 * @property int $ongkir_luar
 * @property string $operasional_buka
 * @property string $operasional_tutup
 * @property string $agen_kurir
 * @property string $link_wefood
 * @property string $link_webox
 * @property string $link_wetrans
 * @property string $link_custom_order
 * @property string $link_feedback
 */
class Config extends Entity
{
    protected $casts = [
        'ongkir_dalam' => 'integer',
        'ongkir_luar' => 'integer',
        'banner' => 'json-array',
    ];

    public function isOpen()
    {
        return time() > strtotime($this->operasional_buka) && time() < strtotime($this->operasional_tutup);
    }

    private static ?Config $cache = null;

    public static function get()
    {
        if (static::$cache)
            return static::$cache;
        $d = Database::connect()->table('config')->get()->getResult();
        $c = new Config();
        foreach ($d as $r) {
            $c->attributes[$r->key] = $r->value;
        }
        $c->original = $c->attributes;
        return static::$cache = $c;
    }

    public function save()
    {
        $table = Database::connect()->table('config');
        foreach ($this->toRawArray(true) as $key => $value) {
            $table->replace(['key' => $key, 'value' => $value]);
        }
    }
}
