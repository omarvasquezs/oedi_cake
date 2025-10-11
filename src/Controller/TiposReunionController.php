<?php
declare(strict_types=1);

namespace App\Controller;

class TiposReunionController extends AppController
{
    public function index()
    {
        $this->set('title', 'Tipos de Reunión');
    }
}
