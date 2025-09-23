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

}