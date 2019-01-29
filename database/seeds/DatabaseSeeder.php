<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        // La creación de datos de roles debe ejecutarse primero
        $this->call(RoleTableSeeder::class);

        // La creación de ASociaciones de roles debe ejecutarse antes de la creación de usuarios
        $this->call(AsociacionTableSeeder::class);


        // Los usuarios necesitarán los roles previamente generados
        $this->call(UserTableSeeder::class);
    }
}
