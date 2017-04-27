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
            'user.index' => 'permissions.user.index',
            'user.create' => 'permissions.user.create',
            'user.delete' => 'permissions.user.delete',
            'olympiad.index' => 'permissions.olympiad.index',
            'olympiad.create' => 'permissions.olympiad.create',
            'olympiad.edit' => 'permissions.olympiad.edit',
            'school.list' => 'permissions.school.list',
            'school.create' => 'permissions.school.create',
            'school.edit' => 'permissions.school.edit',
            'student.create' => 'permissions.student.create',
            'student.edit' => 'permissions.student.edit',
            'room.create' => 'permissions.room.create',
            'room.edit' => 'permissions.room.edit',
            'participant.index' => 'permissions.participant.index',
            'participant.assign' => 'permissions.participant.assign',
        ];

        $regularUserPerms = ['participant.index', 'participant.assign', 'olympiad.index'];

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
