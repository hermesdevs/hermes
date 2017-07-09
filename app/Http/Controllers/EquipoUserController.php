<?php

namespace App\Http\Controllers;
use App\User;
use App\Equipo;
use Illuminate\Http\Request;

class EquipoUserController extends Controller
{

    public function index($equipo_id){
        $equipo = Equipo::Find($equipo_id);
        if($equipo){
            $user = $equipo->user;
            return response()->json(['data'=>$user],200);
        }
        return $this->RespuestaError("El equipo $id no existe", 404);
    }

    public function create($equipo_id , $user_id){
            
        //busco el id del equipo
        $e = Equipo::Find($equipo_id);
        // compruebo si existe
        if ($e) {
            // si esxiste todo bien continuo
            
            // busco el id del usuario
            $u = User::Find($user_id);
            if($u){

                $users = $e->user();
                if ($users->find($user_id)) {
                    # code...
                    return $this->Respuesta("EL Usuario $user_id ya fue asignado al equipo $equipo_id",409);
                }
                // si esxiste todo bien continuo
                // desde el Modelo Equipo que encontre busco la tabla pivote que me enlasa los equipos con los usuarios y los attachsco XD
                $e->user()->attach($user_id);
                // todo bien sigo con mi vida y me como una arepa T.T
                return $this->Respuesta("EL equipo $equipo_id fue asignado al $user_id",201);
            }

            // el usuario no existio 
            return $this->RespuestaError("EL usuario $user_id no existe",404);

        }
        // el equipo no existio 
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }
    

    public function update(Request $request, $equipo_id, $user_id){
        $equipo = Equipo::Find($equipo_id);
        if($equipo){
            $user = User::Find($user_id);
            if($user){
                $reglas = [
                    'user_id' => 'required'
                ];
                $this->validate($request, $reglas);
 
                $userCambio = $request->get('user_id');
                $usuarios = $equipo->user();
                if ($usuarios->find($userCambio)){
                    return $this->Respuesta("EL user $userCambio ya esta asignado al equipo $equipo_id",409);
                }
                $equipo->user()->updateExistingPivot($swtiche_id, array(
                    'user_id' => $request->get('user_id')
                ));

                return $this->Respuesta('La asignacion del equipo fue actualizado', 201);
            
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    public function destroy($equipo_id , $user_id){    
        //buscas el equipo
        $e = Equipo::Find($equipo_id);
        if($e){
            $users = $e->user();
            //buscas el usuario
            if ($users->find($user_id)){
                //eliminamos la relacion
                $users->detach($user_id);
                return $this->Respuesta("El usuario $user_id se elimino del equipo $equipo_id",200);
            }
            // npi del usuario
            return $this->RespuestaError("No se encontro el usuario",404);
        }
        // npi del equipo se escapo XD
        return $this->RespuestaError("No se encontror el equipo",404);
    }

}