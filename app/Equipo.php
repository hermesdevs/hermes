<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Equipo extends Model
{
	
	protected $fillable = ['id','name','so','brand','model','mac','ip'];

	protected $hidden = ['created_at','updated_at'];

	function puerto(){
		return $this->belongsToMany('App\Puerto');
	}

	function user(){
		return $this->belongsToMany('App\User');
	}

	function servidor(){
		return $this->belongsTo('App\Servidor');
	}

	function switch(){
		return $this->belongsToMany('App\Switch');
	}

	function vlan(){
		return $this->belongsToMany('App\Vlan');
	}

	function rango(){
		return $this->belongsToMany('App\Rango');
	}
}