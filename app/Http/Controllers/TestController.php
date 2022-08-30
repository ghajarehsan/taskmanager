<?php

namespace App\Http\Controllers;

use App\Models\Departmentlevel;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\Ticket;
use App\Models\Ticketlevel;
use App\Models\Ticketuser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class TestController extends Controller
{


    public function createTicket()
    {
        Ticket::create([
            'subject' => 'fix network',
            'description' => 'fix it fast',
            'user_id' => 3,
            'department_id' => 1,
            'status_id' => 1
        ]);
    }

    public function createTicketLevel()
    {
        Ticketlevel::create([
            'level' => 1,
            'ticket_id' => 1,
            'department_id' => 2,
        ]);
    }

    public function createDepartmentLevel()
    {

        Departmentlevel::create([
            'level' => 1,
            'ticket_level_id' => 1,
            'user_id' => 4
        ]);

    }

    public function getCreatedTickets()
    {
        $tickets = Ticket::where('status_id', 1)
            ->with('ticketLevels', function ($ticketLevel) {
                $ticketLevel->with('departmentLevels', function ($depLevel) {
                    $depLevel->with('tasks', function ($task) {
                        $task->with('subTasks');
                    });
                });
            })
            ->get();

        $ticketNumber = 0;
        $ticketLevelNumber = 0;


        foreach ($tickets as $ticket) {
            $ticketNumber++;
            foreach ($ticket->ticketLevels as $ticket_levels) {
                $ticketLevelNumber++;
            }
        }

        return $ticketLevelNumber;
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
            'state' => 0,
            'priority' => 1,
            'deadline' => '2022-08-17 05:16:17',
            'privilege' => 3,
            'start_time' => '2022-08-17 05:16:17',
            'end_time' => '2022-08-17 05:16:17',
            'department_level_id' => 1
        ]);
    }

    public function addSubTask()
    {

        Subtask::create([

            'subject' => 'sample sub task',
            'priority' => 1,
            'deadline' => '2022-08-17 07:00:00',
            'privilege' => 3,
            'start_time' => '2022-08-17 07:00:00',
            'end_time' => '2022-08-17 07:00:00',
            'user_id' => 3,
            'task_id' => 1
        ]);

    }



}
