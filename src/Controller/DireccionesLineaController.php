<?php
declare(strict_types=1);

namespace App\Controller;

class DireccionesLineaController extends AppController
{
    public function index()
    {
        $this->set('title', 'Direcciones de Línea');
    }
}
