<?php

use Illuminate\Database\Seeder;

class RolesSeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = \App\Models\Role::create([
            'titleRole'=>'user'
        ]);

        $doctor = \App\Models\Role::create([
            'titleRole'=>'doctor'
        ]);

        $admin = \App\Models\Role::create([
            'titleRole'=>'admin'
        ]);
    }
}
