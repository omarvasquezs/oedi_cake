<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class UsersTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('users');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->addBehavior('Timestamp');
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('id')
            ->allowEmptyString('id', null, 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 255)
            ->requirePresence('name', 'create')
            ->notEmptyString('name', 'El nombre es requerido.');

        $validator
            ->scalar('username')
            ->maxLength('username', 50)
            ->requirePresence('username', 'create')
            ->notEmptyString('username', 'El nombre de usuario es requerido.')
            ->add('username', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Este nombre de usuario ya está en uso.',
            ])
            ->add('username', 'noSpaces', [
                'rule' => function ($value, $context) {
                    return !preg_match('/\s/', $value);
                },
                'message' => 'El nombre de usuario no puede contener espacios.',
            ]);

        $validator
            ->email('email', false, 'El correo electrónico debe ser válido.')
            ->requirePresence('email', 'create')
            ->notEmptyString('email', 'El correo electrónico es requerido.')
            ->add('email', 'unique', [
                'rule' => 'validateUnique',
                'provider' => 'table',
                'message' => 'Este correo electrónico ya está registrado.',
            ]);

        $validator
            ->scalar('password')
            ->maxLength('password', 255)
            ->requirePresence('password', 'create')
            ->notEmptyString('password', 'La contraseña es requerida.')
            ->minLength('password', 6, 'La contraseña debe tener al menos 6 caracteres.');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->isUnique(['username'], 'Este nombre de usuario ya está en uso.'));
        $rules->add($rules->isUnique(['email'], 'Este correo electrónico ya está registrado.'));

        return $rules;
    }
}
