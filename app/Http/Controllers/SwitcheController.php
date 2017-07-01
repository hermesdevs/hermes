<?php

namespace App\Http\Controllers;

use App\Switche;

use Illuminate\Http\Request;

class SwitcheController extends Controller
{
 
    public function index(){

        $sw = Switche::all();
        return $this->Respuesta($sw, 200);
        
    }

    public function show($id){

        $sw = Switche::Find($id);

        if ($sw) {
            return $this->Respuesta($sw, 200);
        }
        return $this->RespuestaError("No encontre el switche que buscas", 404);
    
    }    

    public function update(Request $request, $id){

        $sw = Switche::Find($id);
        if ($sw) {

            $reglas = [
                'name' => 'required',
                'modelo' => 'required',
                'so' => 'required',
                'ip' => 'required'
            ];
            $this->validate($request, $reglas);
            $sw->name = $request->get('name');
            $sw->modelo = $request->get('modelo');
            $sw->so = $request->get('so');
            $sw->ip = $request->get('ip');
            $sw->save();
            return $this->Respuesta("El Switche $id se edito correctamente", 201); 
        
        }
        return $this->RespuestaError("El Switche $id no existe", 404);
    }

    public function create(Request $request){
        $reglas = [
            'name' => 'required',
            'modelo' => 'required',
            'so' => 'required',
            'ip' => 'required'
        ];

        $this->validate($request, $reglas);

        Switche::create($request->all());

        return $this->Respuesta('El Switche fue creado', 201);
    }


    public function destroy($id){
        $sw = Switche::Find($id);
        $sw->equipo()->sync([]);
        $sw->puerto()->sync([]);
        $sw->delete();
        return $this->Respuesta("El Switche $id se elimino", 201);
    }
    
}