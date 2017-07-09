<?php
namespace App\Http\Controllers;

use App\Puerto;
use App\Servidor;
use Illuminate\Http\Request;

class PuertoServidorController extends Controller{

    public function index($id){
        $servidor = Servidor::find($id);
        if($servidor){
            $puerto = $servidor->puerto;
            return $this->Respuesta($puerto, 200);
        }
        return $this->RespuestaError("El servidor $id no existe", 404);
    }

    public function create($puerto_id, $servidor_id){
        $servidor = Servidor::Find($servidor_id);
        if($servidor){
            $p = Puerto::Find($puerto_id);
            if($p){
                $puertos = $servidor->puerto();
                if ($puertos->find($puerto_id)) {
                    return $this->Respuesta("EL puerto $puerto_id ya fue asignado al servidor $servidor_id",409);
                }
                $servidor->puerto()->attach($puerto_id);
                return $this->Respuesta("EL servidor $servidor_id fue asignado al puerto $puerto_id",201);
            }
            return $this->RespuestaError("EL puerto $puerto_id no existe",404);
        }
        return $this->RespuestaError("EL servidor $servidor_id no existe ", 404);
    }

    public function update(Request $request, $servidor_id , $puerto_id){
        $servidor = Servidor::Find($servidor_id);
        if ($servidor) {   
            $puerto = Puerto::Find($puerto_id);
            if($puerto){
                $reglas = [
                    'puerto_id' => 'required'
                ];
                $this->validate($request, $reglas);
                $puertoCambio = $request->get('puerto_id');
                $puertos = $servidor->puerto();
                if ($puertos->find($puertoCambio)){
                    return $this->Respuesta("EL puerto $puertoCambio ya esta asignado al servidor $servidor_id",409);
                }

                $servidor->puerto()->updateExistingPivot($puerto_id, array(
                    'puerto_id' => $request->get('puerto_id')
                ));
                return $this->Respuesta('El puerto fue actualizado', 201);
            }
        }
        return $this->RespuestaError("EL equipo $equipo_id no existe ", 404);
    }

    public function destroy($puerto_id , $servidor_id){    
        $servidor = Servidor::Find($servidor_id);
        if($servidor){
            $puertos = $servidor->puerto();
            if ($puertos->find($puerto_id)){
                $puertos->detach($puerto_id);
                return $this->Respuesta("El puerto $puerto_id se elimino del servidor $servidor_id",200);
            }
            return $this->RespuestaError("No se encontro el puerto",404);
        }
        return $this->RespuestaError("No se encontror el servidor",404);
    }

}