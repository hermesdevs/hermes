<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Rango;

use Illuminate\Http\Request;

class EquipoRangoController extends Controller
{

	public function index($id){
		$equipo = Equipo::find($id);
		if($equipo){
			$rango=$equipo->rango;
			return $this->Respuesta($rango,200);
		}

		return $this->RespuestaError("No encontre el equipo $equipo_id que buscas", 404);
	}		

	public function create($equipo_id , $rango_id){
            
        //busco el id del equipo
        $e = Equipo::Find($equipo_id);
        // compruebo si existe
        if ($e) {
            // si esxiste todo bien continuo
            
            // busco el id del rango
            $r = Rango::Find($rango_id);
            if($r){

                $rangos = $e->rango();
                if ($rangos->find($rango_id)) {
                    # code...
                    return $this->Respuesta("EL Rango $rango_id ya fue asignado al equipo $equipo_id",409);
                }
                // si esxiste todo bien continuo
                // desde el Modelo Equipo que encontre busco la tabla pivote que me enlasa los equipos con los rangos y los attachsco XD
                $e->rango()->attach($rango_id);
                // todo bien sigo con mi vida y me como una arepa T.T
                return $this->Respuesta("EL equipo $equipo_id fue asignado al Rango $rango_id",201);
            }

            // el usuario no existio 
            return $this->RespuestaError("EL rango $rango_id no existe",404);

        }
        // el equipo no existio 
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
        }
        //actualizaaar
        public function EquipoRangoUpdate(Request $request, $equipo_id , $rango_id){
          $equipo = Equipo::Find($equipo_id);
        if ($equipo) {   
            $rango = Rango::Find($rango_id);
            if($rango){
                $reglas = [
                    'rango_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $rangoCambio = $request->get('rango_id');
                $rangos = $equipo->rango();
                if ($rangos->find($rangoCambio)){
                    return $this->Respuesta("EL rango $rangoCambio ya esta asignado al equipo $equipo_id",409);
                }

                $equipo->rango()->updateExistingPivot($rango_id, array(
                    'rango_id' => $request->get('rango_id')
                ));
                return $this->Respuesta('El rango fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }
    
    public function update(Request $request, $equipo_id , $rango_id){
        $equipo = Equipo::Find($equipo_id);
        if ($equipo) {   
            $rango = Rango::Find($rango_id);
            if($rango){
                $reglas = [
                    'rango_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $rangoCambio = $request->get('rango_id');
                $rangos = $equipo->rango();
                if ($rangos->find($rangoCambio)){
                    return $this->Respuesta("EL rango $rangoCambio ya esta asignado al equipo $equipo_id",409);
                }

                $equipo->rango()->updateExistingPivot($rango_id, array(
                    'rango_id' => $request->get('rango_id')
                ));
                return $this->Respuesta('El rango fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    public function destroy($equipo_id , $rango_id){

		$e = Equipo::Find($equipo_id);
        if($e){
            $rangos = $e->rango();
            //buscas el usuario
            if ($rangos->find($rango_id)){
                //eliminamos la relacion
                $rangos->detach($rango_id);
                return $this->Respuesta("El equipo $equipo_id se elimino del rango $rango_id",200);
            }
            // npi del rango
            return $this->RespuestaError("No se encontro el rango",404);
        }
        // npi del equipo se escapo XD
        return $this->RespuestaError("No se encontror el equipo",404);
    }

}