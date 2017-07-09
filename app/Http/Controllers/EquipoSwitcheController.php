<?php

namespace App\Http\Controllers;

use App\Equipo;
use App\Switche;

use Illuminate\Http\Request;

class EquipoSwitcheController extends Controller
{

    public function index($id){
        $e = Equipo::Find($id);
        if($e){
            $r = $e->switche;
            return $this->Respuesta($r, 200);
        }
        return $this->RespuestaError("El equipo $id no existe", 404);
    }

	public function create($equipo_id , $swtiche_id){
		$equipo = Equipo::Find($equipo_id);
		if($equipo){
			//ve si existe
			$switche = Switche::Find($swtiche_id);
			if($switche){
				$switches = $equipo->switche();
				if($switches->find($swtiche_id)) {
					return $this->Respuesta("EL equipo $equipo_id ya esta asignado el switche $swtiche_id",409);
				}
				$equipo->switche()->attach($swtiche_id);
				return $this->RespuestaError("Al equipo $equipo_id le fue asignado el switche $switche_id",201);
			}
			return $this->Respuesta("El switche $switche_id no existe",409);
		}
		return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
	}

	public function update(Request $request, $equipo_id, $switche_id){
		$equipo = Equipo::Find($equipo_id);
        if ($equipo) {   
            $switche = Switche::Find($switche_id);
            if($switche){
                $reglas = [
                    'switche_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $switcheCambio = $request->get('switche_id');
                $switches = $equipo->switche();
                if ($switches->find($switcheCambio)){
                    return $this->Respuesta("EL Switche $switcheCambio ya esta asignado al equipo $equipo_id",409);
                }
                $equipo->switche()->updateExistingPivot($swtiche_id, array(
                    'swtiche_id' => $request->get('swtiche_id')
                ));

                return $this->Respuesta('El switche fue actualizado', 201);
            
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
	}

	public function destroy($equipo_id , $switche_id){    
        //buscas el equipo
        $equipo = Equipo::Find($equipo_id);
        if($equipo){
            $switches = $equipo->switche();
            //buscas el switche
            if ($switches->find($switche_id)){
                //eliminamos la relacion
                $switches->detach($switche_id);
                return $this->Respuesta("El Switche $switche_id se elimino del equipo $equipo_id",200);
            }
            // npi del switche
            return $this->RespuestaError("No se encontro el switche",404);
        }
        // npi del equipo se escapo XD
        return $this->RespuestaError("No se encontror el equipo",404);
    }

}