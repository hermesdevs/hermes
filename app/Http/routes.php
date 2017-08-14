<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// header('Access-Control-Allow-Origin: *');
// header('Access-Control-Allow-Credentials: true');
// header('Access-Control-Allow-Headers: Content-Type, Origin');
// header('Access-Control-Allow-Methods: GET,PUT,POST,DELETE,OPTIONS');

$app->get('/', function () use ($app) {
    return $app->version();
});

//===============================================
//===============================================
// Rutas Completas
//===============================================
//===============================================

$app->get('/', 'AllController@EquiposPuertos');
$app->get('/servidores/puertos', 'AllController@ServidoresPuertos');
$app->get('/servidores/rangos', 'AllController@ServidoresRangos');
$app->get('/switches/puertos', 'AllController@SwitchesPuertos');
$app->get('/switches/equipos', 'AllController@SwitchesEquipos');
$app->get('/switches/rangos', 'AllController@SwitchesRangos');
$app->get('/equipos/switches', 'AllController@EquiposSwitches');
$app->get('/equipos/rangos', 'AllController@EquiposRangos');
$app->get('/equipos/usuarios', 'AllController@EquiposUsuarios');
$app->get('/rangos/equipos', 'AllController@RangosEquipos');
$app->get('/rangos/servidores', 'AllController@RangosServidores');
$app->get('/rangos/swtiches', 'AllController@RangosSwitches');
$app->get('/usuarios/equipos', 'AllController@UsuariosEquipos');
$app->get('/puertos/equipos', 'AllController@PuertosEquipos');
$app->get('/puertos/servidores', 'AllController@PuertosServidores');
$app->get('/puertos/switches', 'AllController@PuertosSwitches');
$app->get('/puertos/vlans', 'AllController@PuertosVlans');


//===============================================
// Auth
//===============================================
$app->get('/auth', 'AuthController@index');
$app->post('/auth/login', 'AuthController@login');
$app->post('/auth/register', 'AuthController@register');
$app->post('/auth/forget', 'AuthController@forget');

//===============================================
// Equipos
//===============================================
$app->get('/equipos', 'EquipoController@index');
$app->get('/equipos/{id}', 'EquipoController@show');
$app->post('/equipos', 'EquipoController@create');
$app->put('/equipos/{id}', 'EquipoController@update');
$app->patch('/equipos/{id}', 'EquipoController@update');
$app->delete('/equipos/{id}', 'EquipoController@destroy');


//===============================================
// Servidores
//===============================================
$app->get('/servidores', 'ServidorController@index');
$app->get('/servidores/{id}', 'ServidorController@show');
$app->post('/servidores', 'ServidorController@create');
$app->put('/servidores/{id}', 'ServidorController@update');
$app->patch('/servidores/{id}', 'ServidorController@update');
$app->delete('/servidores/{id}', 'ServidorController@destroy');


//===============================================
// Switche
//===============================================

$app->get('/switches', 'SwitcheController@index');
$app->get('/switches/{id}', 'SwitcheController@show');
$app->post('/switches', 'SwitcheController@create');
$app->put('/switches/{id}', 'SwitcheController@update');
$app->patch('/switches/{id}', 'SwitcheController@update');
$app->delete('/switches/{id}', 'SwitcheController@destroy');


//===============================================
// Vlan
//===============================================
$app->get('/vlans', 'VlanController@index');
$app->get('/vlans/{id}', 'VlanController@show');
$app->post('/vlans', 'VlanController@create');
$app->put('/vlans/{id}', 'VlanController@update');
$app->patch('/vlans/{id}', 'VlanController@update');
$app->delete('/vlans/{id}', 'VlanController@destroy');


//===============================================
// Puertos
//===============================================
$app->get('/puertos', 'PuertoController@index');
$app->get('/puertos/{id}', 'PuertoController@show');
$app->post('/puertos', 'PuertoController@create');
$app->put('/puertos/{puerto_id}', 'PuertoController@update');
$app->patch('/puertos/{id}', 'PuertoController@update');
$app->delete('/puertos/{id}', 'PuertoController@destroy');


//====================================
// User
//====================================
$app->get('/usuarios', 'UserController@index');
$app->get('/usuarios/{id}', 'UserController@show');
$app->post('/usuarios', 'UserController@create');
$app->put('/usuarios/{id}', 'UserController@update');
$app->patch('/usuarios/{id}', 'UserController@update');
$app->delete('/usuarios/{id}', 'UserController@destroy');


//===============================================
// Rango
//===============================================
$app->get('/rangos', 'RangoController@index');
$app->get('/rangos/{id}', 'RangoController@show');
$app->post('/rangos', 'RangoController@create');
$app->put('/rangos/{id}', 'RangoController@update');
$app->patch('/rangos/{id}', 'RangoController@update');
$app->delete('/rangos/{id}', 'RangoController@destroy');




//===============================================
//===============================================
// Rutas Anidadas
//===============================================
//===============================================


//===============================================
// Equipos Anidados
//===============================================

// Equipos - Puertos
$app->get('/equipos/{equipo_id}/puertos/', 'EquipoPuertoController@index');
$app->post('/equipos/{equipo_id}/puertos/{puerto_id}', 'EquipoPuertoController@create');
$app->put('/equipos/{equipo_id}/puertos/{puerto_id}', 'EquipoPuertoController@update');
$app->patch('/equipos/{equipo_id}/puertos/{puerto_id}', 'EquipoPuertoController@update');
$app->delete('/equipos/{equipo_id}/puertos/{puerto_id}', 'EquipoPuertoController@destroy');


// Equipos - Swtiches
$app->get('/equipos/{equipo_id}/swtiches/', 'EquipoSwitcheController@index');
$app->post('/equipos/{equipo_id}/swtiches/{swtiche_id}', 'EquipoSwitcheController@create');
$app->put('/equipos/{equipo_id}/swtiches/{swtiche_id}', 'EquipoSwitcheController@update');
$app->patch('/equipos/{equipo_id}/swtiches/{swtiche_id}', 'EquipoSwitcheController@update');
$app->delete('/equipos/{equipo_id}/swtiches/{swtiche_id}', 'EquipoSwitcheController@destroy');

// Equipos - Rangos
$app->get('/equipos/{equipo_id}/rangos/', 'EquipoRangoController@index');
$app->post('/equipos/{equipo_id}/rangos/{rango_id}', 'EquipoRangoController@create');
$app->put('/equipos/{equipo_id}/rangos/{rango_id}', 'EquipoRangoController@update');
$app->patch('/equipos/{equipo_id}/rangos/{rango_id}', 'EquipoRangoController@update');
$app->delete('/equipos/{equipo_id}/rangos/{rango_id}', 'EquipoRangoController@destroy');

// Equipos - usuarios
$app->get('/equipos/{equipo_id}/usuarios/', 'EquipoUserController@index');
$app->post('/equipos/{equipo_id}/usuarios/{usuario_id}', 'EquipoUserController@create');
$app->put('/equipos/{equipo_id}/usuarios/{usuario_id}', 'EquipoUserController@update');
$app->patch('/equipos/{equipo_id}/usuarios/{usuario_id}', 'EquipoUserController@update');
$app->delete('/equipos/{equipo_id}/usuarios/{usuario_id}', 'EquipoUserController@destroy');


//===============================================
// Servidores Anidados
//===============================================

//Servidor Puerto
$app->get('/servidores/{servidor_id}/puertos/', 'ServidorPuertoController@index');
$app->post('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@create');
$app->put('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->patch('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->delete('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@destroy');

//Servidor Rango
$app->get('/servidores/{servidor_id}/rangos/', 'ServidorRangoController@index');
$app->post('/servidores/{servidor_id}/rangos/{rangos_id}', 'ServidorRangoController@create');
$app->put('/servidores/{servidor_id}/rangos/{rangos_id}', 'ServidorRangoController@update');
$app->patch('/servidores/{servidor_id}/rangos/{rangos_id}', 'ServidorRangoController@update');
$app->delete('/servidores/{servidor_id}/rangos/{rangos_id}', 'ServidorRangoController@destroy');


//===============================================
// Swtiche Anidados
//===============================================

// Swtiche Puerto
$app->get('/switches/{switche_id}/puertos/', 'SwitchePuertoController@index');
$app->post('/switches/{switche_id}/puertos/{puerto_id}', 'SwitchePuertoController@create');
$app->put('/switches/{switche_id}/puertos/{puerto_id}', 'SwitchePuertoController@update');
$app->patch('/switches/{switche_id}/puertos/{puerto_id}', 'SwitchePuertoController@update');
$app->delete('/switches/{switche_id}/puertos/{puerto_id}', 'SwitchePuertoController@destroy');

// Swtiche Equipo
$app->get('/switches/{switche_id}/equipos/', 'SwitcheEquipoController@index');
$app->post('/switches/{switche_id}/equipos/{equipo_id}', 'SwitcheEquipoController@create');
$app->put('/switches/{switche_id}/equipos/{equipo_id}', 'SwitcheEquipoController@update');
$app->patch('/switches/{switche_id}/equipos/{equipo_id}', 'SwitcheEquipoController@update');
$app->delete('/switches/{switche_id}/equipos/{equipo_id}', 'SwitcheEquipoController@destroy');

// Swtiche Servidor
$app->get('/switches/{switche_id}/servidores/', 'SwitcheServidorController@index');
$app->post('/switches/{switche_id}/servidores/{servidor_id}', 'SwitcheServidorController@create');
$app->put('/switches/{switche_id}/servidores/{servidor_id}', 'SwitcheServidorController@update');
$app->patch('/switches/{switche_id}/servidores/{servidor_id}', 'SwitcheServidorController@update');
$app->delete('/switches/{switche_id}/servidores/{servidor_id}', 'SwitcheServidorController@destroy');

// Swtiche Rangos
$app->get('/switches/{switche_id}/rangos/', 'SwitcheRangoController@index');
$app->post('/switches/{switche_id}/rangos/{rango_id}', 'SwitcheRangoController@create');
$app->put('/switches/{switche_id}/rangos/{rango_id}', 'SwitcheRangoController@update');
$app->patch('/switches/{switche_id}/rangos/{rango_id}', 'SwitcheRangoController@update');
$app->delete('/switches/{switche_id}/rangos/{rango_id}', 'SwitcheRangoController@destroy');



//===============================================
// Rangos Anidados
//===============================================

//rangos equipos
$app->get('/rangos/{rangos_id}/equipos/', 'RangoEquipoController@index');
$app->post('/rangos/{rangos_id}/equipos/{equipo_id}', 'RangoEquipoController@create');
$app->put('/rangos/{rangos_id}/equipos/{equipo_id}', 'RangoEquipoController@update');
$app->patch('/rangos/{rangos_id}/equipos/{equipo_id}', 'RangoEquipoController@update');
$app->delete('/rangos/{rangos_id}/equipos/{equipo_id}', 'RangoEquipoController@destroy');

//rangos servidores
$app->get('/rangos/{rangos_id}/servidores/', 'RangoServidorController@index');
$app->post('/rangos/{rangos_id}/servidores/{servidor_id}', 'RangoServidorController@create');
$app->put('/rangos/{rangos_id}/servidores/{servidor_id}', 'RangoServidorController@update');
$app->patch('/rangos/{rangos_id}/servidores/{servidor_id}', 'RangoServidorController@update');
$app->delete('/rangos/{rangos_id}/servidores/{servidor_id}', 'RangoServidorController@destroy');

//rangos switche
$app->get('/rangos/{rangos_id}/switches/', 'RangoSwitcheController@index');
$app->post('/rangos/{rangos_id}/switches/{switche_id}', 'RangoSwitcheController@create');
$app->put('/rangos/{rangos_id}/switches/{switche_id}', 'RangoSwitcheController@update');
$app->patch('/rangos/{rangos_id}/switches/{switche_id}', 'RangoSwitcheController@update');
$app->delete('/rangos/{rangos_id}/switches/{switche_id}', 'RangoSwitcheController@destroy');



//===============================================
// Usuarios Anidados
//===============================================

//usuarios - equipos
$app->get('/usuarios/{user_id}/equipos/', 'UserEquipoController@index');
$app->post('/usuarios/{user_id}/equipos/{equipo_id}', 'UserEquipoController@create');
$app->put('/usuarios/{user_id}/equipos/{equipo_id}', 'UserEquipoController@update');
$app->patch('/usuarios/{user_id}/equipos/{equipo_id}', 'UserEquipoController@update');
$app->delete('/usuarios/{user_id}/equipos/{equipo_id}', 'UserEquipoController@destroy');


//===============================================
// Puertos Anidados
//===============================================

//puertos - equipos
$app->get('/puertos/{puerto_id}/equipos/', 'PuertoEquipoController@index');
$app->post('/puertos/{puerto_id}/equipos/{equipo_id}', 'PuertoEquipoController@create');
$app->put('/puertos/{puerto_id}/equipos/{equipo_id}', 'PuertoEquipoController@update');
$app->patch('/puertos/{puerto_id}/equipos/{equipo_id}', 'PuertoEquipoController@update');
$app->delete('/puertos/{puerto_id}/equipos/{equipo_id}', 'PuertoEquipoController@destroy');

//puertos - servidores
$app->get('/puertos/{puerto_id}/servidores/', 'PuertoServidorController@index');
$app->post('/puertos/{puerto_id}/servidores/{servidor_id}', 'PuertoServidorController@create');
$app->put('/puertos/{puerto_id}/servidores/{servidor_id}', 'PuertoServidorController@update');
$app->patch('/puertos/{puerto_id}/servidores/{servidor_id}', 'PuertoServidorController@update');
$app->delete('/puertos/{puerto_id}/servidores/{servidor_id}', 'PuertoServidorController@destroy');

//puertos - switches
$app->get('/puertos/{puerto_id}/switches/', 'PuertoSwitcheController@index');
$app->post('/puertos/{puerto_id}/switches/{switches_id}', 'PuertoSwitcheController@create');
$app->put('/puertos/{puerto_id}/switches/{switches_id}', 'PuertoSwitcheController@update');
$app->patch('/puertos/{puerto_id}/switches/{switches_id}', 'PuertoSwitcheController@update');
$app->delete('/puertos/{puerto_id}/switches/{switches_id}', 'PuertoSwitcheController@destroy');

//puertos - vlans (No pos esta ya esta alla arriba en el controlador de los puertos)



