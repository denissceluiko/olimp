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

        $ruser = new \App\User(['name' => 'Regular user', 'email' => 'user@olimp', 'password' => bcrypt('user@olimp')]);
        $ruser->save();

        $su = new Role(['name' => 'superuser', 'label' => 'Superuser']);
        $su->save();

        $ru = new Role(['name' => 'user', 'label' => 'User']);
        $ru->save();

        $perms = [
            'users.create' => 'permissions.users.create',
            'users.delete' => 'permissions.users.delete',
            'olympiads.create' => 'permissions.olympiads.create',
            'olympiads.edit' => 'permissions.olympiads.edit',
            'schools.list' => 'permissions.schools.list',
            'schools.create' => 'permissions.schools.create',
            'schools.edit' => 'permissions.schools.edit',
            'students.create' => 'permissions.students.create',
            'students.edit' => 'permissions.students.edit',
            'rooms.create' => 'permissions.rooms.create',
            'rooms.edit' => 'permissions.rooms.edit',
            'participants.index' => 'permissions.participants.index',
            'participants.assign' => 'permissions.participants.assign',
        ];

        $regularUserPerms = ['participants.index', 'participants.assign'];

        foreach ($perms as $name => $label) {
            $p = new \App\Permission(compact('name', 'label'));
            $p->save();
            $su->permissions()->save($p);

            if (in_array($name, $regularUserPerms)) {
                $ru->permissions()->save($p);
            }
        }

        $user->roles()->save($su);
        $ruser->roles()->save($ru);
    }
}
