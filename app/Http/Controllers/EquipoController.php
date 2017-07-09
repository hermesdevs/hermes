<?php

namespace App\Http\Controllers;

use App\Equipo;

use Illuminate\Http\Request;

class EquipoController extends Controller
{

    public function index(){
        $e = Equipo::all();
        return $this->Respuesta($e, 200);    
    }

    public function show($equipo_id){

        $e = Equipo::Find($equipo_id);

        if ($e) {
            return $this->Respuesta($e, 200);
        }

        return $this->RespuestaError("No encontre el equipo $equipo_id que buscas", 404);
    }
    
    public function create(Request $request){
        $reglas = [
            'name' => 'required',
            'so' => 'required',
            'brand' => 'required',
            'model' => 'required',
            'mac' => 'required',
            'ip' => 'required'
        ];

        $this->validate($request, $reglas);

        Equipo::create($request->all());

        return $this->Respuesta('El equipo fue creado', 201);
    }

    public function update(Request $request, $id){

        $equipo = Equipo::Find($id);
        if ($equipo) {

            $reglas = [
                'name' => 'required',
                'so' => 'required',
                'brand' => 'required',
                'model' => 'required',
                'mac' => 'required',
                'ip' => 'required'
            ];
            
            $this->validate($request, $reglas);

            $equipo->name = $request->get('name');
            $equipo->so = $request->get('so');
            $equipo->brand = $request->get('brand');
            $equipo->model = $request->get('model');
            $equipo->mac = $request->get('mac');
            $equipo->ip = $request->get('ip');

            $equipo->save();

            return $this->Respuesta("El equipo $id se edito correctamente", 201); 
        
        }
        return $this->RespuestaError("El equipo $id no existe", 404);
    }
    
    public function destroy($id){
        $e = Equipo::Find($id);
        if (condition) {
            # code...
            $e->puerto()->sync([]);
            $e->user()->sync([]);
            $e->switche()->sync([]);
            $e->rango()->sync([]);
            $e->delete();
            return $this->Respuesta("El equipo $id se elimino", 201);
        }        
        return $this->RespuestaError("Ya el equipo $sw fue eliminado , no existe", 404);
    }

}