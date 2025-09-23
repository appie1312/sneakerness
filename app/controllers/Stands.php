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
}
