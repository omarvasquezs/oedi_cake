<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * DireccionLinea Entity
 *
 * @property int $id_direccion_linea
 * @property string $descripcion
 * @property \Cake\I18n\FrozenTime|null $created_at
 * @property \Cake\I18n\FrozenTime|null $updated_at
 * @property \Cake\I18n\FrozenTime|null $deleted_at
 */
class DireccionLinea extends Entity
{
    /**
     * @var array<string, bool>
     */
    protected array $_accessible = [
        '*' => true,
        'id_direccion_linea' => false,
    ];
}
