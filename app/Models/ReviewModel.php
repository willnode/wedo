<?php

namespace App\Models;

use App\Entities\Article;
use CodeIgniter\Model;
use Config\Services;

class ReviewModel extends Model
{
    protected $table         = 'review';
    protected $allowedFields = [
        'toko_id', 'user_id', 'content'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Review';
    protected $useTimestamps = true;

}
