<?php

namespace Database\Seeders;

use App\Models\Subtask;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubTaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Subtask::create([

            'subject' => 'sample sub task',
            'priority' => 1,
            'deadline' => '2022-08-17 07:00:00',
            'privilege' => 3,
            'start_time' => '2022-08-17 07:00:00',
            'end_time' => '2022-08-17 07:00:00',
            'user_id' => User::first()->id,
            'task_id' => Task::first()->id,
        ]);

    }
}
