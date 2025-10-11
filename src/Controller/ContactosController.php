<?php
declare(strict_types=1);

namespace App\Controller;

class ContactosController extends AppController
{
    public function index()
    {
        $this->set('title', 'Contactos');
    }
}
