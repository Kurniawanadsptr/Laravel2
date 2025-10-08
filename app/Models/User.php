<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
  use Notifiable;

  protected $fillable = ['id_user', 'username', 'password', 'role'];
  protected $primaryKey = 'id_user';
  protected $hidden = ['password'];

  public function getAuthIdentifierName()
  {
    return 'username';
  }

  public function hasRole($role)
  {
    return $this->role === $role;
  }
}
