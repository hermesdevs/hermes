<?php

namespace App\Http\Controllers;

use App\Switche;
use App\Puerto;

use Illuminate\Http\Request;

class SwitchePuertoController extends Controller
{
 
    public function index($id){
        $switche = Switche::find($id);
        if($switche){
            $puerto = $switche->puerto;
            return response()->json(['data'=>$puerto],200);
        }
        return "la cagaste nojoda";
    }
    
    public function create($puerto_id , $switche_id){
            
        //busco el id del sw
        $sw = Switche::Find($switche_id);
        // compruebo si existe
        if ($sw) {
            // si esxiste todo bien continuo
            
            // busco el id del usuario
            $p = Puerto::Find($puerto_id);
            if($p){

                $puertos = $sw->puerto();
                if ($puertos->find($puerto_id)) {
                    # code...
                    return $this->Respuesta("EL puerto $puerto_id ya fue asignado al switche $switche_id",409);
                }
                // si esxiste todo bien continuo
                // desde el Modelo Equipo que encontre busco la tabla pivote que me enlasa los equipos con los usuarios y los attachsco XD
                $sw->puerto()->attach($puerto_id);
                // todo bien sigo con mi vida y me como una arepa T.T
                return $this->Respuesta("EL switche $switche_id fue asignado al puerto $puerto_id",201);
            }

            // el usuario no existio 
            return $this->RespuestaError("EL puerto $puerto_id no existe",404);

        }
        // el equipo no existio 
        return $this->RespuestaError("EL switche $switche_id no existe ", 404);
    }

    
    public function update(Request $request, $switche_id , $puerto_id){
        $switche = Switche::Find($switche_id);
        if ($switche) {   
            $puerto = Puerto::Find($puerto_id);
            if($puerto){
                $reglas = [
                    'puerto_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $puertoCambio = $request->get('puerto_id');
                $puertos = $switche->puerto();
                if ($puertos->find($puertoCambio)){
                    return $this->Respuesta("EL puerto $puertoCambio ya esta asignado al switche $switche_id",409);
                }

                $switche->puerto()->updateExistingPivot($puerto_id, array(
                    'puerto_id' => $request->get('puerto_id')
                ));
                return $this->Respuesta('El puerto fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    public function destroy($puerto_id , $switche_id){    
        //buscas el equipo
        $sw = Switche::Find($switche_id);
        if($sw){
            $puertos = $sw->puerto();
            //buscas el usuario
            if ($puertos->find($puerto_id)){
                //eliminamos la relacion
                $puertos->detach($puerto_id);
                return $this->Respuesta("El puerto $puerto_id se elimino del switche $switche_id",200);
            }
            // npi del usuario
            return $this->RespuestaError("No se encontro el puerto",404);
        }
        // npi del equipo se escapo XD
        return $this->RespuestaError("No se encontror el switche",404);
    }

    
}