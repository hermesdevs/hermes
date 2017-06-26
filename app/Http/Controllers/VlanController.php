<?php

namespace App\Http\Controllers;

use App\Vlan;
use Illuminate\Http\Request;

class VlanController extends Controller
{

    public function index(){
        $vlan = Vlan::all();
        return $this->Respuesta($vlan, 200);    
    }

    public function show($vlan_id){

        $vlan = Vlan::Find($vlan_id);

        if ($vlan) {
            return $this->Respuesta($vlan, 200);
        }

        return $this->RespuestaError("La vlan $vlan_id no existe", 404);
    }
    
    public function update(Request $request, $id){

        $vlan = Vlan::Find($id);
        if ($vlan) {

            $reglas = [
                'name' => 'required',
                'rango_init' => 'required',
                'rango_end' => 'required'
            ];
            
            $this->validate($request, $reglas);

            $vlan->name = $request->get('name');
            $vlan->rango_init = $request->get('rango_init');
            $vlan->rango_end = $request->get('rango_end');
            $vlan->save();
            return $this->Respuesta("La vlan $id se edito correctamente", 201); 
        
        }
        return $this->RespuestaError("La vlan $id no existe", 404);
    }
    
    public function create(Request $request){

        $reglas = [
            'name' => 'required',
            'rango_init' => 'required',
            'rango_end' => 'required'
        ];

        $this->validate($request, $reglas);

        Vlan::create($request->all());
        
        return $this->Respuesta('La vlan fue creada', 201);
    }

    public function destroy($vlan_id){
        $vlan = Vlan::Find($vlan_id);
        if($vlan){
            $vlan->puerto()->sync([]);
            $vlan->delete();
            return $this->Respuesta("La vlan $vlan_id se elimino", 201);
        }

        return $this->RespuestaError("La vlan $vlan_id no existe", 404);
    }

}