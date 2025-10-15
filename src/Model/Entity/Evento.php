<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\I18n\FrozenDate;
use Cake\I18n\FrozenTime;
use Cake\ORM\Entity;

/**
 * Evento Entity
 *
 * @property int $id_evento
 * @property int $id_municipalidad
 * @property int $id_contacto
 * @property string $tipo_acercamiento
 * @property string $lugar
 * @property \Cake\I18n\FrozenDate $fecha
 * @property string|null $modalidad
 * @property string|null $descripcion
 * @property int $creado_por
 * @property int $actualizado_por
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class Evento extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '*' => true,
        'id_evento' => false,
    ];
}
