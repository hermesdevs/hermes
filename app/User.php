<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
	use AuthenticatableContract , AuthorizableContract;
	    
    protected $fillable = ['name', 'profileImage', 'token', 'date', 'mail', 'phone', 'super_permission'];

    protected $hidden = ['password', 'pass', 'created_at', 'updated_at'];
 
    function equipo(){
        return $this->belongsToMany('App\Equipo');
    }
}
