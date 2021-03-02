<?php

namespace App\Models;

use App\Entities\Article;
use App\Entities\Barang;
use CodeIgniter\Model;
use Config\Services;

class BarangModel extends Model
{
    protected $table         = 'barang';
    protected $allowedFields = [
        'nama', 'harga', 'logo', 'content', 'toko_id'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\Barang';
    protected $useTimestamps = false;

    public function withToko($id)
    {
        $this->builder()->where([
            'toko_id' => $id,
        ]);
            return $this;
    }

    public function search($filter)
    {
        $this->builder()->like('nama', $filter);
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new Barang($_POST));
            post_file($item, 'logo');
            $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            /** @var Barang $item */
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
