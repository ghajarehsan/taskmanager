<?php

namespace Database\Seeders;

use App\Models\Departmentlevel;
use App\Models\Ticketlevel;
use App\Models\User;
use Illuminate\Database\Seeder;

class DepartmentLevelTicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departmentlevel::create([
            'level' => 1,
            'ticket_level_id' => Ticketlevel::first()->id,
            'user_id' => User::first()->id
        ]);
    }
}
