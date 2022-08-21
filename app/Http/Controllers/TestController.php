<?php

namespace App\Http\Controllers;

use App\Models\Subtask;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Ticketuser;
use App\Models\User;
use Illuminate\Http\Request;

class TestController extends Controller
{

    public function createTicket()
    {
        Ticket::create([
            'subject' => 'fix network',
            'description' => 'fix it fast',
            'user_id' => 2,
            'department_id' => 2
        ]);
    }

    public function createTicketUser()
    {

        Ticketuser::create([

            'level' => $this->getTicketUserLevel(),

            'ticket_id' => 2,

            'user_id' => 4,

            'department_id' => 1,

            'status_id' => 2
        ]);

    }

    private function getTicketUserLevel()
    {

        $level = Ticketuser::where('ticket_id', 2)
            ->where('user_id', 2)
            ->where('department_id', 2)
            ->get()->last();

        return $level ? $level->level + 1 : 1;

    }

    public function getConfirmedTickets()
    {

        $ticket = Ticketuser::where('status_id', 2)
            ->where('department_id', 1)
            ->get();

        dd($ticket);

    }

    public function getAcceptedTickets()
    {

        $tickets = Ticketuser::
        where('status_id', 5)
            ->where('user_id', 4)
            ->with('ticket', function ($ticket) {
                $ticket->with('tasks', function ($task) {
                    $task->with('subTasks');
                });
            })
            ->get();

        return $tickets;

    }

    public function addTask()
    {
        Task::create([
            'subject' => 'fix speed',
            'status' => 0,
            'priority' => 1,
            'deadline' => '2022-08-17 05:16:17',
            'privilege' => 3,
            'worklog' => '29:24:00',
            'ticket_id' => 2,
            'user_id' => 2
        ]);
    }

    public function addSubTask()
    {

        Subtask::create([

            'subject' => 'sample sub task',
            'priority' => 1,
            'deadline' => '2022-08-17 07:00:00',
            'privilege' => 3,
            'ticket_id' => 2,
            'user_id' => 3,
            'task_id' => 1
        ]);

    }

}
