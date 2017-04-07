<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;

class InitialDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User(['name' => 'Admin', 'email' => 'admin@olimp', 'password' => bcrypt('admin@olimp')]);
        $user->save();

        $su = new Role(['name' => 'superuser', 'label' => 'Superuser']);
        $su->save();

        $user->roles()->save($su);
    }
}
