<?php

namespace App\Models;

use App\Entities\Article;
use App\Entities\Review;
use CodeIgniter\Model;
use Config\Services;

class ReviewModel extends Model
{
    protected $table         = 'review';
    protected $allowedFields = [
        'barang_id', 'nama', 'email', 'content', 'rating'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Review';
    protected $useTimestamps = true;


    public function withBarang($id)
    {
        $this->builder()->where([
            'barang_id' => $id,
        ]);
        return $this;
    }

    /** @return Review */
    public function atBarangUser($barang_id, $email)
    {
        $this->builder()->where([
            'barang_id' => $barang_id,
            'email' => $email,
        ]);
        return $this->findAll()[0] ?? null;
    }
}
