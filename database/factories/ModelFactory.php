<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

use App\Equipo;
use App\Puerto;
use App\User;

$factory->define(App\Equipo::class, function (Faker\Generator $faker){
    return [
        "name" => $faker->name,
        "so" => $faker->randomElement($array = array("debian","linux","macos","ventana","pruebas")),
        "brand" => $faker->randomElement($array = array("marca1","marca2","marca3","marca4","marca5")),
        "model" => $faker->randomElement($array = array("modelo1","modelo2","modelo3","modelo4","modelo5")),
        "mac" => $faker->randomElement($array = array("mac1","mac2","mac3","mac4","AB:30:C3:20:FF:AA")),
        "ip" => $faker->randomElement($array = array("ip1","ip2","ip3","ip4","192.168.10.20"))
    ];
});

$factory->define(App\Puerto::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->randomElement($array = array("a0/1","fa0/2","fa0/3","fa0/4","gi0/1"))
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    $meses = array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
    return [
        "name" => $faker->name,
        "pass" => str_random(52),
        "profileImage" => $faker->name,
        "remember_token" => str_random(32),
        "date" => $faker->randomElement($meses),
         "mail" => $faker->email,
        "phone" => $faker->phoneNumber,
        "super_permission" => $faker->randomElement($array = array(true,false))
    ];
});
