<?php
namespace App\Http\Controllers;

use App\Equipo;
use App\Switche;
use Illuminate\Http\Request;

class SwitcheEquipoController extends Controller{

    public function index($switche_id){
        $sw = Switche::Find($switche_id);
        if($sw){
            $equipos = $sw->equipo;
            return $this->Respuesta($equipos, 200);
        }
        return $this->RespuestaError("Este Switche no esta conectado a ningun equipo", 404);
    }

    public function create($switche_id, $equipo_id){
            
        //busco el id del equipo
        $equipo = Equipo::Find($equipo_id);
        // compruebo si existe
        if ($equipo) {
            // si esxiste todo bien continuo
            
            // busco el id del sw
            $switche = Switche::Find($switche_id);
            if($switche){

                $switches = $equipo->switche();
                if ($switches->find($switche_id)) {
                    # code...
                    return $this->Respuesta("EL Switche $switche_id ya fue asignado al equipo $equipo_id",409);
                }
                // si esxiste todo bien continuo
                // desde el Modelo Equipo que encontre busco la tabla pivote que me enlasa los equipos con los switche y los attachsco XD
                $equipo->switche()->attach($switche_id);
                // todo bien sigo con mi vida y me como una arepa T.T
                return $this->Respuesta("EL equipo $equipo_id fue asignado al switche $switche_id",201);
            }

            // el switche no existio 
            return $this->RespuestaError("EL switche $switche_id no existe",404);

        }
        // el equipo no existio 
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }
    

    public function update(Request $request, $switche_id , $equipo_id ){
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
                    return $this->Respuesta("EL switche $switcheCambio ya esta asignado al equipo $equipo_id",409);
                }

                $equipo->switche()->updateExistingPivot($switche_id, array(
                    'switche_id' => $request->get('switche_id')
                ));
                return $this->Respuesta('El switche fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    public function destroy($switche_id, $equipo_id){
        $e = Equipo::Find($equipo_id);
        if($e){
            $switches = $e->switche();
            //buscas el usuario
            if ($switches->find($switche_id)){
                //eliminamos la relacion
                $switches->detach($switche_id);
                return $this->Respuesta("El equipo $equipo_id se elimino del switche $switche_id",200);
            }
            // npi del sw
            return $this->RespuestaError("No se encontro el switche",404);
        }
        // npi del equipo se escapo XD
        return $this->RespuestaError("No se encontror el equipo",404);
    }
    
}