<?php

declare(strict_types=1);

namespace App\Controller;

class SectoresController extends AppController
{
    /**
     * List sectors with search, filter and pagination.
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Sectores');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $this->Sectores->find();

        // Search
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where(['Sectores.descripcion LIKE' => $like]);
        }

        // Column filter
        $filterDescripcion = trim((string)($params['filter_descripcion'] ?? ''));
        if ($filterDescripcion !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterDescripcion) . '%';
            $query->where(['Sectores.descripcion LIKE' => $likeFilter]);
        }

        $query->order(['Sectores.descripcion' => 'ASC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $sectores = $this->paginate($query);

        $this->set(compact('sectores', 'search', 'filterDescripcion', 'perPage'));
    }

    /**
     * Create a new sector.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $sector = $this->Sectores->newEmptyEntity();
        if ($this->request->is('post')) {
            $sector = $this->Sectores->patchEntity($sector, $this->request->getData());
            if ($this->Sectores->save($sector)) {
                $this->Flash->success(__('El sector ha sido guardado.'));
            } else {
                $this->Flash->error(__('El sector no pudo ser guardado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit a sector.
     *
     * @param int $id Sector ID
     * @return \Cake\Http\Response|null|void
     */
    public function edit(?int $id = null)
    {
        $sector = $this->Sectores->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $sector = $this->Sectores->patchEntity($sector, $this->request->getData());
            if ($this->Sectores->save($sector)) {
                $this->Flash->success(__('El sector ha sido actualizado.'));
            } else {
                $this->Flash->error(__('El sector no pudo ser actualizado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete a sector.
     *
     * @param int $id Sector ID
     * @return \Cake\Http\Response|null|void
     */
    public function delete(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $sector = $this->Sectores->get($id);
        if ($this->Sectores->delete($sector)) {
            $this->Flash->success(__('El sector ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El sector no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
