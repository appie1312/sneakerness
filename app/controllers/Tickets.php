<?php

class Tickets extends BaseController
{
    public function overzicht()
    {
        $model = $this->model('TicketModel');
        $tickets = $model->getTickets();

        $data = [
            'tickets' => $tickets
        ];

        $this->view('tickets/index', $data);
    }
}
