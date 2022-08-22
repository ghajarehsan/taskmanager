<?php

namespace App\Http\Controllers;

use  \App\Services\Traits\Ticket\TicketTrait;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    use TicketTrait;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }


}
