<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class Controller extends BaseController
{
    //
    public function Respuesta($datos, $codigo){
    	return response()->json(['data' => $datos], $codigo);
    }    

    public function RespuestaError($mensaje, $codigo){
    	return response()->json(['message' => $mensaje, 'code' => $codigo], $codigo);
    }

    protected function buildFailedValidationResponse(Request $request, array $errors)
    {
    	# code...
    	return $this->RespuestaError($errors, 422);
    }
}
