<?php

namespace App\Http\Controllers;

use App\Rango;

use Illuminate\Http\Request;

class RangoController extends Controller
{

    public function index(){
        $rango = Rango::all();
        return $this->Respuesta($rango, 200);    
    }

    public function show($rango_id){

        $rango = Rango::Find($rango_id);

        if ($rango) {
            return $this->Respuesta($rango, 200);
        }

        return $this->RespuestaError("El rango $rango_id no existe", 404);
    }
    
    public function update(Request $request, $rango_id){

        $rango = Rango::Find($rango_id);
        if ($rango) {

            $reglas = [
                'name' => 'required',
                'rango_init' => 'required',
                'rango_end' => 'required'
            ];
            
            $this->validate($request, $reglas);

            $rango->name = $request->get('name');
            $rango->rango_init = $request->get('rango_init');
            $rango->rango_end = $request->get('rango_end');
            $rango->save();
            return $this->Respuesta("El rango $rango_id se edito correctamente", 201); 
        
        }
        return $this->RespuestaError("El rango $rango_id no existe", 404);
    }
    
    public function create(Request $request){

        $reglas = [
            'name' => 'required',
            'rango' => 'required'
        ];

        $this->validate($request, $reglas);

        Rango::create($request->all());
        
        return $this->Respuesta('El rango fue creado', 201);
    }

    public function destroy($rango_id){
        $rango = Rango::Find($rango_id);
        if($rango){
            $vlan->equipo()->sync([]);
            $vlan->servidor()->sync([]);
            $vlan->switche()->sync([]);
            $rango->delete();
            return $this->Respuesta("La vlan $rango_id se elimino", 201);
        }

        return $this->RespuestaError("La vlan $rango_id no existe", 404);
    }


}