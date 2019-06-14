<?php

use Illuminate\Database\Seeder;

/**
 * @package Hire Talents
 * @author  Abhishek Prakash <prakashabhishek6262@gmail.com>
 */
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(OptionsSeeder::class);
        $this->call(ServicesSeeder::class);
        // $this->call(UsersSeeder::class);
    }
}
