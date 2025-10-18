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
            $userId = $this->getCurrentUserId();
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
            $userId = $this->getCurrentUserId();
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

        // Eventos con información adicional para Select2
        $eventosData = $Eventos->find()
            ->contain(['Municipalidades'])
            ->orderBy(['Eventos.fecha' => 'DESC'])
            ->all();

        $eventos = [];
        foreach ($eventosData as $evento) {
            $eventos[] = [
                'id' => $evento->id_evento,
                'text' => $evento->tipo_acercamiento,
                'fecha' => $evento->fecha->format('d/m/Y'),
            ];
        }

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

    /**
     * Get contactos by evento (AJAX)
     * Returns all contacts from the municipalidad associated with the evento
     *
     * @return \Cake\Http\Response
     */
    public function contactsByEvento()
    {
        $this->request->allowMethod(['get']);
        $idEvento = (int)$this->request->getQuery('id_evento');
        $q = trim((string)$this->request->getQuery('q'));

        if ($idEvento <= 0) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'data' => []]));
        }

        /** @var \App\Model\Table\EventosTable $Eventos */
        $Eventos = $this->fetchTable('Eventos');
        $evento = $Eventos->get($idEvento, ['contain' => []]);

        if (!$evento || !$evento->id_municipalidad) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'data' => []]));
        }

        /** @var \App\Model\Table\ContactosTable $Contactos */
        $Contactos = $this->fetchTable('Contactos');

        // Get all contacts from the same municipalidad as the evento
        $query = $Contactos->find()
            ->select(['id_contacto', 'nombre_completo', 'cargo'])
            ->where(['id_municipalidad' => $evento->id_municipalidad])
            ->orderBy(['nombre_completo' => 'ASC']);

        if ($q !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
            $query->where([
                'OR' => [
                    'nombre_completo LIKE' => $like,
                    'cargo LIKE' => $like,
                ],
            ]);
        }

        $data = [];
        foreach ($query->all() as $c) {
            $sub = $c->cargo ? sprintf(' [%s]', (string)$c->cargo) : '';
            $data[] = [
                'id' => (int)$c->id_contacto,
                'text' => (string)$c->nombre_completo . $sub,
            ];
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['success' => true, 'data' => $data]));
    }

    /**
     * Get current user id from Authentication identity or session fallback.
     *
     * @return int
     */
    protected function getCurrentUserId(): int
    {
        $identity = $this->getRequest()->getAttribute('identity');
        if ($identity) {
            $id = (int)$identity->getIdentifier();
            if ($id > 0) {
                return $id;
            }
        }

        $sessionUser = $this->getRequest()->getSession()->read('Auth.User');
        if (is_array($sessionUser)) {
            return (int)($sessionUser['id'] ?? 0);
        }
        if (is_object($sessionUser)) {
            return (int)($sessionUser->id ?? 0);
        }

        return 0;
    }
}
