<?php

namespace App\Http\Controllers;

use App\Servidor;
use App\Puerto;
use Illuminate\Http\Request;

class ServidorRangoController extends Controller
{

    public function index($servidor_id){

        $servidor = Servidor::find($id);
        if($servidor){
            $rango = $servidor->rango;
            return response()->json(['data'=>$rango],200);

        }
        return $this->RespuestaError("Este servidor no pertenece a ningun rango", 404);
    }    

    public function create($servidor_id , $rango_id){
            
        //busco el id del servidor
        $serv = Servidor::Find($servidor_id);
        // compruebo si existe
        if ($serv) {
            // si esxiste todo bien continuo
            
            // busco el id del rango
            $r = Rango::Find($rango_id);
            if($r){

                $rangos = $serv->rango();
                if ($rangos->find($rango_id)) {
                    # code...
                    return $this->Respuesta("EL Servidor $servidor_id ya fue asignado al rango $rango_id",409);
                }
                // si esxiste todo bien continuo
                // desde el Modelo Servidor que encontre busco la tabla pivote que me enlasa los servidors con los rangos y los attachsco XD
                $serv->rango()->attach($rango_id);
                // todo bien sigo con mi vida y me como una arepa T.T
                return $this->Respuesta("EL servidor $servidor_id fue asignado al  rango $rango_id",201);
            }

            // el rango no existio 
            return $this->RespuestaError("EL rango $user_id no existe",404);

        }
        // el servidor no existio 
        return $this->RespuestaError("EL Servidor $servidor_id no existe ", 404);
    }


    public function update(Request $request, $servidor_id , $rango_id){
        $servidor = Servidor::Find($servidor_id);
        if ($servidor) {   
            $rango = Rango::Find($rango_id);
            if($rango){
                $reglas = [
                    'rango_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $rangoCambio = $request->get('rango_id');
                $rangos = $servidor->rango();
                if ($rangos->find($rangoCambio)){
                    return $this->Respuesta("EL rango $rangoCambio ya esta asignado al servidor $servidor_id",409);
                }

                $servidor->rango()->updateExistingPivot($rango_id, array(
                    'rango_id' => $request->get('rango_id')
                ));
                return $this->Respuesta('El rango fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL servidor $servidor_id no existe ", 404);
    }


    public function destroy($servidor_id , $rango_id){    
        //buscas el servidor
        $serv = Servidor::Find($servidor_id);
        if($serv){
            $rangos = $serv->rango();
            //buscas el usuario
            if ($rangos->find($rango_id)){
                //eliminamos la relacion
                $rangos->detach($rango_id);
                return $this->Respuesta("El rango $rango_id se elimino del servidor $servidor_id",200);
            }
            // npi del rango
            return $this->RespuestaError("No se encontro el rango",404);
        }
        // npi del servidor se escapo XD
        return $this->RespuestaError("No se encontror el servidor",404);
    }

    
}