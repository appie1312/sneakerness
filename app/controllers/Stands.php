<?php

class Stands extends BaseController
{
    public function overzicht()
    {
        $model  = $this->model('StandsModel');
        $stands = $model->getStands();

        $data = [
            'stands' => $stands
        ];

        $this->view('stands/index', $data);
    }
    
    public function index()
    {
        // Laat index gewoon overzicht aanroepen
        $this->overzicht();
    }

    // Create formulier tonen
    public function create()
    {
        $model = $this->model('StandsModel');
        $verkopers = $model->getVerkopers(); // nieuw

        $data = [
            'verkopers' => $verkopers
        ];

        $this->view('stands/create', $data);
    }

    // Nieuwe stand opslaan
    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . URLROOT . '/stands/create');
            exit;
        }

        // Haal en trim inputs
        $verkoperId     = isset($_POST['verkoperId']) ? (int)$_POST['verkoperId'] : 0;
        $standType      = isset($_POST['standType']) ? trim($_POST['standType']) : '';
        $prijs          = isset($_POST['prijs']) ? trim($_POST['prijs']) : '';
        $verhuurdStatus = isset($_POST['verhuurdStatus']) ? (int)$_POST['verhuurdStatus'] : 0;
        $opmerking      = isset($_POST['opmerking']) ? trim($_POST['opmerking']) : null;

        // Validatie
        $allowedTypes = ['A', 'AA', 'AA+'];
        $errors = [];

        if ($verkoperId <= 0) {
            $errors[] = 'Kies een geldige verkoper.';
        }
        if (!in_array($standType, $allowedTypes, true)) {
            $errors[] = 'Ongeldig standtype (A, AA of AA+).';
        }
        if ($prijs === '' || !is_numeric($prijs) || (float)$prijs < 0) {
            $errors[] = 'Voer een geldige prijs in.';
        }
        if (!in_array($verhuurdStatus, [0,1], true)) {
            $errors[] = 'Ongeldige status.';
        }

        if (!empty($errors)) {
            // Eventueel flash gebruiken
            $_SESSION['flash_message'] = implode(' ', $errors);
            header('Location: ' . URLROOT . '/stands/create');
            exit;
        }

        $data = [
            'VerkoperId'     => $verkoperId,
            'StandType'      => $standType,
            'Prijs'          => $prijs,
            'VerhuurdStatus' => $verhuurdStatus,
            'Opmerking'      => $opmerking
        ];

        $model = $this->model('StandsModel');

        try {
            if ($model->addStand($data)) {
                $_SESSION['flash_message'] = 'Stand succesvol aangemaakt!';
                header('Location: ' . URLROOT . '/stands/index');
                exit;
            }
            // Als execute false teruggeeft
            $_SESSION['flash_message'] = 'Opslaan mislukt.';
            header('Location: ' . URLROOT . '/stands/create');
            exit;
        } catch (Exception $e) {
            // Toon beknopte melding, log eventueel $e->getMessage()
            $_SESSION['flash_message'] = 'Er ging iets mis bij het opslaan.';
            header('Location: ' . URLROOT . '/stands/create');
            exit;
        }
    }

    // Stand bewerken (formulier tonen)
    public function edit($id)
    {
        $model = $this->model('StandsModel');
        $stand = $model->getStandById((int)$id);
        $verkopers = $model->getVerkopers();

        if (!$stand) {
            $_SESSION['flash_message'] = 'Stand niet gevonden.';
            header('Location: ' . URLROOT . '/stands/index');
            exit;
        }

        $data = [
            'stand' => $stand,
            'verkopers' => $verkopers
        ];

        $this->view('stands/edit', $data);
    }

    // Wijzigingen opslaan
    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . URLROOT . '/stands/index');
            exit;
        }

        $allowedTypes = ['A', 'AA', 'AA+'];

        $payload = [
            'Id'             => (int)$id,
            'VerkoperId'     => (int)($_POST['verkoperId'] ?? 0),
            'StandType'      => trim($_POST['standType'] ?? ''),
            'Prijs'          => trim($_POST['prijs'] ?? ''),
            'VerhuurdStatus' => (int)($_POST['verhuurdStatus'] ?? 0),
            'Opmerking'      => trim($_POST['opmerking'] ?? '')
        ];

        $errors = [];
        if ($payload['VerkoperId'] <= 0) $errors[] = 'Kies een geldige verkoper.';
        if (!in_array($payload['StandType'], $allowedTypes, true)) $errors[] = 'Ongeldig standtype.';
        if ($payload['Prijs'] === '' || !is_numeric($payload['Prijs']) || (float)$payload['Prijs'] < 0) $errors[] = 'Voer een geldige prijs in.';
        if (!in_array($payload['VerhuurdStatus'], [0,1], true)) $errors[] = 'Ongeldige status.';

        if ($errors) {
            $_SESSION['flash_message'] = implode(' ', $errors);
            header('Location: ' . URLROOT . '/stands/edit/' . (int)$id);
            exit;
        }

        $model = $this->model('StandsModel');
        if ($model->updateStand($payload)) {
            $_SESSION['flash_message'] = 'Stand succesvol bijgewerkt!';
            header('Location: ' . URLROOT . '/stands/index');
            exit;
        }

        $_SESSION['flash_message'] = 'Wijzigen mislukt.';
        header('Location: ' . URLROOT . '/stands/edit/' . (int)$id);
        exit;
    }

    // Verwijderbevestiging tonen
    public function delete($id)
    {
        $model = $this->model('StandsModel');
        $stand = $model->getStandById((int)$id);

        if (!$stand) {
            $_SESSION['flash_message'] = 'Stand niet gevonden.';
            header('Location: ' . URLROOT . '/stands/index');
            exit;
        }

        $this->view('stands/delete', ['stand' => $stand]);
    }

    // Echte verwijderactie
    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . URLROOT . '/stands/index');
            exit;
        }

        $model = $this->model('StandsModel');
        if ($model->deleteStand((int)$id)) {
            $_SESSION['flash_message'] = 'Stand succesvol verwijderd!';
        } else {
            $_SESSION['flash_message'] = 'Verwijderen mislukt.';
        }

        header('Location: ' . URLROOT . '/stands/index');
        exit;
    }

}
