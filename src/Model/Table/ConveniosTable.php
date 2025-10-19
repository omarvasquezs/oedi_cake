<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ConveniosTable extends Table
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

        $this->setTable('convenios');
        $this->setDisplayField('codigo_interno');
        $this->setPrimaryKey('id_convenio');

        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ],
            ],
        ]);

        // Associations
        $this->belongsTo('Municipalidades', [
            'foreignKey' => 'id_municipalidad',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('EstadosConvenios', [
            'foreignKey' => 'id_estado_convenio',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('Sectores', [
            'foreignKey' => 'id_sector',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('DireccionesLinea', [
            'foreignKey' => 'id_direccion_linea',
            'joinType' => 'INNER',
        ]);

        $this->belongsTo('CreadoPor', [
            'className' => 'Users',
            'foreignKey' => 'creado_por',
            'propertyName' => 'usuario_creador',
            'joinType' => 'LEFT',
        ]);

        $this->belongsTo('ActualizadoPor', [
            'className' => 'Users',
            'foreignKey' => 'actualizado_por',
            'propertyName' => 'usuario_actualizador',
            'joinType' => 'LEFT',
        ]);

        $this->hasMany('ConveniosSeguimiento', [
            'foreignKey' => 'id_convenio',
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
            ->integer('id_municipalidad')
            ->requirePresence('id_municipalidad', 'create')
            ->notEmptyString('id_municipalidad');

        $validator
            ->scalar('tipo_convenio')
            ->maxLength('tipo_convenio', 100)
            ->requirePresence('tipo_convenio', 'create')
            ->notEmptyString('tipo_convenio');

        $validator
            ->decimal('monto')
            ->requirePresence('monto', 'create')
            ->notEmptyString('monto');

        $validator
            ->date('fecha_firma')
            ->requirePresence('fecha_firma', 'create')
            ->notEmptyDate('fecha_firma');

        $validator
            ->integer('id_estado_convenio')
            ->requirePresence('id_estado_convenio', 'create')
            ->notEmptyString('id_estado_convenio');

        $validator
            ->scalar('descripcion')
            ->allowEmptyString('descripcion');

        $validator
            ->scalar('codigo_convenio')
            ->maxLength('codigo_convenio', 20)
            ->allowEmptyString('codigo_convenio');

        $validator
            ->integer('codigo_idea_cui')
            ->allowEmptyString('codigo_idea_cui');

        $validator
            ->scalar('descripcion_idea_cui')
            ->maxLength('descripcion_idea_cui', 250)
            ->allowEmptyString('descripcion_idea_cui');

        $validator
            ->integer('beneficiarios')
            ->allowEmptyString('beneficiarios');

        $validator
            ->scalar('codigo_interno')
            ->maxLength('codigo_interno', 20)
            ->requirePresence('codigo_interno', 'create')
            ->notEmptyString('codigo_interno');

        $validator
            ->integer('id_sector')
            ->requirePresence('id_sector', 'create')
            ->notEmptyString('id_sector');

        $validator
            ->integer('id_direccion_linea')
            ->requirePresence('id_direccion_linea', 'create')
            ->notEmptyString('id_direccion_linea');

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
        $rules->add($rules->existsIn(['id_municipalidad'], 'Municipalidades'), ['errorField' => 'id_municipalidad']);
        $rules->add($rules->existsIn(['id_estado_convenio'], 'EstadosConvenios'), ['errorField' => 'id_estado_convenio']);
        $rules->add($rules->existsIn(['id_sector'], 'Sectores'), ['errorField' => 'id_sector']);
        $rules->add($rules->existsIn(['id_direccion_linea'], 'DireccionesLinea'), ['errorField' => 'id_direccion_linea']);

        return $rules;
    }
}
