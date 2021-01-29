<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;
use Config\Services;

class PenjualanModel extends Model
{
    protected $table         = 'penjualan';
    protected $allowedFields = [
        'user_id', 'toko_id', 'nota', 'status'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Penjualan';
    protected $useTimestamps = true;

}
