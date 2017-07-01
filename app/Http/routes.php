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

use Illuminate\Http\Request;

header('Access-Control-Allow-Origin: http://hermes.dev');
header('Access-Control-Allow-Credentials: true');

$app->get('/', function () use ($app) {
    return $app->version();
});

//===============================================
// Auth
//===============================================
$app->get('/login', 'AuthController@index');
$app->get('/register', 'AuthController@index');
$app->get('/forget', 'AuthController@index');

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
// Equipos - Puertos
//===============================================
$app->get('/equipos/{equipo_id}/puertos/', 'ServidorPuertoController@index');
$app->post('/equipos/{equipo_id}/puertos/{puerto_id}', 'ServidorPuertoController@create');
$app->put('/equipos/{equipo_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->patch('/equipos/{equipo_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->delete('/equipos/{equipo_id}/puertos/{puerto_id}', 'ServidorPuertoController@destroy');


//===============================================
// Servidores - Puertos
//===============================================
$app->get('/servidores/{servidor_id}/puertos/', 'ServidorPuertoController@index');
$app->post('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@create');
$app->put('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->patch('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->delete('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@destroy');




//===============================================
// Equipos - Puertos
//===============================================
$app->get('/switches/{sw_id}/puertos/', 'ServidorPuertoController@index');
$app->post('/switches/{sw_id}/puertos/{puerto_id}', 'ServidorPuertoController@create');
$app->put('/switches/{sw_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->patch('/switches/{sw_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->delete('/switches/{sw_id}/puertos/{puerto_id}', 'ServidorPuertoController@destroy');





//===============================================
//===============================================
// Rutas Completas
//===============================================
//===============================================

$app->get('/servidores/puertos/', 'AllController@Servidores_Puertos');
$app->get('/servidores/rangos/', 'AllController@Servidores_Rangos');

$app->get('/switches/puertos/', 'AllController@Switches_Puertos');
$app->get('/switches/equipos/', 'AllController@Switches_Equipos');
$app->get('/switches/rangos/', 'AllController@Switches_Rangos');

$app->get('/equipos/puertos/', 'AllController@Equipos_Puertos');
$app->get('/equipos/switches/', 'AllController@Equipos_Switches');
$app->get('/equipos/rangos/', 'AllController@Equipos_Rangos');
$app->get('/equipos/usuarios/', 'AllController@Equipos_Usuarios');

$app->get('/rangos/equipos/', 'AllController@Rangos_Equipos');
$app->get('/rangos/servidores/', 'AllController@Rangos_Servidores');
$app->get('/rangos/swtiches/', 'AllController@Rangos_Switches');

$app->get('/usuarios/equipos/', 'AllController@Usuarios_Equipos');

$app->get('/puertos/equipos/', 'AllController@Puertos_Equipos');
$app->get('/puertos/servidores/', 'AllController@Puertos_Servidores');
$app->get('/puertos/switches/', 'AllController@Puertos_Switches');
$app->get('/puertos/vlans/', 'AllController@Puertos_Vlans');
