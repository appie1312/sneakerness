<?php
require_once __DIR__ . '/../models/VerkoperModel.php';
require_once __DIR__ . '/../libraries/Database.php';

class VerkopersController extends BaseController
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

        $this->view('verkopers/index');

        // require APPROOT . '/views/includes/header.php';
        // require APPROOT . '/views/verkopers/index.php';
        // require APPROOT . '/views/includes/footer.php';
    }

}