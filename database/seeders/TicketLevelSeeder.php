<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Ticket;
use App\Models\Ticketlevel;
use Illuminate\Database\Seeder;

class TicketLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticketlevel::create([
            'level' => 1,
            'ticket_id' => Ticket::first()->id,
            'department_id' => Department::first()->id,
        ]);
    }
}
