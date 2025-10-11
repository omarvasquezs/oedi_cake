<?php
declare(strict_types=1);

namespace App\Controller;

class PrimerAcercamientoController extends AppController
{
    public function index()
    {
        $this->set('title', 'Primeros Acercamientos');
    }
}
