<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Switche extends Model
{
	protected $fillable = ['id','name','modelo','so','ip'];
	protected $hidden = ['created_at','updated_at'];
	protected $table = 'switches';


	function equipo(){
		return $this->belongsToMany('App\Equipo');
	}

	function servidor(){
		return $this->belongsToMany('App\Servidor');
	}

	function puerto(){
		return $this->belongsToMany('App\Puerto');
	}

	function rango(){
		return $this->belongsToMany('App\Rango');
	}

}