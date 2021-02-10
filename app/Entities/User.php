<?php

namespace App\Entities;

use CodeIgniter\Entity;

/**
 * @property int $id
 * @property string $name
 * @property string $nohp
 * @property string $alamat
 * @property string $avatar
 * @property string $password
 * @property string $role
 */
class User extends Entity
{
    protected $casts = [
        'id' => 'integer',
    ];

    public function sendVerifyEmail()
    {
        // TODO
    }
    public function getAvatarUrl()
    {
        if ($this->avatar)
            return '/uploads/avatar/' . $this->avatar;
        else
            return get_gravatar($this->nohp, 80, 'identicon');
    }
    public function discardPassword()
    {
        $this->attributes['password'] = $this->original['password'];
    }
}
