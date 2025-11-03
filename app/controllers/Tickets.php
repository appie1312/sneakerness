<?php

class Tickets extends BaseController
{
    private TicketModel $TicketModel;

    public function __construct()
    {
        $this->TicketModel = $this->model('TicketModel');
    }

    public function overzicht()
    {
        $tickets = $this->TicketModel->getTickets();

        $data = ['tickets' => $tickets];
        $this->view('tickets/index', $data);
    }

    public function index()
    {
        $this->overzicht();
    }

    public function delete($Id)
    {
        try {
            $this->TicketModel->delete($Id);
            header('Refresh:3; url=' . URLROOT . '/tickets/index');
     
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Fout bij verwijderen: ' . $e->getMessage() . '</div>';
        }
    }

    //create voor de ticket en prijs
public function create()
{
    $data = [
        'title' => 'Nieuwe Ticket toevoegen',
        'message' => 'none',
        'evenementen' => $this->TicketModel->getEvenementen() // alleen ophalen
    ];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        try {
            if (
                empty($_POST['EvenementId']) ||
                empty($_POST['PrijsTijdslot']) ||
                empty($_POST['PrijsTarief']) ||
                empty($_POST['AantalTickets']) ||
                empty($_POST['Datum'])
            ) {
                echo '<div class="alert alert-danger text-center"><h4>Vul alle velden in</h4></div>';
                header('Refresh:1; url=http://sneakerness/tickets/create');
                exit;
            }

            $prijsId = $this->TicketModel->createPrijs($_POST);

            $_POST['PrijsId'] = $prijsId;
            $this->TicketModel->createTicket($_POST);

            echo '<div class="alert alert-success text-center"><h4>Ticket succesvol toegevoegd!</h4></div>';
            header('Refresh:3; url=http://sneakerness/tickets/index');

        } catch (Exception $e) {
            echo '<div class="alert alert-danger text-center"><h4>Fout: ' . $e->getMessage() . '</h4></div>';
        }
    }

    $this->view('tickets/create', $data);
}

public function update($Id = null)
    {
        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                // process POST update
                if (empty($_POST['Id'])) {
                    echo '<div class="alert alert-danger text-center"><h4>Geen ticket ID opgegeven.</h4></div>';
                    header('Refresh:2; url=' . URLROOT . '/tickets/index');
                    exit;
                }

                $result = $this->TicketModel->updateTicket($_POST);

                if ($result === false) {
                    // database fout
                    echo '<div class="alert alert-danger text-center"><h4>Fout bij bijwerken ticket.</h4></div>';
                } elseif ($result === 0) {
                    // geen rijen gewijzigd => geen aanpassing gemaakt
                    echo '<div class="alert alert-info text-center"><h4>Ticket niet gewijzigd: geen aanpassingen gevonden.</h4></div>';
                } else {
                    // $result > 0
                    echo '<div class="alert alert-success text-center"><h4>Ticket succesvol gewijzigd!</h4></div>';
                }

                header('Refresh:2; url=' . URLROOT . '/tickets/index');
                exit;
            }

            // GET -> show edit form
            $id = $Id ?? ($_GET['id'] ?? null);
            if (empty($id)) {
                header('Location: ' . URLROOT . '/tickets/index');
                exit;
            }

            $ticket = $this->TicketModel->getTicketById($id);
            if (!$ticket) {
                echo '<div class="alert alert-danger text-center"><h4>Ticket niet gevonden.</h4></div>';
                header('Refresh:2; url=' . URLROOT . '/tickets/index');
                exit;
            }

            $data = [
                'ticket' => $ticket,
                'evenementen' => $this->TicketModel->getEvenementen(),
                'prijzen' => $this->TicketModel->getPrijzen()
            ];

            $this->view('tickets/update', $data);
        } catch (Exception $e) {
            echo '<div class="alert alert-danger text-center"><h4>Fout: ' . $e->getMessage() . '</h4></div>';
            header('Refresh:3; url=' . URLROOT . '/tickets/index');
            exit;
        }
    }

}
