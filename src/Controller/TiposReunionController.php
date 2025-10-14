<?php
declare(strict_types=1);

namespace App\Controller;

class TiposReunionController extends AppController
{
    public function index()
    {
        $this->set('title', 'Tipos de Reunión');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $this->TiposReunion->find();

        // Global search on descripcion
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where(['TiposReunion.descripcion LIKE' => $like]);
        }

        // Column filter: descripcion
        $filterDescripcion = trim((string)($params['filter_descripcion'] ?? ''));
        if ($filterDescripcion !== '') {
            $query->where(['TiposReunion.descripcion LIKE' => '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterDescripcion) . '%']);
        }

        $query->order(['TiposReunion.descripcion' => 'ASC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $tipos = $this->paginate($query);

        $this->set(compact('tipos', 'search', 'filterDescripcion', 'perPage'));
    }

    public function add()
    {
        $tipo = $this->TiposReunion->newEmptyEntity();
        if ($this->request->is('post')) {
            $tipo = $this->TiposReunion->patchEntity($tipo, $this->request->getData());
            if ($this->TiposReunion->save($tipo)) {
                $this->Flash->success(__('El tipo de reunión ha sido guardado.'));
            } else {
                $this->Flash->error(__('El tipo de reunión no pudo ser guardado. Por favor, intente de nuevo.'));
                $this->set('openAddModal', true);
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function edit($id = null)
    {
        $tipo = $this->TiposReunion->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $tipo = $this->TiposReunion->patchEntity($tipo, $this->request->getData());
            if ($this->TiposReunion->save($tipo)) {
                $this->Flash->success(__('El tipo de reunión ha sido actualizado.'));
            } else {
                $this->Flash->error(__('El tipo de reunión no pudo ser actualizado. Por favor, intente de nuevo.'));
                $this->set('openEditModal', true);
            }
        }
        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $tipo = $this->TiposReunion->get($id);
        if ($this->TiposReunion->delete($tipo)) {
            $this->Flash->success(__('El tipo de reunión ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El tipo de reunión no pudo ser eliminado. Por favor, intente de nuevo.'));
        }
        return $this->redirect(['action' => 'index']);
    }
}
