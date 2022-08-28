<?php

namespace Database\Seeders;

use App\Models\Level;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $seeders = [
            [
                'name' => 'admin',
                'persian_name' => 'مدیر',
                'priority' => '0'
            ],
            [
                'name' => 'expert',
                'persian_name' => 'کارشناس',
                'priority' => '1'
            ]
        ];
        foreach ($seeders as $seeder) {
            $level = Level::where('name', $seeder['name'])->first();
            if (!$level) {
                $level = new Level();
                $level->name = $seeder['name'];
                $level->persian_name = $seeder['persian_name'];
                $level->priority = $seeder['priority'];
                $level->save();
            }
        }

    }
}
