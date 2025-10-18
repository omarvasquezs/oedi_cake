<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Seguimiento Controller
 */
class SeguimientoController extends AppController
{
    /**
     * List tracking states with search, filters and pagination.
     *
     * @return void
     */
    public function estado()
    {
        $this->set('title', 'Estados de Seguimiento');

        /** @var \App\Model\Table\EstadosSeguimientoTable $EstadosSeguimiento */
        $EstadosSeguimiento = $this->fetchTable('EstadosSeguimiento');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $EstadosSeguimiento->find()
            ->contain([
                'Eventos' => ['Municipalidades'],
                'Contactos',
                'TiposReunion',
                'Estados',
            ]);

        // Global search
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where([
                'OR' => [
                    'Eventos.id_evento LIKE' => $like,
                    'Estados.descripcion LIKE' => $like,
                    'Contactos.nombre_completo LIKE' => $like,
                    'EstadosSeguimiento.descripcion LIKE' => $like,
                    'EstadosSeguimiento.compromiso LIKE' => $like,
                ],
            ]);
        }

        // Column filters
        $filterEvento = trim((string)($params['filter_evento'] ?? ''));
        if ($filterEvento !== '') {
            $query->matching('Eventos.Municipalidades', function ($q) use ($filterEvento) {
                $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterEvento) . '%';
                return $q->where(['Municipalidades.nombre LIKE' => $likeFilter]);
            });
        }

        $filterDepartamento = trim((string)($params['filter_departamento'] ?? ''));
        if ($filterDepartamento !== '') {
            $query->matching('Eventos.Municipalidades', function ($q) use ($filterDepartamento) {
                $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterDepartamento) . '%';
                return $q->where(['Municipalidades.departamento LIKE' => $likeFilter]);
            });
        }

        $filterFecha = trim((string)($params['filter_fecha'] ?? ''));
        if ($filterFecha !== '') {
            $query->where(['EstadosSeguimiento.fecha' => $filterFecha]);
        }

        $filterEstado = trim((string)($params['filter_estado'] ?? ''));
        if ($filterEstado !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterEstado) . '%';
            $query->where(['Estados.descripcion LIKE' => $likeFilter]);
        }

        $filterFechaCompromiso = trim((string)($params['filter_fecha_compromiso'] ?? ''));
        if ($filterFechaCompromiso !== '') {
            $query->where(['EstadosSeguimiento.fecha_compromiso' => $filterFechaCompromiso]);
        }

        // Order
        $query->orderBy(['EstadosSeguimiento.fecha' => 'DESC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $estadosSeguimiento = $this->paginate($query, ['scope' => 'EstadosSeguimiento']);

        $this->set(compact(
            'estadosSeguimiento',
            'search',
            'filterEvento',
            'filterDepartamento',
            'filterFecha',
            'filterEstado',
            'filterFechaCompromiso',
            'perPage'
        ));
    }

    /**
     * Add a new tracking state.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function addEstado()
    {
        /** @var \App\Model\Table\EstadosSeguimientoTable $EstadosSeguimiento */
        $EstadosSeguimiento = $this->fetchTable('EstadosSeguimiento');
        $estadoSeguimiento = $EstadosSeguimiento->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Set user tracking
            $userId = $this->Authentication->getIdentity()->getIdentifier();
            $data['creado_por'] = $userId;
            $data['actualizado_por'] = $userId;

            $estadoSeguimiento = $EstadosSeguimiento->patchEntity($estadoSeguimiento, $data);
            if ($EstadosSeguimiento->save($estadoSeguimiento)) {
                $this->Flash->success(__('El estado de seguimiento ha sido guardado.'));
            } else {
                $this->Flash->error(__('El estado de seguimiento no pudo ser guardado. Por favor, intente de nuevo.'));
                $this->set('openAddModal', true);
            }
        }

        return $this->redirect(['action' => 'estado']);
    }

    /**
     * Edit a tracking state.
     *
     * @param int $id Estado Seguimiento ID
     * @return \Cake\Http\Response|null|void
     */
    public function editEstado(?int $id = null)
    {
        /** @var \App\Model\Table\EstadosSeguimientoTable $EstadosSeguimiento */
        $EstadosSeguimiento = $this->fetchTable('EstadosSeguimiento');
        $estadoSeguimiento = $EstadosSeguimiento->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Set user tracking
            $userId = $this->Authentication->getIdentity()->getIdentifier();
            $data['actualizado_por'] = $userId;

            $estadoSeguimiento = $EstadosSeguimiento->patchEntity($estadoSeguimiento, $data);
            if ($EstadosSeguimiento->save($estadoSeguimiento)) {
                $this->Flash->success(__('El estado de seguimiento ha sido actualizado.'));
            } else {
                $this->Flash->error(__('El estado de seguimiento no pudo ser actualizado. Por favor, intente de nuevo.'));
                $this->set('openEditModal', true);
            }
        }

        return $this->redirect(['action' => 'estado']);
    }

    /**
     * Delete a tracking state.
     *
     * @param int $id Estado Seguimiento ID
     * @return \Cake\Http\Response|null|void
     */
    public function deleteEstado(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        /** @var \App\Model\Table\EstadosSeguimientoTable $EstadosSeguimiento */
        $EstadosSeguimiento = $this->fetchTable('EstadosSeguimiento');
        $estadoSeguimiento = $EstadosSeguimiento->get($id);

        if ($EstadosSeguimiento->delete($estadoSeguimiento)) {
            $this->Flash->success(__('El estado de seguimiento ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El estado de seguimiento no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'estado']);
    }

    /**
     * Get dropdown data for forms (AJAX)
     *
     * @return \Cake\Http\Response|null
     */
    public function getDropdownData()
    {
        $this->request->allowMethod(['get']);
        $this->viewBuilder()->setClassName('Json');

        /** @var \App\Model\Table\EventosTable $Eventos */
        $Eventos = $this->fetchTable('Eventos');
        /** @var \App\Model\Table\ContactosTable $Contactos */
        $Contactos = $this->fetchTable('Contactos');
        /** @var \App\Model\Table\TiposReunionTable $TiposReunion */
        $TiposReunion = $this->fetchTable('TiposReunion');
        /** @var \App\Model\Table\EstadosTable $Estados */
        $Estados = $this->fetchTable('Estados');

        $eventos = $Eventos->find('list', [
            'keyField' => 'id_evento',
            'valueField' => function ($evento) {
                return $evento->tipo_acercamiento . ' - ' . $evento->fecha->format('Y-m-d');
            },
        ])->contain(['Municipalidades'])->toArray();

        $contactos = $Contactos->find('list', [
            'keyField' => 'id_contacto',
            'valueField' => 'nombre_completo',
        ])->orderBy(['nombre_completo' => 'ASC'])->toArray();

        $tiposReunion = $TiposReunion->find('list', [
            'keyField' => 'id_tipo_reunion',
            'valueField' => 'descripcion',
        ])->orderBy(['descripcion' => 'ASC'])->toArray();

        $estados = $Estados->find('list', [
            'keyField' => 'id_estado',
            'valueField' => 'descripcion',
        ])->orderBy(['descripcion' => 'ASC'])->toArray();

        $this->set([
            'eventos' => $eventos,
            'contactos' => $contactos,
            'tiposReunion' => $tiposReunion,
            'estados' => $estados,
        ]);
        $this->viewBuilder()->setOption('serialize', ['eventos', 'contactos', 'tiposReunion', 'estados']);
    }
}
