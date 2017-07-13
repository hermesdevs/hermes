<?php
namespace App\Http\Controllers;

use App\Puerto;
use App\Equipo;
use Illuminate\Http\Request;

class PuertoEquipoController extends Controller
{

    public function index($id){
        $puerto = Puerto::find($id);
        if ($puerto) {
            $equipos = $puerto->equipo;
            if(count($equipos)==0) {
                return $this->RespuestaError("EL puerto $id no tiene equipos asignados",404);
            }
            return $this->Respuesta($puerto, 200);
        }
        return $this->RespuestaError("El puerto $puerto_id no existe", 404);
    }


    public function create($equipo_id , $puerto_id){
        $equipo = Equipo::Find($equipo_id);
        if($equipo){
            //ve si existe

            $puerto = Puerto::Find($puerto_id);
            if($puerto){
                $puertos = $equipo->puerto();
                if($puertos->find($puerto_id)) {
                    return $this->Respuesta("EL equipo $equipo_id ya tiene el puerto $puerto_id",409);
                }
                $equipo->puerto()->attach($puerto_id);
                return $this->RespuestaError("El equipo $equipo_id tiene el puerto $puerto_id",201);
            }
            return $this->Respuesta("el puerto $puerto_id no existe",409);
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    public function update(Request $request, $equipo_id, $puerto_id){
        $equipo = Equipo::Find($equipo_id);
        if ($equipo) {   
            $puerto = Puerto::Find($puerto_id);
            if($puerto){
                $reglas = [
                    'puerto_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $puertoCambio = $request->get('puerto_id');
                $puertos = $equipo->puerto();
                if ($puertos->find($puertoCambio)){
                    return $this->Respuesta("EL puerto $puertoCambio ya esta asignado al equipo $equipo_id",409);
                }

                $equipo->puerto()->updateExistingPivot($puerto_id, array(
                    'puerto_id' => $request->get('puerto_id')
                ));
                return $this->Respuesta('El puerto fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    public function destroy($equipo_id , $puerto_id){    
        //buscas el equipo
        $equipo = Equipo::Find($equipo_id);
        if($equipo){
            $puertos = $equipo->puerto();
            //buscas el usuario
            if ($puertos->find($puerto_id)){
                //eliminamos la relacion
                $puertos->detach($puerto_id);
                return $this->Respuesta("El puerto $puerto_id se elimino del equipo $equipo_id",200);
            }
            // npi del usuario
            return $this->RespuestaError("No se encontro el puerto",404);
        }
        // npi del equipo se escapo XD
        return $this->RespuestaError("No se encontror el equipo",404);
    }

}

