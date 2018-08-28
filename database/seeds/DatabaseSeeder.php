<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        $this->call(userTableSeeder::class);
        $this->call(hrl1TableSeeder::class);
        $this->call(hrl1CategoryTableSeeder::class);
        $this->call(hrl1PositionTableSeeder::class);
        $this->call(tel1TableSeeder::class);
        $this->call(pel2TableSeeder::class);
    }
}
