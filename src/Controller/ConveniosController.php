<?php
declare(strict_types=1);

namespace App\Controller;

class ConveniosController extends AppController
{
    public function index()
    {
        $this->set('title', 'Convenios');
    }

    public function seguimiento()
    {
        $this->set('title', 'Seguimiento de Convenios');
    }
}
