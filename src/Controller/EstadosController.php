<?php
declare(strict_types=1);

namespace App\Controller;

class EstadosController extends AppController
{
    public function index()
    {
        $this->set('title', 'Estados');
    }
}
