<?php
declare(strict_types=1);

namespace App\Controller;

class SeguimientoController extends AppController
{
    public function estado()
    {
        $this->set('title', 'Estados de Seguimiento');
    }
}
