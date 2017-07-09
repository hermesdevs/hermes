<?php

namespace App\Http\Controllers;

use App\Switche;
use Illuminate\Http\Request;

class SwitcheController extends Controller
{

    public function index()
    {
        $switche = Switche::all();
        return response()->json(['data'=>$switche],200);
    }
    
    public function show($id){
        return Switche::Find($id);
    }

    public function create(Request $request){
        $reglas = [
            'name'=> 'required',
            'modelo'=> 'required',
            'so'=> 'required',
            'ip'=> 'required',
            '_method'=> 'required',
        ];
    
        $this->validate($request, $reglas);
        Switche::create($request->all());
        return $this->Respuesta('El switche fue creado', 201);
    }
 
    public function update(Request $request,$id){
        $reglas = [
            'name'=> 'required',
            'modelo'=> 'required',
            'so'=> 'required',
            'ip'=> 'required',
        ];
        $this->validate($request, $reglas);
        $switche = Switche::find($id);
        $switche->name = $request->name;
        $switche->modelo = $request->modelo;
        $switche->so = $request->so;
        $switche->ip = $request->ip;
        $switche->save();
        return $this->Respuesta('Se ha modificado el switche', 201);

    }
 
    public function destroy(Request $request,$id){
        $sw = Switche::find($id);
        if ($sw) {
            # code...
            $sw->equipo()->sync([]);
            $sw->puerto()->sync([]);
            $sw->rango()->sync([]);
            $sw->delete();
            return $this->Respuesta('Se ha eliminado el switche', 201);
        }
        return $this->RespuestaError("Ya el switche $sw fue eliminado", 404);
    }
    
}