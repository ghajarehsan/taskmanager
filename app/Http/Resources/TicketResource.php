<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TicketResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'ticket_id' => $this->id,
            'subject' => $this->subject,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'department_id' => $this->department_id,
            'status_id' => $this->status_id,
        ];
    }
}
