<?php
require_once __DIR__ . '/../models/VerkoperModel.php';
require_once __DIR__ . '/../libraries/Database.php';

class Verkopers extends BaseController
{
    private VerkoperModel $verkoperModel;

    public function __construct()
    {
        $db  = new Database();
        $this->verkoperModel = new VerkoperModel($db);
    }

    public function index(): void
    {
        $verkopers = $this->verkoperModel->getAlleVerkopers();


        require APPROOT . '/views/verkopers/index.php';
    }

    public function create(): void
    {
        require APPROOT . '/views/includes/header.php';
        require APPROOT . '/views/verkopers/create.php';
        require APPROOT . '/views/includes/footer.php';
    }

    public function store(): void
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $data = [
            'Naam' => trim($_POST['Naam']),
            'SpecialeStatus' => isset($_POST['SpecialeStatus']) ? 1 : 0,
            'VerkooptSoort' => trim($_POST['VerkooptSoort']),
            'StandType' => trim($_POST['StandType']),
            'Dagen' => trim($_POST['Dagen']),
            'IsActief' => isset($_POST['IsActief']) ? 1 : 0,
            'Opmerking' => trim($_POST['Opmerking'])
        ];

        // Validatie regels
        if (empty($data['Naam'])) {
            $errors['Naam'] = 'Naam is verplicht.';
        } elseif (strlen($data['Naam']) > 255) {
            $errors['Naam'] = 'Naam mag maximaal 255 tekens bevatten.';
        }

        if (empty($data['StandType'])) {
            $errors['StandType'] = 'Stand Type is verplicht.';
        } elseif (!in_array($data['StandType'], ['A', 'AA', 'AA+'])) {
            $errors['StandType'] = 'Ongeldige stand type geselecteerd.';
        }


        // Als er fouten zijn, toon opnieuw het formulier met fouten
        if (!empty($errors)) {
            require APPROOT . '/views/includes/header.php';
            require APPROOT . '/views/verkopers/create.php';
            require APPROOT . '/views/includes/footer.php';
            return;
        }

        
        // ... na validatie en vóór het toevoegen:
        if ($this->verkoperModel->bestaatVerkoper($data['Naam'])) {
            header("Location: /" . URLROOT . "/verkopers/index?error=exists");
            exit;
        }

        // Als alles goed is
        try {
            $this->verkoperModel->addVerkoper($data);
            header("Location: /" . URLROOT . "/verkopers/index?success=1");
            exit;
        } catch (Exception $e) {
            echo '<div class="alert alert-danger">Fout bij toevoegen van verkoper: ' . $e->getMessage() . '</div>';
        }
    }
}

}