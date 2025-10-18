<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * EstadoSeguimiento Entity
 *
 * @property int $id_estado
 * @property int $id_evento
 * @property int $id_contacto
 * @property int $id_tipo_reunion
 * @property \Cake\I18n\Date $fecha
 * @property int $id_estado_ref
 * @property string|null $descripcion
 * @property string|null $compromiso
 * @property \Cake\I18n\Date|null $fecha_compromiso
 * @property bool|null $compromiso_concluido
 * @property int $creado_por
 * @property int $actualizado_por
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 * @property \Cake\I18n\DateTime|null $deleted_at
 *
 * @property \App\Model\Entity\Evento $evento
 * @property \App\Model\Entity\Contacto $contacto
 * @property \App\Model\Entity\TipoReunion $tipo_reunion
 * @property \App\Model\Entity\Estado $estado
 * @property \App\Model\Entity\User $creado_por_user
 * @property \App\Model\Entity\User $actualizado_por_user
 */
class EstadoSeguimiento extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'id_evento' => true,
        'id_contacto' => true,
        'id_tipo_reunion' => true,
        'fecha' => true,
        'id_estado_ref' => true,
        'descripcion' => true,
        'compromiso' => true,
        'fecha_compromiso' => true,
        'compromiso_concluido' => true,
        'creado_por' => true,
        'actualizado_por' => true,
        'created_at' => true,
        'updated_at' => true,
        'deleted_at' => true,
        'evento' => true,
        'contacto' => true,
        'tipo_reunion' => true,
        'estado' => true,
        'creado_por_user' => true,
        'actualizado_por_user' => true,
    ];
}
