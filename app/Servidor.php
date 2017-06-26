<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Laravel\Lumen\Auth\Authorizable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;

class Servidor extends Model
{
	protected $fillable = ['id','name','description','ip','mac'];

	protected $hidden = ['created_at','updated_at'];
	protected $table = 'servidores';

	function equipo(){
		return $this->belongsTo('App\Equipo');
	}

	function puerto(){
		return $this->belongsToMany('App\Puerto');
	}

}