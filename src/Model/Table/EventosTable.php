<?php

declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EventosTable extends Table
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

        $this->setTable('eventos');
        $this->setDisplayField('tipo_acercamiento');
        $this->setPrimaryKey('id_evento');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ],
            ],
        ]);

        $this->belongsTo('Municipalidades', [
            'foreignKey' => 'id_municipalidad',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Contactos', [
            'foreignKey' => 'id_contacto',
            'joinType' => 'INNER',
        ]);
    }

    /**
     * Default validation rules for eventos.
     *
     * @param \Cake\Validation\Validator $validator Validator instance
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id_municipalidad')
            ->requirePresence('id_municipalidad', 'create')
            ->notEmptyString('id_municipalidad');

        $validator
            ->integer('id_contacto')
            ->requirePresence('id_contacto', 'create')
            ->notEmptyString('id_contacto');

        $validator
            ->scalar('tipo_acercamiento')
            ->requirePresence('tipo_acercamiento', 'create')
            ->notEmptyString('tipo_acercamiento');

        $validator
            ->scalar('lugar')
            ->requirePresence('lugar', 'create')
            ->notEmptyString('lugar');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDate('fecha');

        $validator
            ->scalar('modalidad')
            ->maxLength('modalidad', 40)
            ->requirePresence('modalidad', 'create')
            ->notEmptyString('modalidad');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

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
        $rules->add($rules->existsIn('id_municipalidad', 'Municipalidades'), ['errorField' => 'id_municipalidad']);
        $rules->add($rules->existsIn('id_contacto', 'Contactos'), ['errorField' => 'id_contacto']);

        return $rules;
    }

    /**
     * Automatically set audit fields.
     *
     * @param \Cake\Event\EventInterface $event Event
     * @param \Cake\Datasource\EntityInterface $entity Entity
     * @param \ArrayObject $options Options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        // Expect current user id to be passed via options['userId'] from controller
        $userId = (int)($options['userId'] ?? 0);
        if ($entity->isNew()) {
            if ($userId > 0) {
                $entity->set('creado_por', $userId);
            }
        }
        if ($userId > 0) {
            $entity->set('actualizado_por', $userId);
        }
    }
}
