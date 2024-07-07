<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;

class User extends Model implements Authenticatable
{
    use HasFactory, AuthenticatableTrait;

    protected $fillable = ['nama', 'username', 'password', 'id_role'];

    protected $hidden = ['password'];

    public function role()
    {
        return $this->belongsTo(Role::class, 'id_role');
    }
}
