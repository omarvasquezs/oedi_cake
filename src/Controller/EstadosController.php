<?php
declare(strict_types=1);

namespace App\Controller;

class EstadosController extends AppController
{
    public function index()
    {
        $this->set('title', 'Estados');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $this->Estados->find();

        // Search
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where(['Estados.descripcion LIKE' => $like]);
        }

        // Column filter
        $filterDescripcion = trim((string)($params['filter_descripcion'] ?? ''));
        if ($filterDescripcion !== '') {
            $query->where(['Estados.descripcion LIKE' => '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterDescripcion) . '%']);
        }

        $query->order(['Estados.descripcion' => 'ASC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $estados = $this->paginate($query);

        $this->set(compact('estados', 'search', 'filterDescripcion', 'perPage'));
    }

    public function add()
    {
        $estado = $this->Estados->newEmptyEntity();
        if ($this->request->is('post')) {
            $estado = $this->Estados->patchEntity($estado, $this->request->getData());
            if ($this->Estados->save($estado)) {
                $this->Flash->success(__('El estado ha sido guardado.'));
            } else {
                $this->Flash->error(__('El estado no pudo ser guardado. Por favor, intente de nuevo.'));
                $this->set('openAddModal', true);
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null)
    {
        $estado = $this->Estados->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estado = $this->Estados->patchEntity($estado, $this->request->getData());
            if ($this->Estados->save($estado)) {
                $this->Flash->success(__('El estado ha sido actualizado.'));
            } else {
                $this->Flash->error(__('El estado no pudo ser actualizado. Por favor, intente de nuevo.'));
                $this->set('openEditModal', true);
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estado = $this->Estados->get($id);
        if ($this->Estados->delete($estado)) {
            $this->Flash->success(__('El estado ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El estado no pudo ser eliminado. Por favor, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
