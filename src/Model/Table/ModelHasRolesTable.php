<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class ModelHasRolesTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('model_has_roles');
        $this->setPrimaryKey(['role_id', 'model_id', 'model_type']);

        $this->belongsTo('Roles', [
            'foreignKey' => 'role_id',
            'joinType' => 'INNER',
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('role_id')
            ->requirePresence('role_id', 'create')
            ->notEmptyString('role_id');

        $validator
            ->scalar('model_type')
            ->maxLength('model_type', 255)
            ->requirePresence('model_type', 'create')
            ->notEmptyString('model_type');

        $validator
            ->integer('model_id')
            ->requirePresence('model_id', 'create')
            ->notEmptyString('model_id');

        return $validator;
    }
}
