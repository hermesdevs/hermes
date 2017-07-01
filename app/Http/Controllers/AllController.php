<?php

namespace App\Http\Controllers;

use App\Servidor;
use App\Puerto;
use App\Switche;
use App\Equipo;
use App\Rango;
use App\User;
use Illuminate\Http\Request;

class AllController extends Controller
{

    public function Servidores_Puertos(Request $request){
        return Servidor::with('puerto')->get();    
    }

    public function Servidores_Rangos(Request $request){
        return Servidor::with('rango')->get();    
    }

    public function Switches_Puertos(Request $request){
        return Switche::with('puerto')->get();    
    }

    public function Switches_Equipos(Request $request){
        return Switche::with('equipo')->get();    
    }

    public function Switches_Rangos(Request $request){
        return Switche::with('rango')->get();    
    }

    public function Equipos_Puertos(Request $request){
        return Equipo::with('puerto')->get();    
    }

    public function Equipos_Switches(Request $request){
        return Equipo::with('switche')->get();    
    }

    public function Equipos_Rangos(Request $request){
        return Equipo::with('rango')->get();    
    }

    public function Equipos_Usuarios(Request $request){
        return Equipo::with('user')->get();    
    }

    public function Rangos_Equipos(Request $request){
        return Rango::with('equipo')->get();    
    }

    public function Rangos_Servidores(Request $request){
        return Rango::with('servidor')->get();    
    }

    public function Rangos_Switches(Request $request){
        return Rango::with('switche')->get();    
    }

    public function Usuarios_Equipos(Request $request){
        return User::with('equipo')->get();    
    }

    public function Puertos_Equipos(Request $request){
        return Puerto::with('equipo')->get();    
    }

    public function Puertos_Servidores(Request $request){
        return Puerto::with('servidor')->get();    
    }

    public function Puertos_Switches(Request $request){
        return Puerto::with('switche')->get();    
    }

    public function Puertos_Vlans(Request $request){
        return Puerto::with('vlan')->get();    
    }


}