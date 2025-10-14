<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContactosTable extends Table
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

        $this->setTable('contactos');
        $this->setDisplayField('nombre_completo');
        $this->setPrimaryKey('id_contacto');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Municipalidades', [
            'foreignKey' => 'id_municipalidad',
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
            ->integer('id_municipalidad')
            ->notEmptyString('id_municipalidad');

        $validator
            ->scalar('nombre_completo')
            ->requirePresence('nombre_completo', 'create')
            ->notEmptyString('nombre_completo');

        $validator
            ->scalar('cargo')
            ->requirePresence('cargo', 'create')
            ->notEmptyString('cargo');

        $validator
            ->scalar('telefono')
            ->maxLength('telefono', 100)
            ->allowEmptyString('telefono');

        $validator
            ->email('email')
            ->allowEmptyString('email');

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

        return $rules;
    }
}
