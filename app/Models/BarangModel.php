<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;
use Config\Services;

class BarangModel extends Model
{
    protected $table         = 'barang';
    protected $allowedFields = [
        'nama','harga', 'logo', 'content', 'toko_id'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Barang';
    protected $useTimestamps = false;

}
