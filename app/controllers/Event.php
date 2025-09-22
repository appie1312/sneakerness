<?php
require_once __DIR__ . '/../model/EventModel.php';
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
        require APPROOT . '/views/includes/footer.php';
    }
}
