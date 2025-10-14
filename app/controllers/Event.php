<?php
require_once __DIR__ . '/../models/EventModel.php';
require_once __DIR__ . '/../libraries/Database.php';

use App\Model\EventModel;

class Event extends BaseController
{
    private EventModel $eventModel;

    public function __construct()
    {
        $db  = new Database();
        $pdo = $db->getConnection();   // of getDb()/connect() afhankelijk van jouw Database.php
        $this->eventModel = new EventModel($pdo);
    }

    public function index(): void
    {
        $ourEvents  = $this->eventModel->getCurrentEvents(45);
        $comingSoon = $this->eventModel->getComingSoonEvents(45);
        $pageTitle  = 'Events';

        // ▼ In plaats van $this->render(...)
        //   Gewoon handmatig header -> view -> footer includen
        require APPROOT . '/views/includes/header.php';

        // Maak variabelen beschikbaar in de view
        // (optioneel) extract(['ourEvents'=>$ourEvents, 'comingSoon'=>$comingSoon, 'pageTitle'=>$pageTitle]);
        $ourEvents  = $ourEvents;
        $comingSoon = $comingSoon;

        require APPROOT . '/views/event/index.php';
    }

    public function create(): void
    {
        $pageTitle = 'Nieuw Event';
        $locations = $this->eventModel->getLocations();

        require APPROOT . '/views/includes/header.php';
        $locations = $locations;
        require APPROOT . '/views/event/create.php';
    }

    public function store(): void
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: ' . URLROOT . '/event/index');
    }

    // Sessie nodig voor flash
    if (session_status() === PHP_SESSION_NONE) { session_start(); }

    $data = [
        'Naam'    => $_POST['Naam'] ?? '',
        'Datum'   => $_POST['Datum'] ?? '',
        'Locatie' => $_POST['Locatie'] ?? '',
    ];

    $errors = [];
    if (trim($data['Naam']) === '') $errors[] = 'Naam is verplicht.';
    if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $data['Datum'])) $errors[] = 'Ongeldige datum.'; //reguiler expression
    if (trim($data['Locatie']) === '') $errors[] = 'Locatie is verplicht.';

    // Dubbele NAAM check
    if (empty($errors) && $this->eventModel->eventNameExists($data['Naam'])) {
        $errors[] = 'Deze event bestaat al';
    }

    if ($errors) {
        $pageTitle  = 'Nieuw Event';
        $locations  = $this->eventModel->getLocations();
        $formErrors = $errors;
        $old        = $data;

        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/event/create.php';
        return;
    }

    // Opslaan (model vult defaults voor verplichte velden)
    if ($this->eventModel->createEvent($data)) {
        $_SESSION['flash_success'] = 'Event succesvol toegevoegd.';
        header('Location: ' . URLROOT . '/event/index');
    }

    // Opslaan mislukt
    $pageTitle  = 'Nieuw Event';
    $locations  = $this->eventModel->getLocations();
    $formErrors = ['Opslaan mislukt. Probeer opnieuw.'];
    $old        = $data;

    require APPROOT . '/views/includes/header.php';
    require APPROOT . '/views/event/create.php';
}

}
