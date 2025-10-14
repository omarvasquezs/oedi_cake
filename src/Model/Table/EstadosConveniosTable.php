<?php

declare(strict_types=1);

namespace App\Model\Table;

use ArrayObject;
use Cake\Datasource\EntityInterface;
use Cake\Event\EventInterface;
use Cake\ORM\Table;
use Cake\Validation\Validator;

class EstadosConveniosTable extends Table
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

        $this->setTable('estados_convenios');
        $this->setDisplayField('descripcion');
        $this->setPrimaryKey('id_estado_convenio');

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
            ->notEmptyString('descripcion', 'La descripción es obligatoria.')
            ->maxLength('descripcion', 100);

        // nombre will be auto-set from descripcion; still validate max length
        $validator->allowEmptyString('nombre')
            ->maxLength('nombre', 100);

        return $validator;
    }

    /**
     * Mirror descripcion into nombre before saving.
     *
     * @param \Cake\Event\EventInterface $event Event
     * @param \Cake\Datasource\EntityInterface $entity Entity
     * @param \ArrayObject $options Options
     * @return void
     */
    public function beforeSave(EventInterface $event, EntityInterface $entity, ArrayObject $options): void
    {
        $desc = (string)($entity->get('descripcion') ?? '');
        if ($desc !== '') {
            $entity->set('nombre', $desc);
        }
    }
}
