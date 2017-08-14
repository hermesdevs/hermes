<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class AuthController extends Controller
{
	public function index()
	{
		# code...
    	return "Autenticate para consumir esta aplicacion";
	}

	//-----------
	// La niña
	//-----------
	public function login(Request $request)
	{
        $reglas = [
            'mail' => 'required',
            'password' => 'required'
        ];
        
        $this->validate($request, $reglas);

		$user = User::where('mail', $request->get('mail') )->get(['id','name','remember_token','pass']);

		if (count($user)==0){
	        return $this->RespuestaError("No hay un usuario registrado con el correo solicitado", 404);
		}
        if ($user[0]->pass == $request->get('password')) {
            return $this->Respuesta($user, 201);
		}

        return $this->RespuestaError("La contraseña es incorrecta", 402);

	}

	public function register(Request $request)
	{
        
        $reglas = [
            'name' => 'required',
            'pass' => 'required',
            'mail' => 'required',
            'remember_token' => 'required',
            'super_permission' => 'required'
        ];

        $this->validate($request, $reglas);

		$user = User::where('mail', $request->get('mail') )->get(['id','name','remember_token','pass']);

		if (count($user) > 0) {
			return $this->RespuestaError("Hay un usuario registrado con el correo que solicitaste", 402);
		}        

		// $u;	
		// $u->name = $request->get('name');
		// $u->pass = Hash::make($request->get('pass'));
		// $u->mail = $request->get('mail');
		// $u->remember_token = $request->get('remember_token');
		// $u->super_permission = $request->get('super_permission');
		// return $this->Respuesta($u, 201);

        $userBack = User::create($request->all());
		User::create($request->all());
		return $this->Respuesta($userBack, 201);

	}
	
	public function forget()
	{
		# code...
		return "hola mundo forget";
	}

}
