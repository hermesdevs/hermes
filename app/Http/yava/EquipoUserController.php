<?php

namespace App\Http\Controllers;

use App\User;
use App\Equipo;

use Illuminate\Http\Request;

class EquipoUserController extends Controller
{

    //====================================
    // User --> Equipo
    //====================================
    public function UserEquipo($id){

        $u = User::Find($id);

        if($u){
            $equipo = $u->equipo;
            return $this->Respuesta($equipo, 200);
        }

        return "La cagaste , vuelve hacerlo"; 
    }


    //====================================
    // Equipo --> User
    //====================================
    public function EquipoUserShow($id){

        $e = Equipo::Find($id);

        if($e){
            $user = $e->user;
            return $this->Respuesta($user, 200);
        }

        return "La cagaste , vuelve hacerlo";
    }

    public function EquipoUserCreate(Request $request, $equipo_id, $user_id){
        $e = Equipo::Find($equipo_id);
        if ($e) {            
            $u = User::Find($user_id);
            if($u){
                $users = $e->user();
                if ($users->find($user_id)) {
                    return $this->Respuesta("EL Usuario $user_id ya fue asignado al equipo $equipo_id",409);
                }
                $e->user()->attach($user_id);
                return $this->Respuesta("EL equipo $equipo_id fue asignado al $user_id",201);
            }
            return $this->RespuestaError("EL usuario $user_id no existe",404);
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    // public function EquipoUserCreate($equipo_id, $user_id){
    //     $e = Equipo::Find($equipo_id);
    //     if($e){            
    //         $reglas = [
    //             'name' => 'required',
    //             'so' => 'required',
    //             'brand' => 'required',
    //             'model' => 'required',
    //             'mac' => 'required',
    //             'ip' => 'required'
    //         ];

    //         $this->validate($request, $reglas);
    //         Equipo::create($request->all());
    //         return $this->Respuesta("EL equipo $equipo_id se creo exitosamente ", 200);
    //     }    
    //     return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    // }

    public function EquipoUserUpdate(Request $request, $equipo_id, $user_id){
        $e = Equipo::Find($equipo_id);
        if($e){
            $u = User::Find($user_id);
            if($u){
                return $this->RespuestaError("No puedes editar los datos del usuario $user_id por un equipo", 409);
            }
            return $this->RespuestaError("no se encontro el usurio $equipo_id", 404);
        }
        return $this->RespuestaError("no se encontro el equipo $equipo_id", 404);
    }
    
    public function EquipoUserDelete($equipo_id , $user_id){
    
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

    //====================================
    // User --> Equipo , todos los usuarios con su relacion con equipos 
    //====================================
    public function allUserWithEquipos(Request $request){
        return User::with('equipo')->get();    
    }

    //====================================
    // Equipo --> User , todos los equipos con su relacion con usuarios 
    //====================================
    public function allEquiposWithUser(Request $request){
        return Equipo::with('user')->get();    
    }

}