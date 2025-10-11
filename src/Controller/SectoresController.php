<?php
declare(strict_types=1);

namespace App\Controller;

class SectoresController extends AppController
{
    public function index()
    {
        $this->set('title', 'Sectores');
    }
}
