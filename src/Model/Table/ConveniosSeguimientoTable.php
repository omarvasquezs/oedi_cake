<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ConveniosSeguimientoTable extends Table
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

        $this->setTable('convenios_seguimiento');
        $this->setDisplayField('id_convenio_seguimiento');
        $this->setPrimaryKey('id_convenio_seguimiento');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ],
            ],
        ]);

        // Associations
        $this->belongsTo('Convenios', [
            'foreignKey' => 'id_convenio',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('EstadosConvenios', [
            'foreignKey' => 'id_estado_convenio',
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
            ->integer('id_convenio')
            ->requirePresence('id_convenio', 'create')
            ->notEmptyString('id_convenio');

        $validator
            ->date('fecha')
            ->requirePresence('fecha', 'create')
            ->notEmptyDate('fecha');

        $validator
            ->integer('id_estado_convenio')
            ->requirePresence('id_estado_convenio', 'create')
            ->notEmptyString('id_estado_convenio');

        $validator
            ->scalar('comentarios')
            ->allowEmptyString('comentarios');

        $validator
            ->scalar('acciones_realizadas')
            ->allowEmptyString('acciones_realizadas');

        $validator
            ->scalar('alertas_identificadas')
            ->allowEmptyString('alertas_identificadas');

        $validator
            ->scalar('acciones_desarrollar')
            ->allowEmptyString('acciones_desarrollar');

        $validator
            ->date('fecha_seguimiento')
            ->allowEmptyDate('fecha_seguimiento');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['id_convenio'], 'Convenios'), ['errorField' => 'id_convenio']);
        $rules->add($rules->existsIn(['id_estado_convenio'], 'EstadosConvenios'), ['errorField' => 'id_estado_convenio']);

        return $rules;
    }
}
