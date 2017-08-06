<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

// class User extends Model implements AuthenticatableContract, AuthorizableContract
// {

class User extends Model {
	// use AuthenticatableContract , AuthorizableContract;
	    
    protected $fillable = ['name', 'profileImage', 'remember_token', 'pass', 'date', 'mail', 'phone', 'super_permission'];

    protected $hidden = ['pass','remember_token','created_at','updated_at'];
 
    function equipo(){
        return $this->belongsToMany('App\Equipo');
    }
}
