<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Vlan extends Model
{
	protected $fillable = ['name','rango_init','rango_end'];

	protected $hidden = ['id','created_at','updated_at'];

	function puerto(){
		return $this->belongsTo('App\Puerto');
	}

}