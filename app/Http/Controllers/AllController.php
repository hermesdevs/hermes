<?php

namespace App\Http\Controllers;

use App\Servidor;
use App\Puerto;
use App\Switche;
use App\Equipo;
use App\Rango;
use App\User;

class AllController extends Controller
{

    public function ServidoresPuertos(){
        return Servidor::with('puerto')->get();    
    }

    public function ServidoresRangos(){
        return Servidor::with('rango')->get();    
    }

    public function SwitchesPuertos(){
        return Switche::with('puerto')->get();    
    }

    public function SwitchesEquipos(){
        return Switche::with('equipo')->get();    
    }

    public function SwitchesRangos(){
        return Switche::with('rango')->get();    
    }

    public function EquiposPuertos(){
        return Equipo::with('puerto')->get();    
    }

    public function EquiposSwitches(){
        return Equipo::with('switche')->get();    
    }

    public function EquiposRangos(){
        return Equipo::with('rango')->get();    
    }

    public function EquiposUsuarios(){
        return Equipo::with('user')->get();    
    }

    public function RangosEquipos(){
        return Rango::with('equipo')->get();    
    }

    public function RangosServidores(){
        return Rango::with('servidor')->get();    
    }

    public function RangosSwitches(){
        return Rango::with('switche')->get();    
    }

    public function UsuariosEquipos(){
        return User::with('equipo')->get();    
    }

    public function PuertosEquipos(){
        return Puerto::with('equipo')->get();    
    }

    public function PuertosServidores(){
        return Puerto::with('servidor')->get();    
    }

    public function PuertosSwitches(){
        return Puerto::with('switche')->get();    
    }

    public function PuertosVlans(){
        return Puerto::with('vlan')->get();    
    }

}