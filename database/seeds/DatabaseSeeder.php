<?php

use Illuminate\Database\Seeder;

use App\Equipo;
use App\Puerto;
use App\User;

class DatabaseSeeder extends Seeder
{
    public function run(){

        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        // Equipo::truncate();
        Puerto::truncate();
        // User::truncate();
        // DB::table('equipo_user')->truncate();
        // DB::table('equipo_puerto')->truncate();

        // factory(Equipo::class, 50)->create();
        factory(Puerto::class, 58)->create();
        // factory(User::class, 50)->create();
                
        // factory(App\Equipo::class, 50)->create()->each(function ($u) {
        //     $u->puerto()->save(factory(App\Puerto::class)->make());
        // });

        // factory(App\Equipo::class, 50)->create()->each(function ($e) {
        //     $e->user()->save(factory(App\User::class)->make());
        // });

    }
}
