<?php

class Stands extends BaseController
{
    public function overzicht()
    {
        $model = $this->model('StandsModel');
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
        $this->view('stands/create');
    }

    // Nieuwe stand opslaan
        public function store()
        {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $data = [
                    'StandType'      => trim($_POST['standType']),
                    'Prijs'          => trim($_POST['prijs']),
                    'VerhuurdStatus' => (int)$_POST['verhuurdStatus'],
                    'Opmerking'      => trim($_POST['opmerking']),
                ];

                $model = $this->model('StandsModel');
                if ($model->addStand($data)) {
                    $_SESSION['flash_message'] = 'Stand succesvol aangemaakt!';
                    header('Location: ' . URLROOT . '/stands/index');
                    exit;
                }
                die('Opslaan mislukt.');
            }

            header('Location: ' . URLROOT . '/stands/create');
            exit;
        }
    }

