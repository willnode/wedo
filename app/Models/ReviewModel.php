<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;
use Config\Services;

class ReviewModel extends Model
{
    protected $table         = 'review';
    protected $allowedFields = [
        'barang_id', 'user_id', 'content', 'rating'
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

}
