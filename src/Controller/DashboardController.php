<?php
declare(strict_types=1);

namespace App\Controller;

class DashboardController extends AppController
{
    public function index()
    {
        // Dashboard landing page - Vista General
    }

    public function lista()
    {
        // Dashboard Lista de Entidades
        $this->set('title', 'Dashboard Lista de Entidades');
    }

    public function calendarioCompromisos()
    {
        // Calendario de Compromisos
        $this->set('title', 'Calendario de Compromisos');
    }
}
