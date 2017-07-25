<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function index(){
        $u = User::all();
        return $this->Respuesta($u, 200);    
    }

    public function show($user_id){

        $u = User::Find($user_id);

        if ($u) {
            return $this->Respuesta($u, 200);
        }

        return $this->RespuestaError("El usuario $user_id no existe", 404);
    }
    
    public function create(Request $request){

        $reglas = [
            'password' => 'required',
            'remember_token' => 'required',
            'mail' => 'required',
            'super_permission' => 'required'
        ];
        
        $this->validate($request, $reglas);

        $user = User::create($request->all());
        User::create($request->all());
    
        return $this->Respuesta($user, 201);
    }

    public function update(Request $request, $id){
        $u = User::Find($id);
        if ($u) {

            $reglas = [
                'name' => 'required',
                // 'profileImage' => 'required',
                // 'token' => 'required',
                // 'date' => 'required',
                'mail' => 'required',
                // 'phone' => 'required',
                'super_permission' => 'required'
            ];
                
            $this->validate($request, $reglas);

            $u->name = $request->get('name');
            $u->profileImage = $request->get('profileImage');
            // $u->token = $request->get('token');
            $u->date = $request->get('date');
            $u->mail = $request->get('mail');
            $u->phone = $request->get('phone');
            $u->super_permission = $request->get('super_permission');

            $u->save();

            return $this->Respuesta("El usuario $id se edito correctamente", 201); 
        
        }
        return $this->RespuestaError("El usuario $id no existe", 404);
    }

    public function destroy($id){
        $u = User::Find($id);
        
        if($u){
            $u->equipo()->sync([]);
            $u->delete();
            return $this->Respuesta("El usuario $id se elimino", 201);
        }

        return $this->RespuestaError("El usuario $id no existe", 404);
    }


}