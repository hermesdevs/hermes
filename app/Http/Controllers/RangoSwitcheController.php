<?php

namespace App\Http\Controllers;

use App\Switche;
use App\Rango;
use Illuminate\Http\Request;

class RangoSwitcheController extends Controller{

    public function index($id){
        $sw = Switche::Find($id);
        if($sw){
            $r = $sw->rango;
            return $this->Respuesta($r, 200);
        }
        return $this->RespuestaError("Este Switche no esta conectado a ningun rango", 404);
    }

    public function create($rango_id , $switche_id){        
        //busco el id del equipo
        $sw = Switche::Find($switche_id);
        // compruebo si existe
        if ($sw) {
            // si esxiste todo bien continuo
            
            // busco el id del usuario
            $rango = Rango::Find($rango_id);
            if($rango){

                $rangos = $sw->rango();
                if ($rangos->find($rango_id)) {
                    # code...
                    return $this->Respuesta("EL Rango $rango_id ya fue asignado al switche $switche_id",409);
                }
                // si esxiste todo bien continuo
                // desde el Modelo Equipo que encontre busco la tabla pivote que me enlasa los equipos con los usuarios y los attachsco XD
                $sw->rango()->attach($rango_id);
                // todo bien sigo con mi vida y me como una arepa T.T
                return $this->Respuesta("El switche $switche_id fue asignado al $rango_id",201);
            }

            // el usuario no existio 
            return $this->RespuestaError("EL usuario $rango_id no existe",404);

        }
        // el equipo no existio 
        return $this->RespuestaError("EL Switche $switche_id no existe ", 404);
    }

    public function update(Request $request, $switche_id , $rango_id){
        $switche = Switche::Find($switche_id);
        if ($switche) {   
            $rango = Rango::Find($rango_id);
            if($rango){
                $reglas = [
                    'rango_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $rangoCambio = $request->get('rango_id');
                $rangos = $switche->rango();
                if ($rangos->find($rangoCambio)){
                    return $this->Respuesta("EL rango $rangoCambio ya esta asignado al switche $switche_id",409);
                }

                $switche->rango()->updateExistingPivot($rango_id, array(
                    'rango_id' => $request->get('rango_id')
                ));
                return $this->Respuesta('El rango fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL switche $switche_id no existe ", 404);
    }

    public function destroy($switche_id , $rango_id){    
        //buscas el servidor
        $switche = Switche::Find($switche_id);
        if($switche){
            $rangos = $switche->rango();
            //buscas el usuario
            if ($rangos->find($rango_id)){
                //eliminamos la relacion
                $rangos->detach($rango_id);
                return $this->Respuesta("El rango $rango_id se elimino del switche $switche_id",200);
            }
            // npi del rango
            return $this->RespuestaError("No se encontro el rango",404);
        }
        // npi del sw se escapo XD
        return $this->RespuestaError("No se encontror el switche",404);
    }

}