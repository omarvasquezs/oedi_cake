<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class ConvenioSeguimiento extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'id_convenio' => true,
        'fecha' => true,
        'id_estado_convenio' => true,
        'comentarios' => true,
        'acciones_realizadas' => true,
        'alertas_identificadas' => true,
        'acciones_desarrollar' => true,
        'fecha_seguimiento' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
        'convenio' => true,
        'estado_convenio' => true,
    ];
}
