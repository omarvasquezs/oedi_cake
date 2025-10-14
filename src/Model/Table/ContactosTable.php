<?php

declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class ContactosTable extends Table
{
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

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn('id_municipalidad', 'Municipalidades'), ['errorField' => 'id_municipalidad']);

        return $rules;
    }
}
