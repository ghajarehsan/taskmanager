<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('statuses')->insert([

            [
                'name' => 'created'
            ],
            [
                'name' => 'forward'
            ],
            [
                'name' => 'confirmed'
            ],
            [
                'name' => 'rejected'
            ],
            [
                'name' => 'accepted'
            ],
            [
                'name' => 'declined'
            ],
            [
                'name' => 'successed'
            ],
            [
                'name' => 'failed'
            ]
        ]);

    }
}
