<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Database\Seeder;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ticket::create([
            'subject' => 'fix network',
            'description' => 'fix it fast',
            'user_id' => User::where('email', 'ghajar@yahoo.com')->first()->id,
            'department_id' => Department::where('name', 'it')->first()->id,
            'status_id' => Status::where('name', 'created')->first()->id,
        ]);

    }
}
