<?php
declare(strict_types=1);

namespace App\Controller;

class EstadosConvenioController extends AppController
{
    public function index()
    {
        $this->set('title', 'Estados de Convenio');
    }
}
