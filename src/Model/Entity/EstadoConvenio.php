<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EstadoConvenio Entity
 *
 * @property int $id_estado_convenio
 * @property string $descripcion
 * @property string|null $nombre
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class EstadoConvenio extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '*' => true,
        'id_estado_convenio' => false,
    ];
}
