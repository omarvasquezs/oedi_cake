<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\EventosTable;
use Cake\Http\Response;

class PrimerAcercamientoController extends AppController
{
    /**
     * @var \App\Model\Table\EventosTable
     */
    protected EventosTable $Eventos;

    /**
     * Controller initialization.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->Eventos = $this->fetchTable('Eventos');
    }

    /**
     * List eventos (primer acercamiento) with search, filters and pagination.
     *
     * @return void
     */
    public function index(): void
    {
        $this->set('title', 'Primeros Acercamientos');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $this->Eventos->find()
            ->contain(['Municipalidades', 'Contactos']);

        // Search across tipo_acercamiento, lugar and descripcion
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where(function ($exp, $q) use ($like) {
                return $exp->or([
                    'Eventos.tipo_acercamiento LIKE' => $like,
                    'Eventos.lugar LIKE' => $like,
                    'Eventos.descripcion LIKE' => $like,
                    'Municipalidades.nombre LIKE' => $like,
                ]);
            });
        }

        // Column filters
        $filterMunicipalidad = trim((string)($params['filter_municipalidad'] ?? ''));
        if ($filterMunicipalidad !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterMunicipalidad) . '%';
            $query->where(['Municipalidades.nombre LIKE' => $likeFilter]);
        }

        $filterModalidad = trim((string)($params['filter_modalidad'] ?? ''));
        if ($filterModalidad !== '') {
            $query->where(['Eventos.modalidad' => $filterModalidad]);
        }

        $filterFecha = trim((string)($params['filter_fecha'] ?? ''));
        if ($filterFecha !== '') {
            $query->where(['Eventos.fecha' => $filterFecha]);
        }

        $query->order(['Eventos.fecha' => 'DESC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $eventos = $this->paginate($query);

        // Options for modal selects
        $muniRows = $this->Eventos->Municipalidades->find()
            ->select(['id_municipalidad', 'nombre', 'ubigeo', 'departamento'])
            ->order(['nombre' => 'ASC'])
            ->all();
        $municipalidadesOptions = [];
        foreach ($muniRows as $m) {
            $label = sprintf('%s [%s, %s]', (string)$m->nombre, (string)$m->ubigeo, (string)$m->departamento);
            $municipalidadesOptions[] = ['id' => (int)$m->id_municipalidad, 'label' => $label];
        }
        $modalidadesOptions = [
            'Presencial' => 'Presencial',
            'Virtual' => 'Virtual',
            'Mixta' => 'Mixta',
        ];

        $this->set(compact(
            'eventos',
            'search',
            'filterMunicipalidad',
            'filterModalidad',
            'filterFecha',
            'perPage',
            'municipalidadesOptions',
            'modalidadesOptions',
        ));
    }

    /**
     * Create evento.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $evento = $this->Eventos->newEmptyEntity();
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $evento = $this->Eventos->patchEntity($evento, $data);

            $userId = $this->getCurrentUserId();
            if ($this->Eventos->save($evento, ['userId' => $userId])) {
                $this->Flash->success(__('El primer acercamiento ha sido guardado.'));
            } else {
                $this->Flash->error(__('El primer acercamiento no pudo ser guardado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit evento.
     *
     * @param int|null $id Evento ID
     * @return \Cake\Http\Response|null|void
     */
    public function edit(?int $id = null)
    {
        $evento = $this->Eventos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $evento = $this->Eventos->patchEntity($evento, $this->request->getData());
            $userId = $this->getCurrentUserId();
            if ($this->Eventos->save($evento, ['userId' => $userId])) {
                $this->Flash->success(__('El primer acercamiento ha sido actualizado.'));
            } else {
                $this->Flash->error(__('El primer acercamiento no pudo ser actualizado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete evento.
     *
     * @param int|null $id Evento ID
     * @return \Cake\Http\Response|null|void
     */
    public function delete(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $evento = $this->Eventos->get($id);
        if ($this->Eventos->delete($evento)) {
            $this->Flash->success(__('El primer acercamiento ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El primer acercamiento no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
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

    /**
     * Provide contactos belonging to a municipalidad, optional search q.
     * Returns { success: true, data: [{id, text}] }.
     */
    public function contactsByMunicipalidad(): Response
    {
        $this->request->allowMethod(['get']);
        $idMunicipalidad = (int)$this->request->getQuery('id_municipalidad');
        $q = trim((string)$this->request->getQuery('q'));
        if ($idMunicipalidad <= 0) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'data' => []]));
        }

        $contactosTable = $this->fetchTable('Contactos');
        $query = $contactosTable->find()
            ->select(['id_contacto', 'nombre_completo', 'cargo'])
            ->where(['id_municipalidad' => $idMunicipalidad])
            ->order(['nombre_completo' => 'ASC']);
        if ($q !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $q) . '%';
            $query->where(function ($exp) use ($like) {
                return $exp->or([
                    'nombre_completo LIKE' => $like,
                    'cargo LIKE' => $like,
                ]);
            });
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
     * Create contacto via AJAX and return it for immediate selection.
     */
    public function addContacto(): Response
    {
        $this->request->allowMethod(['post']);
        $contactosTable = $this->fetchTable('Contactos');
        $payload = $this->request->input('json_decode', true) ?? [];

        $entity = $contactosTable->newEmptyEntity();
        $entity = $contactosTable->patchEntity($entity, $payload);
        if ($contactosTable->save($entity)) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode([
                    'success' => true,
                    'data' => [
                        'id' => (int)$entity->id_contacto,
                        'text' => (string)$entity->nombre_completo,
                    ],
                ]));
        }

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'success' => false,
                'errors' => $entity->getErrors(),
            ]));
    }

    /**
     * Check if a municipalidad has existing eventos.
     */
    public function checkMunicipalidadEventos(): Response
    {
        $this->request->allowMethod(['get']);
        $idMunicipalidad = (int)$this->request->getQuery('id_municipalidad');
        
        if ($idMunicipalidad <= 0) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'hasEventos' => false]));
        }

        $count = $this->Eventos->find()
            ->where(['id_municipalidad' => $idMunicipalidad])
            ->count();

        $municipalidad = $this->Eventos->Municipalidades->get($idMunicipalidad);

        return $this->response->withType('application/json')
            ->withStringBody(json_encode([
                'success' => true,
                'hasEventos' => $count > 0,
                'count' => $count,
                'municipalidadNombre' => (string)$municipalidad->nombre,
            ]));
    }
}
