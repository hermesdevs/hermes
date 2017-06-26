<?php

namespace App\Http\Controllers;

use App\Rango;
use App\Switche;

use Illuminate\Http\Request;

class SwitcheRangoController extends Controller{

	public function index($id){

        $sw = Switche::Find($id);

        if($sw){
            $r = $sw->rango;
            return $this->Respuesta($r, 200);
        }

        return $this->RespuestaError("Este Equipo no esta conectado a ningun puerto", 404);
        
    }
}