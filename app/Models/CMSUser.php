<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class CmsUser extends Authenticatable
{
     use Notifiable;

    protected $table = 'cms_users';

    protected $fillable = ['user', 'password'];

    // Get the attributes that should be cast.
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }
}
