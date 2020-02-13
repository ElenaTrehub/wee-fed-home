<?php

use Illuminate\Database\Seeder;

class StatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anonim = \App\Models\Status::create([
            'titleStatus'=>'anonim'
        ]);

        $active_user = \App\Models\Status::create([
            'titleStatus'=>'active_user'
        ]);

        $no_varification_user = \App\Models\Status::create([
            'titleStatus'=>'no_varification_user'
        ]);

        $block_user = \App\Models\Status::create([
            'titleStatus'=>'block_user'
        ]);
    }
}
