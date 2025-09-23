<?php

class Contact extends BaseController
{
    public function overzicht()
    {
        $model = $this->model('ContactModel');
        $contact = $model->getContact();

        $data = [
            'contact' => $contact
        ];

        $this->view('contact/index', $data);
    }
    
    public function index()
    {
        // Laat index gewoon overzicht aanroepen
        $this->overzicht();
    }
}
