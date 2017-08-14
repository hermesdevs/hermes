<?php
namespace App\Http\Controllers;

use App\Servidor;
use App\Switche;
use Illuminate\Http\Request;

class SwitcheServidorController extends Controller{

    public function index($switche_id){
        $sw = Switche::Find($switche_id);
        if($sw){
            $servidores = $sw->servidor;
            return $this->Respuesta($servidores, 200);
        }
        return $this->RespuestaError("Este Switche no esta conectado a ningun Servidor", 404);
    }

    public function create($switche_id, $servidor_id){
            
        //busco el id del Servidor
        $servidor = Servidor::Find($servidor_id);
        // compruebo si existe
        if ($servidor) {
            // si esxiste todo bien continuo
            
            // busco el id del sw
            $switche = Switche::Find($switche_id);
            if($switche){

                $switches = $servidor->switche();
                if ($switches->find($switche_id)) {
                    # code...
                    return $this->Respuesta("EL Switche $switche_id ya fue asignado al servidor $servidor_id",409);
                }
                // si esxiste todo bien continuo
                // desde el Modelo servidor que encontre busco la tabla pivote que me enlasa los equipos con los switche y los attachsco XD
                $servidor->switche()->attach($switche_id);
                // todo bien sigo con mi vida y me como una arepa T.T
                return $this->Respuesta("EL servidor $servidor_id fue asignado al switche $switche_id",201);
            }

            // el switche no existio 
            return $this->RespuestaError("EL switche $switche_id no existe",404);

        }
        // el servidor no existio 
        return $this->RespuestaError("EL servidor $servidor_id no existe ", 404);
    }
    

    public function update(Request $request, $switche_id , $servidor_id ){
        $servidor = Servidor::Find($servidor_id);
        if ($servidor) {   
            $switche = Switche::Find($switche_id);
            if($switche){
                $reglas = [
                    'switche_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $switcheCambio = $request->get('switche_id');
                $switches = $servidor->switche();
                if ($switches->find($switcheCambio)){
                    return $this->Respuesta("EL switche $switcheCambio ya esta asignado al Servidor $servidor_id",409);
                }

                $servidor->switche()->updateExistingPivot($switche_id, array(
                    'switche_id' => $request->get('switche_id')
                ));
                return $this->Respuesta('El switche fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL Servidor $servidor_id no existe ", 404);
    }

    public function destroy($switche_id, $servidor_id){
        $servidor = Servidor::Find($servidor_id);
        if($servidor){
            $switches = $servidor->switche();
            //buscas el usuario
            if ($switches->find($switche_id)){
                //eliminamos la relacion
                $switches->detach($switche_id);
                return $this->Respuesta("El Servidor $servidor_id se elimino del switche $switche_id",200);
            }
            // npi del sw
            return $this->RespuestaError("No se encontro el switche",404);
        }
        // npi del Servidor se escapo XD
        return $this->RespuestaError("No se encontror el Servidor",404);
    }
    
}