<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EstadosSeguimientoTable extends Table
{
    /**
     * Initialize table configuration, behaviors and associations.
     *
     * @param array<string,mixed> $config Configuration options passed to the table
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('estados_seguimiento');
        $this->setDisplayField('id_estado');
        $this->setPrimaryKey('id_estado');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ],
            ],
        ]);

        // Associations
        $this->belongsTo('Eventos', [
            'foreignKey' => 'id_evento',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Contactos', [
            'foreignKey' => 'id_contacto',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('TiposReunion', [
            'foreignKey' => 'id_tipo_reunion',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Estados', [
            'foreignKey' => 'id_estado_ref',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('CreadoPor', [
            'className' => 'Users',
            'foreignKey' => 'creado_por',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('ActualizadoPor', [
            'className' => 'Users',
            'foreignKey' => 'actualizado_por',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id_evento')
            ->requirePresence('id_evento', 'create')
            ->notEmptyString('id_evento');

        $validator
            ->integer('id_contacto')
            ->requirePresence('id_contacto', 'create')
            ->notEmptyString('id_contacto');

        $validator
            ->integer('id_tipo_reunion')
            ->requirePresence('id_tipo_reunion', 'create')
            ->notEmptyString('id_tipo_reunion');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDate('fecha');

        $validator
            ->integer('id_estado_ref')
            ->requirePresence('id_estado_ref', 'create')
            ->notEmptyString('id_estado_ref');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('compromiso')
            ->allowEmptyString('compromiso');

        $validator
            ->date('fecha_compromiso')
            ->allowEmptyDate('fecha_compromiso');

        $validator
            ->boolean('compromiso_concluido')
            ->allowEmptyString('compromiso_concluido');

        $validator
            ->integer('creado_por')
            ->requirePresence('creado_por', 'create')
            ->notEmptyString('creado_por');

        $validator
            ->integer('actualizado_por')
            ->requirePresence('actualizado_por', 'create')
            ->notEmptyString('actualizado_por');

        return $validator;
    }

    /**
     * Build application integrity rules.
     *
     * @param \Cake\ORM\RulesChecker $rules Rules checker instance
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('id_evento', 'Eventos'), ['errorField' => 'id_evento']);
        $rules->add($rules->existsIn('id_contacto', 'Contactos'), ['errorField' => 'id_contacto']);
        $rules->add($rules->existsIn('id_tipo_reunion', 'TiposReunion'), ['errorField' => 'id_tipo_reunion']);
        $rules->add($rules->existsIn('id_estado_ref', 'Estados'), ['errorField' => 'id_estado_ref']);
        $rules->add($rules->existsIn('creado_por', 'CreadoPor'), ['errorField' => 'creado_por']);
        $rules->add($rules->existsIn('actualizado_por', 'ActualizadoPor'), ['errorField' => 'actualizado_por']);

        return $rules;
    }
}
