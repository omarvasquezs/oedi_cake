<?php
declare(strict_types=1);

namespace App\Controller;

class DireccionesLineaController extends AppController
{
    /**
     * List Direcciones de Línea with search, filter and pagination.
     *
     * @return void
     */
    public function index(): void
    {
        $this->set('title', 'Direcciones de Línea');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $this->DireccionesLinea->find();

        // Search
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where(['DireccionesLinea.descripcion LIKE' => $like]);
        }

        // Column filter
        $filterDescripcion = trim((string)($params['filter_descripcion'] ?? ''));
        if ($filterDescripcion !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterDescripcion) . '%';
            $query->where(['DireccionesLinea.descripcion LIKE' => $likeFilter]);
        }

        $query->order(['DireccionesLinea.descripcion' => 'ASC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $direcciones = $this->paginate($query);

        $this->set(compact('direcciones', 'search', 'filterDescripcion', 'perPage'));
    }

    /**
     * Create a new Dirección de Línea.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $direccion = $this->DireccionesLinea->newEmptyEntity();
        if ($this->request->is('post')) {
            $direccion = $this->DireccionesLinea->patchEntity($direccion, $this->request->getData());
            if ($this->DireccionesLinea->save($direccion)) {
                $this->Flash->success(__('La dirección de línea ha sido guardada.'));
            } else {
                $this->Flash->error(__('La dirección de línea no pudo ser guardada. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit a Dirección de Línea.
     *
     * @param int $id DireccionLinea ID
     * @return \Cake\Http\Response|null|void
     */
    public function edit(?int $id = null)
    {
        $direccion = $this->DireccionesLinea->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $direccion = $this->DireccionesLinea->patchEntity($direccion, $this->request->getData());
            if ($this->DireccionesLinea->save($direccion)) {
                $this->Flash->success(__('La dirección de línea ha sido actualizada.'));
            } else {
                $this->Flash->error(__('La dirección de línea no pudo ser actualizada. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete a Dirección de Línea.
     *
     * @param int $id DireccionLinea ID
     * @return \Cake\Http\Response|null|void
     */
    public function delete(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $direccion = $this->DireccionesLinea->get($id);
        if ($this->DireccionesLinea->delete($direccion)) {
            $this->Flash->success(__('La dirección de línea ha sido eliminada.'));
        } else {
            $this->Flash->error(__('La dirección de línea no pudo ser eliminada. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
