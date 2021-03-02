<?php

namespace App\Models;

use App\Entities\Article;
use App\Entities\Toko;
use CodeIgniter\Model;
use Config\Services;

class TokoModel extends Model
{
    protected $table         = 'toko';
    protected $allowedFields = [
        'nama', 'logo', 'lokasi', 'deskripsi'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Toko';
    protected $useTimestamps = false;

    public function where($filter)
    {
        $this->builder()->where($filter);
    }
    public function search($filter)
    {
        $this->builder()->like('nama', $filter);
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Toko($_POST));
            post_file($item, 'logo');
           $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            /** @var Toko $item */
            $item->fill($_POST);
            post_file($item, 'logo');
            if ($item->hasChanged()) {
                $this->save($item);
            }
            return $id;
        }
        return false;
    }

}
