<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class Convenio extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'id_municipalidad' => true,
        'tipo_convenio' => true,
        'monto' => true,
        'fecha_firma' => true,
        'id_estado_convenio' => true,
        'descripcion' => true,
        'codigo_convenio' => true,
        'codigo_idea_cui' => true,
        'descripcion_idea_cui' => true,
        'beneficiarios' => true,
        'codigo_interno' => true,
        'id_sector' => true,
        'id_direccion_linea' => true,
        'creado_por' => true,
        'actualizado_por' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
        'municipalidade' => true,
        'estado_convenio' => true,
        'sectore' => true,
        'direcciones_linea' => true,
        'usuario_creador' => true,
        'usuario_actualizador' => true,
        'convenios_seguimiento' => true,
    ];
}
