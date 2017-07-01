<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Puerto extends Model
{
	protected $fillable = ['id','name','vlan_id'];

	protected $hidden = ['created_at','updated_at'];

	function equipo(){
		return $this->belongsToMany('App\Equipo');
	}
	
	function servidor(){
		return $this->belongsToMany('App\Servidor');
	}

	function switche(){
		return $this->belongsToMany('App\Switch');
	}

	function vlan(){
		return $this->belongsTo('App\Vlan');
	}

}