<?php

namespace App\Http\Controllers;

use App\Puerto;
use App\Vlan;
use Illuminate\Http\Request;

class PuertoController extends Controller
{

    public function index(){
        $puerto = Puerto::all();
        return $this->Respuesta($puerto, 200);    
    }

    public function show($puerto_id){

        $puerto = Puerto::Find($puerto_id);

        if ($puerto) {
            return $this->Respuesta($puerto, 200);
        }

        return $this->RespuestaError("El puerto $puerto_id no existe", 404);
    }
    
    public function create(Request $request){

        $reglas = [
            'name' => 'required',
            'vlan_id' => 'required'
        ];
        $this->validate($request, $reglas);

        $vlan_id = $request->get('vlan_id');
        $id = Vlan::Find($vlan_id);        
        if ($id) {            
            Puerto::create($request->all());        
            return $this->Respuesta('El puerto fue creado', 201);
        }
        return $this->RespuestaError("El puerto necesita una Vlan y la vlan $vlan_id no existe",404);
    }

    public function update(Request $request, $puerto_id){

        $puerto = Puerto::Find($puerto_id);
        if($puerto){        
            $reglas = [
                'name' => 'required',
                'vlan_id' => 'required'
            ];
            $this->validate($request, $reglas);
            
            $id = Vlan::Find($request->get('vlan_id'));
            if ($id) {            
                $puerto->name = $request->get('name');
                $puerto->vlan_id = $request->get('vlan_id');              
                $puerto->save();        
                return $this->Respuesta('El puerto fue actualizado', 201);
            }
            return $this->RespuestaError("El puerto necesita una Vlan y la vlan que solicitas no existe",404);
        }
        return $this->RespuestaError("El puerto no existe",404);
    }

    public function destroy($puerto_id){
        $puerto = Puerto::Find($puerto_id);
        
        if($puerto){
            $puerto->equipo()->sync([]);
            $puerto->servidor()->sync([]);
            $puerto->switch()->sync([]);
            $puerto->delete();
            return $this->Respuesta("El puerto $puerto_id se elimino", 201);
        }

        return $this->RespuestaError("El puerto $puerto_id no existe", 404);
    }
}