<?php

declare(strict_types=1);

namespace App\Controller;

use App\Model\Table\EstadosConveniosTable;

class EstadosConvenioController extends AppController
{
    /**
     * @var \App\Model\Table\EstadosConveniosTable
     */
    protected EstadosConveniosTable $EstadosConvenios;

    /**
     * Initialize controller.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->EstadosConvenios = $this->fetchTable('EstadosConvenios');
    }

    /**
     * List Estados de Convenio with search, filter and pagination.
     *
     * @return void
     */
    public function index(): void
    {
        $this->set('title', 'Estados de Convenio');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $this->EstadosConvenios->find();

        // Search
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where(['EstadosConvenios.descripcion LIKE' => $like]);
        }

        // Column filter
        $filterDescripcion = trim((string)($params['filter_descripcion'] ?? ''));
        if ($filterDescripcion !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterDescripcion) . '%';
            $query->where(['EstadosConvenios.descripcion LIKE' => $likeFilter]);
        }

        $query->orderBy(['EstadosConvenios.descripcion' => 'ASC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $estados = $this->paginate($query);

        $this->set(compact('estados', 'search', 'filterDescripcion', 'perPage'));
    }

    /**
     * Create a new Estado de Convenio.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        $estado = $this->EstadosConvenios->newEmptyEntity();
        if ($this->request->is('post')) {
            $estado = $this->EstadosConvenios->patchEntity($estado, $this->request->getData());
            if ($this->EstadosConvenios->save($estado)) {
                $this->Flash->success(__('El estado de convenio ha sido guardado.'));
            } else {
                $this->Flash->error(__('El estado de convenio no pudo ser guardado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit an Estado de Convenio.
     *
     * @param int|null $id EstadoConvenio ID
     * @return \Cake\Http\Response|null|void
     */
    public function edit(?int $id = null)
    {
        $estado = $this->EstadosConvenios->get($id);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $estado = $this->EstadosConvenios->patchEntity($estado, $this->request->getData());
            if ($this->EstadosConvenios->save($estado)) {
                $this->Flash->success(__('El estado de convenio ha sido actualizado.'));
            } else {
                $this->Flash->error(__('El estado de convenio no pudo ser actualizado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete an Estado de Convenio.
     *
     * @param int|null $id EstadoConvenio ID
     * @return \Cake\Http\Response|null|void
     */
    public function delete(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $estado = $this->EstadosConvenios->get($id);
        if ($this->EstadosConvenios->delete($estado)) {
            $this->Flash->success(__('El estado de convenio ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El estado de convenio no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
