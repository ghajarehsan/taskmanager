<?php


namespace App\Services\Traits\Ticket;

use App\Http\Resources\TicketCollection;
use App\Models\Ticket;


trait TicketTrait
{
    public function getAllTicket()
    {

        $ticket = new Ticket();

        $ticket = $this->setFilterForAllTicket($ticket);

        $ticket = $this->setPaginateForAllTicket($ticket);

        return $ticket;
    }

    private function setPaginateForAllTicket($ticket)
    {
        $perPage = 15;

        if ($this->request->has('perPage') && $this->request->perPage != null) {
            if ($this->request->perPage == 'all') return $ticket->get();
            $perPage = $this->request->perPage;
        }
        return $ticket->paginate($perPage);
    }

    private function setFilterForAllTicket($ticket)
    {
        if ($this->request->has('id') && $this->request->id != null) {
            $ticket = $ticket->where('id', $this->request->id);
        }
        if ($this->request->has('subject') && $this->request->subject != null) {
            $ticket = $ticket->where('subject', 'like', '%' . $this->request->subject . '%');
        }
        if ($this->request->has('description') && $this->request->description != null) {
            $ticket = $ticket->where('description', 'like', '%' . $this->request->description . '%');
        }
        if ($this->request->has('user_id') && $this->request->user_id != null) {
            $ticket = $ticket->where('user_id', $this->request->user_id);
        }
        if ($this->request->has('status_id') && $this->request->status_id != null) {
            $ticket = $ticket->where('status_id', $this->request->status_id);
        }
        if ($this->request->has('start_date') && $this->request->start_date != null) {
            $ticket = $ticket->whereDate('created_at', '>=', $this->request->start_date);
        }
        if ($this->request->has('end_date') && $this->request->end_date != null) {
            $ticket = $ticket->whereDate('created_at', '<=', $this->request->end_date);
        }
        if ($this->request->has('sortBy') && $this->request->sortBy != null) {
            if ($this->request->sortBy == 'desc' || $this->request->sortBy == 'asc') {
                $ticket = $ticket->orderBy('created_at', $this->request->sortBy);
            }
        }
        return $ticket;
    }
}
