<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class MunicipalidadesTable extends Table
{
    /**
     * Initialize table configuration and behaviors.
     *
     * @param array<string,mixed> $config Configuration options passed to the table
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('municipalidades');
        $this->setDisplayField('nombre');
        $this->setPrimaryKey('id_municipalidad');

        // Use created_at / updated_at columns
        $this->addBehavior('Timestamp', [
            'created' => 'created_at',
            'modified' => 'updated_at',
        ]);
    }

    /**
     * Default validation rules for municipalidades.
     *
     * @param \Cake\Validation\Validator $validator Validator instance
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->scalar('ubigeo')
            ->maxLength('ubigeo', 10)
            ->requirePresence('ubigeo', 'create')
            ->notEmptyString('ubigeo', 'El ubigeo es requerido')
            ->add('ubigeo', 'numericOnly', [
                'rule' => ['custom', '/^\d+$/'],
                'message' => 'El ubigeo debe contener solo números',
            ]);

        $validator
            ->scalar('nombre')
            ->requirePresence('nombre', 'create')
            ->notEmptyString('nombre', 'El nombre es requerido');

        $validator
            ->scalar('departamento')
            ->maxLength('departamento', 80)
            ->requirePresence('departamento', 'create')
            ->notEmptyString('departamento', 'El departamento es requerido');

        $validator
            ->scalar('provincia')
            ->maxLength('provincia', 80)
            ->requirePresence('provincia', 'create')
            ->notEmptyString('provincia', 'La provincia es requerida');

        $validator
            ->scalar('distrito')
            ->maxLength('distrito', 80)
            ->requirePresence('distrito', 'create')
            ->notEmptyString('distrito', 'El distrito es requerido');

        $validator
            ->scalar('region')
            ->maxLength('region', 50)
            ->requirePresence('region', 'create')
            ->notEmptyString('region', 'La región es requerida');

        $validator
            ->numeric('X')
            ->allowEmptyString('X');

        $validator
            ->numeric('Y')
            ->allowEmptyString('Y');

        $validator
            ->scalar('RUC')
            ->maxLength('RUC', 11)
            ->allowEmptyString('RUC')
            ->add('RUC', 'numericOnly', [
                'rule' => ['custom', '/^\d+$/'],
                'message' => 'El RUC debe contener solo números',
            ]);

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
        $rules->add($rules->isUnique(['ubigeo'], 'El ubigeo ya existe'));

        return $rules;
    }
}
