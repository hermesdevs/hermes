<?php

namespace App\Http\Controllers;

use App\Equipo;

use Illuminate\Http\Request;

class EquipoRangoController extends Controller
{

    public function EquipoRango($id){

        $e = Equipo::Find($id);

        if($e){
            $r = $e->rango;
            return $this->Respuesta($r, 200);
        }

        return $this->RespuestaError("Este Equipo no esta conectado a ningun puerto", 404);
        
    }


}