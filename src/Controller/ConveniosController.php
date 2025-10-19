<?php

declare(strict_types=1);

namespace App\Controller;

/**
 * Convenios Controller
 */
class ConveniosController extends AppController
{
    /**
     * List convenios with search, filters and pagination.
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Convenios');

        /** @var \App\Model\Table\ConveniosTable $Convenios */
        $Convenios = $this->fetchTable('Convenios');

        $params = $this->request->getQueryParams();
        $allowedPerPage = [10, 20, 40, 50, 100];
        $perPage = (int)($params['per_page'] ?? 20);
        if (!in_array($perPage, $allowedPerPage, true)) {
            $perPage = 20;
        }

        $query = $Convenios->find()
            ->contain([
                'Municipalidades',
                'EstadosConvenios',
                'Sectores',
                'DireccionesLinea',
            ]);

        // Global search
        $search = trim((string)($params['search'] ?? ''));
        if ($search !== '') {
            $like = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $search) . '%';
            $query->where([
                'OR' => [
                    'Convenios.tipo_convenio LIKE' => $like,
                    'Convenios.codigo_interno LIKE' => $like,
                    'Convenios.codigo_convenio LIKE' => $like,
                    'Convenios.descripcion LIKE' => $like,
                    'Municipalidades.nombre LIKE' => $like,
                    'Sectores.descripcion LIKE' => $like,
                    'EstadosConvenios.descripcion LIKE' => $like,
                ],
            ]);
        }

        // Column filters
        $filterTipoConvenio = trim((string)($params['filter_tipo_convenio'] ?? ''));
        if ($filterTipoConvenio !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterTipoConvenio) . '%';
            $query->where(['Convenios.tipo_convenio LIKE' => $likeFilter]);
        }

        $filterMunicipalidad = trim((string)($params['filter_municipalidad'] ?? ''));
        if ($filterMunicipalidad !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterMunicipalidad) . '%';
            $query->where(['Municipalidades.nombre LIKE' => $likeFilter]);
        }

        $filterSector = trim((string)($params['filter_sector'] ?? ''));
        if ($filterSector !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterSector) . '%';
            $query->where(['Sectores.descripcion LIKE' => $likeFilter]);
        }

        $filterFechaFirma = trim((string)($params['filter_fecha_firma'] ?? ''));
        if ($filterFechaFirma !== '') {
            $query->where(['Convenios.fecha_firma' => $filterFechaFirma]);
        }

        $filterEstado = trim((string)($params['filter_estado'] ?? ''));
        if ($filterEstado !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterEstado) . '%';
            $query->where(['EstadosConvenios.descripcion LIKE' => $likeFilter]);
        }

        $filterCodigoInterno = trim((string)($params['filter_codigo_interno'] ?? ''));
        if ($filterCodigoInterno !== '') {
            $likeFilter = '%' . str_replace(['%', '_'], ['\\%', '\\_'], $filterCodigoInterno) . '%';
            $query->where(['Convenios.codigo_interno LIKE' => $likeFilter]);
        }

        // Order
        $query->orderBy(['Convenios.fecha_firma' => 'DESC']);

        $this->paginate = [
            'limit' => $perPage,
        ];
        $convenios = $this->paginate($query);

        $this->set(compact(
            'convenios',
            'search',
            'filterTipoConvenio',
            'filterMunicipalidad',
            'filterSector',
            'filterFechaFirma',
            'filterEstado',
            'filterCodigoInterno',
            'perPage'
        ));
    }

    /**
     * Add a new convenio.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function add()
    {
        /** @var \App\Model\Table\ConveniosTable $Convenios */
        $Convenios = $this->fetchTable('Convenios');
        $convenio = $Convenios->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Set user tracking
            $userId = $this->getCurrentUserId();
            $data['creado_por'] = $userId;
            $data['actualizado_por'] = $userId;

            $convenio = $Convenios->patchEntity($convenio, $data);
            if ($Convenios->save($convenio)) {
                $this->Flash->success(__('El convenio ha sido guardado.'));
            } else {
                $this->Flash->error(__('El convenio no pudo ser guardado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Edit a convenio.
     *
     * @param int $id Convenio ID
     * @return \Cake\Http\Response|null|void
     */
    public function edit(?int $id = null)
    {
        /** @var \App\Model\Table\ConveniosTable $Convenios */
        $Convenios = $this->fetchTable('Convenios');
        $convenio = $Convenios->get($id);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $data = $this->request->getData();

            // Set user tracking
            $userId = $this->getCurrentUserId();
            $data['actualizado_por'] = $userId;

            $convenio = $Convenios->patchEntity($convenio, $data);
            if ($Convenios->save($convenio)) {
                $this->Flash->success(__('El convenio ha sido actualizado.'));
            } else {
                $this->Flash->error(__('El convenio no pudo ser actualizado. Por favor, intente de nuevo.'));
            }
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Delete a convenio.
     *
     * @param int $id Convenio ID
     * @return \Cake\Http\Response|null|void
     */
    public function delete(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        /** @var \App\Model\Table\ConveniosTable $Convenios */
        $Convenios = $this->fetchTable('Convenios');
        $convenio = $Convenios->get($id);

        if ($Convenios->delete($convenio)) {
            $this->Flash->success(__('El convenio ha sido eliminado.'));
        } else {
            $this->Flash->error(__('El convenio no pudo ser eliminado. Por favor, intente de nuevo.'));
        }

        return $this->redirect(['action' => 'index']);
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

        /** @var \App\Model\Table\MunicipalidadesTable $Municipalidades */
        $Municipalidades = $this->fetchTable('Municipalidades');
        /** @var \App\Model\Table\EstadosConveniosTable $EstadosConvenios */
        $EstadosConvenios = $this->fetchTable('EstadosConvenios');
        /** @var \App\Model\Table\SectoresTable $Sectores */
        $Sectores = $this->fetchTable('Sectores');
        /** @var \App\Model\Table\DireccionesLineaTable $DireccionesLinea */
        $DireccionesLinea = $this->fetchTable('DireccionesLinea');

        // Format municipalidades for Select2 with custom template
        $municipalidadesData = $Municipalidades->find()
            ->select(['id_municipalidad', 'nombre', 'ubigeo', 'departamento'])
            ->orderBy(['nombre' => 'ASC'])
            ->all()
            ->map(function ($row) {
                return [
                    'id' => $row->id_municipalidad,
                    'text' => $row->nombre,
                    'nombre' => $row->nombre,
                    'ubigeo' => $row->ubigeo,
                    'departamento' => $row->departamento,
                ];
            })
            ->toArray();

        $estadosConvenio = $EstadosConvenios->find('list', [
            'keyField' => 'id_estado_convenio',
            'valueField' => 'descripcion',
        ])->orderBy(['descripcion' => 'ASC'])->toArray();

        $sectores = $Sectores->find('list', [
            'keyField' => 'id_sector',
            'valueField' => 'descripcion',
        ])->orderBy(['descripcion' => 'ASC'])->toArray();

        $direccionesLinea = $DireccionesLinea->find('list', [
            'keyField' => 'id_direccion_linea',
            'valueField' => 'descripcion',
        ])->orderBy(['descripcion' => 'ASC'])->toArray();

        $this->set([
            'municipalidades' => $municipalidadesData,
            'estadosConvenio' => $estadosConvenio,
            'sectores' => $sectores,
            'direccionesLinea' => $direccionesLinea,
        ]);
        $this->viewBuilder()->setOption('serialize', ['municipalidades', 'estadosConvenio', 'sectores', 'direccionesLinea']);
    }

    /**
     * Seguimiento page
     *
     * @return void
     */
    public function seguimiento()
    {
        $this->set('title', 'Seguimiento de Convenios');
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
