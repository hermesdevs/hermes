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
// Servidores - Puertos
//===============================================
$app->get('/servidores/{servidor_id}/puertos/', 'ServidorPuertoController@index');
$app->post('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@create');
$app->put('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->patch('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@update');
$app->delete('/servidores/{servidor_id}/puertos/{puerto_id}', 'ServidorPuertoController@destroy');

// $app->get('/servidores/{id}', 'ServidorController@show');
// $app->post('/servidores', 'ServidorController@create');
// $app->put('/servidores/{id}', 'ServidorController@update');
// $app->patch('/servidores/{id}', 'ServidorController@update');
// $app->delete('/servidores/{id}', 'ServidorController@destroy');



//===============================================
//===============================================
// Rutas Completas
//===============================================
//===============================================



//===============================================
// Servidores - Puertos
//===============================================
$app->get('/servidores/puertos/', 'ServidorPuertoController@allServidoresWithPuertos');
