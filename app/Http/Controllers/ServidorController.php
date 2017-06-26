<?php

namespace App\Http\Controllers;

use App\Servidor;

use Illuminate\Http\Request;

class ServidorController extends Controller
{

    public function index(){
        $servidor = Servidor::all();
        return $this->Respuesta($servidor, 200);        
    }

    public function show($server_id){
        $servidor = Servidor::Find($server_id);
        if ($servidor) {
            return $this->Respuesta($servidor, 200);
        }
        return $this->RespuestaError("No encontre lo que buscas", 404);
    }
    
    public function create(Request $request){
        $reglas = [
            'name' => 'required',
            'description' => 'required',
            'mac' => 'required',
            'ip' => 'required'
        ];

        $this->validate($request, $reglas);

        Servidor::create($request->all());

        return $this->Respuesta('El Servidor fue creado', 201);
    }

    public function update(Request $request, $id){
        
        $servidor = Servidor::Find($id);
        if ($servidor) {
            $reglas = [
                'name' => 'required',
                'ip' => 'required',
                'mac' => 'required',
                'description' => 'required'
            ];
            $this->validate($request, $reglas);
            $servidor->name = $request->get('name');
            $servidor->ip = $request->get('ip');
            $servidor->mac = $request->get('mac');
            $servidor->description = $request->get('description');
            $servidor->save();
            return $this->Respuesta("El servidor $id se edito correctamente. Su nombre $servidor->name", 201);             
        }
        return $this->RespuestaError("El servidor $id no existe", 404);
    }
    
    public function destroy($id){
        $servidor = Servidor::Find($id);
        $servidor->delete();
        return $this->Respuesta("El Servidor $id se elimino", 201);
    }

}