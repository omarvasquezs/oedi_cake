<?php
declare(strict_types=1);

namespace App\Controller;

class EntidadesController extends AppController
{
    public function index()
    {
        $this->set('title', 'Entidades');
    }
}
