<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class TiposReunionTable extends Table
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

        $this->setTable('tipos_reunion');
        $this->setDisplayField('descripcion');
        $this->setPrimaryKey('id_tipo_reunion');

        // Map created_at/updated_at columns
        $this->addBehavior('Timestamp', [
            'events' => [
                'Model.beforeSave' => [
                    'created_at' => 'new',
                    'updated_at' => 'always',
                ],
            ],
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
            ->scalar('descripcion')
            ->requirePresence('descripcion', 'create')
            ->notEmptyString('descripcion', 'La descripción es obligatoria.');

        return $validator;
    }
}
