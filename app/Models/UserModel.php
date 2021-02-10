<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;
use Config\Services;

class UserModel extends Model
{
    public static $roles = [
        'user',
        'admin',
    ];

    protected $table         = 'user';
    protected $allowedFields = [
        'name', 'nohp', 'password', 'avatar', 'role', 'alamat'
    ];
    protected $primaryKey = 'id';
    protected $returnType = 'App\Entities\User';
    protected $useTimestamps = false;

    /** @return User|null */
    public function atEmail($nohp)
    {
        $this->builder()->where('nohp', $nohp);
        return $this->find()[0] ?? null;
    }

    public function login(User $data)
    {
        $s = Services::session();
        $s->set('login', $data->id);
    }

    /** @return int|null */
    public function register($data, $thenLogin = true)
    {
        $data = array_intersect_key($data, array_flip(
            ['name', 'nohp', 'password', 'alamat']
        ));
        $data['role'] = 'user';
        if (!empty($data['password']))
            $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        if ($this->save($data)) {
            if ($thenLogin) {
                Services::session()->set('login', $this->insertID);
                Services::session()->set('name', $data['name'] ?? '');
                Services::session()->set('nohp', $data['nohp'] ?? '');
            }
            return $this->insertID;
        }
        return null;
    }

    public function processWeb($id)
    {
        if ($id === null) {
            $item = (new User($_POST));
            post_file($item, 'avatar');
            $item->password = password_hash($item->password, PASSWORD_BCRYPT);
            $id = $this->insert($item);
            return $id;
        } else if ($item = $this->find($id)) {
            /** @var User $item */
            $item->fill($_POST);
            post_file($item, 'avatar');
            if ($item->hasChanged()) {
                if (!$item->password) {
                    $item->discardPassword();
                } else {
                    $item->password = password_hash($item->password, PASSWORD_BCRYPT);
                }
                $this->save($item);
            }
            return $id;
        }
        return false;
    }
}
