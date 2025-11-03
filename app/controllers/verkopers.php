<?php

class Verkopers extends BaseController
{
    private $verkoperModel;

    public function __construct()
    {
        $this->verkoperModel = $this->model('VerkoperModel');
    }

    public function index()
    {
        $verkopers = $this->verkoperModel->getAlleVerkopers();
        $data = ['verkopers' => $verkopers];
        $this->view('verkopers/index', $data);
    }

    public function create()
    {
        $this->view('verkopers/create');
    }

    public function store()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . URLROOT . "/verkopers/create");
            exit;
        }

        $data = [
            'Naam' => trim($_POST['Naam']),
            'SpecialeStatus' => isset($_POST['SpecialeStatus']) ? 1 : 0,
            'VerkooptSoort' => trim($_POST['VerkooptSoort']),
            'StandType' => trim($_POST['StandType']),
            'Dagen' => trim($_POST['Dagen']),
            'Opmerking' => trim($_POST['Opmerking'])
        ];

        if ($this->verkoperModel->bestaatVerkoper($data['Naam'])) {
            header("Location: " . URLROOT . "/verkopers/create?error=exists");
            exit;
        }

        $this->verkoperModel->addVerkoper($data);
        header("Location: " . URLROOT . "/verkopers/index?success=1");
        exit;
    }

    public function edit($id)
    {
        $verkoper = $this->verkoperModel->getVerkoperById((int)$id);
        if (!$verkoper) {
            header("Location: " . URLROOT . "/verkopers/index?error=notfound");
            exit;
        }

        $data = ['verkoper' => $verkoper];
        $this->view('verkopers/edit', $data);
    }

    public function update($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . URLROOT . "/verkopers/index");
            exit;
        }

        $data = [
            'Id' => (int)$id,
            'Naam' => trim($_POST['Naam']),
            'SpecialeStatus' => isset($_POST['SpecialeStatus']) ? 1 : 0,
            'VerkooptSoort' => trim($_POST['VerkooptSoort']),
            'StandType' => trim($_POST['StandType']),
            'Dagen' => trim($_POST['Dagen']),
            'Opmerking' => trim($_POST['Opmerking'])
        ];

        if ($this->verkoperModel->bestaatVerkoper($data['Naam'], $id)) {
            header("Location: " . URLROOT . "/verkopers/edit/$id?error=exists");
            exit;
        }

        $this->verkoperModel->updateVerkoper($data);
        header("Location: " . URLROOT . "/verkopers/index?success=updated");
        exit;
    }

    public function delete($id)
    {
        $verkoper = $this->verkoperModel->getVerkoperById((int)$id);
        if (!$verkoper) {
            header("Location: " . URLROOT . "/verkopers/index?error=notfound");
            exit;
        }

        $data = ['verkoper' => $verkoper];
        $this->view('verkopers/delete', $data);
    }

    public function destroy($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("Location: " . URLROOT . "/verkopers/index");
            exit;
        }

        $this->verkoperModel->deleteVerkoper((int)$id);
        header("Location: " . URLROOT . "/verkopers/index?success=deleted");
        exit;
    }
}
