<?php

namespace Database\Seeders;

use App\Models\Departmentlevel;
use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Task::create([
            'subject' => 'fix speed',
            'state' => 0,
            'priority' => 1,
            'deadline' => '2022-08-17 05:16:17',
            'privilege' => 3,
            'start_time' => '2022-08-17 05:16:17',
            'end_time' => '2022-08-17 05:16:17',
            'department_level_id' => Departmentlevel::first()->id
        ]);

    }
}
