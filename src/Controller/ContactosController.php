<?php

declare(strict_types=1);

namespace App\Controller;

class ContactosController extends AppController
{
    /**
     * List contacts with search, filters and pagination.
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Contactos');

        $queryParams = $this->request->getQueryParams();

        // Items per page handling (allowed values)
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($queryParams['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        // Base query with association
        $query = $this->Contactos->find()
            ->contain(['Municipalidades']);

        // Global search across key columns (and associated municipalidad nombre)
        $search = trim((string)($queryParams['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where([
                'OR' => [
                    'Contactos.nombre_completo LIKE' => $like,
                    'Contactos.cargo LIKE' => $like,
                    'Contactos.telefono LIKE' => $like,
                    'Contactos.email LIKE' => $like,
                    'Municipalidades.nombre LIKE' => $like,
                ],
            ]);
        }

        // Column filters
        $filterNombre = trim((string)($queryParams['filter_nombre'] ?? ''));
        if ($filterNombre !== '') {
            $likeNombre = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterNombre) . '%';
            $query->where(['Contactos.nombre_completo LIKE' => $likeNombre]);
        }

        $filterCargo = trim((string)($queryParams['filter_cargo'] ?? ''));
        if ($filterCargo !== '') {
            $likeCargo = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterCargo) . '%';
            $query->where(['Contactos.cargo LIKE' => $likeCargo]);
        }

        $filterTelefono = trim((string)($queryParams['filter_telefono'] ?? ''));
        if ($filterTelefono !== '') {
            $likeTelefono = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterTelefono) . '%';
            $query->where(['Contactos.telefono LIKE' => $likeTelefono]);
        }

        $filterEmail = trim((string)($queryParams['filter_email'] ?? ''));
        if ($filterEmail !== '') {
            $likeEmail = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterEmail) . '%';
            $query->where(['Contactos.email LIKE' => $likeEmail]);
        }

        $filterMunicipalidad = trim((string)($queryParams['filter_municipalidad'] ?? ''));
        if ($filterMunicipalidad !== '') {
            $likeMunicipalidad = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterMunicipalidad) . '%';
            $query->where(['Municipalidades.nombre LIKE' => $likeMunicipalidad]);
        }

        // Default ordering
        $query->order(['Contactos.nombre_completo' => 'ASC']);

        // Pagination settings (do not pass 'contain' here; it's already on the SelectQuery)
        $this->paginate = [
            'limit' => $perPage,
        ];
        $contactos = $this->paginate($query);

        // Lists for forms
        $municipalidades = $this->Contactos->Municipalidades->find('list')->all();

        $this->set(compact(
            'contactos',
            'municipalidades',
            'search',
            'filterNombre',
            'filterCargo',
            'filterTelefono',
            'filterEmail',
            'filterMunicipalidad',
            'perPage',
        ));
    }

    /**
     * Create a new contacto.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $contacto = $this->Contactos->newEmptyEntity();
        if ($this->request->is('post')) {
            $contacto = $this->Contactos->patchEntity($contacto, $this->request->getData());
            if ($this->Contactos->save($contacto)) {
                // AJAX request: return JSON with the new contact info
                if ($this->request->is('ajax')) {
                    $payload = [
                        'success' => true,
                        'contacto' => [
                            'id' => $contacto->id_contacto,
                            'label' => (string)$contacto->nombre_completo,
                        ],
                    ];

                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode($payload));
                }

                $this->Flash->success(__('El contacto ha sido guardado.'));
            } else {
                if ($this->request->is('ajax')) {
                    $payload = [
                        'success' => false,
                        'errors' => $contacto->getErrors(),
                    ];

                    return $this->response
                        ->withType('application/json')
                        ->withStringBody(json_encode($payload));
                }

                $this->Flash->error(__('El contacto no pudo ser guardado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit an existing contacto.
     *
     * @param int $id Contacto ID
     * @return \Cake\Http\Response|null|void
     */
    public function edit(?int $id = null)
    {
        $contacto = $this->Contactos->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $contacto = $this->Contactos->patchEntity($contacto, $this->request->getData());
            if ($this->Contactos->save($contacto)) {
                $this->Flash->success(__('El contacto ha sido guardado.'));
            } else {
                $this->Flash->error(__('El contacto no pudo ser guardado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete a contacto.
     *
     * @param int $id Contacto ID
     * @return \Cake\Http\Response|null|void
     */
    public function delete(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $contacto = $this->Contactos->get($id);
        if ($this->Contactos->delete($contacto)) {
            $this->Flash->success(__('El contacto ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El contacto no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Return contactos for a given municipalidad as JSON for async selects.
     *
     * @param int|null $idMunicipalidad Municipalidad ID
     * @return \Cake\Http\Response|null
     */
    public function listByMunicipalidad(?int $idMunicipalidad = null)
    {
        $this->request->allowMethod(['get']);
        if ($idMunicipalidad === null) {
            return $this->response->withType('application/json')
                ->withStringBody(json_encode(['success' => false, 'contactos' => []]));
        }

        $items = $this->Contactos->find()
            ->where(['id_municipalidad' => $idMunicipalidad])
            ->order(['nombre_completo' => 'ASC'])
            ->all()
            ->map(function ($c) {
                return [
                    'id' => $c->id_contacto,
                    'label' => (string)$c->nombre_completo,
                ];
            })
            ->toList();

        return $this->response->withType('application/json')
            ->withStringBody(json_encode(['success' => true, 'contactos' => $items]));
    }
}
