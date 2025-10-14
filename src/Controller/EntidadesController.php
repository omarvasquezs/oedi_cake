<?php
declare(strict_types=1);

namespace App\Controller;

class EntidadesController extends AppController
{
    /**
     * List municipalidades with search, column filters and pagination.
     *
     * @return void
     */
    public function index()
    {
        $this->set('title', 'Entidades');

        // Load municipalidades and paginate
        $municipalidadesTable = $this->fetchTable('Municipalidades');
        $query = $municipalidadesTable->find()->orderBy(['nombre' => 'ASC']);

        // Handle search
        $search = $this->request->getQuery('search');
        if ($search) {
            $query->where([
                'OR' => [
                    'nombre LIKE' => '%' . $search . '%',
                    'departamento LIKE' => '%' . $search . '%',
                    'provincia LIKE' => '%' . $search . '%',
                    'distrito LIKE' => '%' . $search . '%',
                    'ubigeo LIKE' => '%' . $search . '%',
                ],
            ]);
        }

        // Handle column filters
        $filterNombre = $this->request->getQuery('filter_nombre');
        if ($filterNombre) {
            $query->where(['nombre LIKE' => '%' . $filterNombre . '%']);
        }

        $filterDepartamento = $this->request->getQuery('filter_departamento');
        if ($filterDepartamento) {
            $query->where(['departamento LIKE' => '%' . $filterDepartamento . '%']);
        }

        $filterProvincia = $this->request->getQuery('filter_provincia');
        if ($filterProvincia) {
            $query->where(['provincia LIKE' => '%' . $filterProvincia . '%']);
        }

        $filterDistrito = $this->request->getQuery('filter_distrito');
        if ($filterDistrito) {
            $query->where(['distrito LIKE' => '%' . $filterDistrito . '%']);
        }

        $filterNivel = $this->request->getQuery('filter_nivel');
        if ($filterNivel) {
            $query->where(['nivel LIKE' => '%' . $filterNivel . '%']);
        }

        $perPage = $this->request->getQuery('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 40, 50, 100]) ? $perPage : 10;

        $this->paginate = [
            'limit' => $perPage,
        ];

        $municipalidades = $this->paginate($query);

        $this->set(compact(
            'municipalidades',
            'perPage',
            'search',
            'filterNombre',
            'filterDepartamento',
            'filterProvincia',
            'filterDistrito',
            'filterNivel',
        ));
    }

    /**
     * Create a new municipalidad from POSTed form data.
     *
     * Re-renders index and reopens the modal on validation errors.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function addMunicipalidad()
    {
        $this->request->allowMethod(['post']);

        $municipalidadesTable = $this->fetchTable('Municipalidades');

        $data = $this->request->getData();

        $entity = $municipalidadesTable->newEmptyEntity();
        $entity = $municipalidadesTable->patchEntity($entity, [
            'ubigeo' => $data['ubigeo'] ?? null,
            'nombre' => $data['nombre'] ?? null,
            'departamento' => $data['departamento'] ?? null,
            'provincia' => $data['provincia'] ?? null,
            'distrito' => $data['distrito'] ?? null,
            'region' => $data['region'] ?? null,
            'nivel' => $data['nivel'] ?? null,
            'region_natural' => $data['region_natural'] ?? null,
            'X' => $data['X'] ?? null,
            'Y' => $data['Y'] ?? null,
            'RUC' => $data['RUC'] ?? null,
        ]);

        if ($municipalidadesTable->save($entity)) {
            $this->Flash->success('Municipalidad creada correctamente.');

            return $this->redirect(['action' => 'index']);
        } else {
            // On failure, re-render index with the entity to show validation errors inside the modal
            $this->Flash->error('No se pudo crear la municipalidad. Revisa los datos.');

            // Prepare data for index view
            $this->set('newMunicipalidad', $entity);

            // Load municipalidades list as in index
            $query = $municipalidadesTable->find()->orderBy(['nombre' => 'ASC']);
            $perPage = $this->request->getQuery('per_page', 10);
            $perPage = in_array($perPage, [10, 20, 40, 50, 100]) ? $perPage : 10;
            $this->paginate = ['limit' => $perPage];
            $municipalidades = $this->paginate($query);
            $this->set(compact('municipalidades', 'perPage'));

            // inform the view to reopen the modal
            $this->set('openNuevaEntidadModal', true);
            $this->render('index');

            return null;
        }
    }

    /**
     * Edit an existing municipalidad from POSTed form data.
     *
     * Re-renders index and reopens the edit modal on validation errors.
     *
     * @return \Cake\Http\Response|null|void
     */
    public function editMunicipalidad()
    {
        $this->request->allowMethod(['post']);

        $municipalidadesTable = $this->fetchTable('Municipalidades');
        $data = $this->request->getData();
        $id = $data['id_municipalidad'] ?? null;

        if (!$id) {
            $this->Flash->error('ID de municipalidad no especificado.');

            return $this->redirect(['action' => 'index']);
        }

        $entity = $municipalidadesTable->get($id);
        $entity = $municipalidadesTable->patchEntity($entity, [
            'ubigeo' => $data['ubigeo'] ?? null,
            'nombre' => $data['nombre'] ?? null,
            'departamento' => $data['departamento'] ?? null,
            'provincia' => $data['provincia'] ?? null,
            'distrito' => $data['distrito'] ?? null,
            'region' => $data['region'] ?? null,
            'nivel' => $data['nivel'] ?? null,
            'region_natural' => $data['region_natural'] ?? null,
            'X' => $data['X'] ?? null,
            'Y' => $data['Y'] ?? null,
            'RUC' => $data['RUC'] ?? null,
        ]);

        if ($municipalidadesTable->save($entity)) {
            $this->Flash->success('Municipalidad actualizada correctamente.');

            return $this->redirect(['action' => 'index']);
        }

        // on failure re-render index with edit entity and reopen edit modal
        $this->Flash->error('No se pudo actualizar la municipalidad. Revisa los datos.');
        $this->set('editMunicipalidad', $entity);

        $query = $municipalidadesTable->find()->orderBy(['nombre' => 'ASC']);
        $perPage = $this->request->getQuery('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 40, 50, 100]) ? $perPage : 10;
        $this->paginate = ['limit' => $perPage];
        $municipalidades = $this->paginate($query);
        $this->set(compact('municipalidades', 'perPage'));

        $this->set('openEditarEntidadModal', true);
        $this->render('index');

        return null;
    }

    /**
     * Delete a municipalidad.
     *
     * @param int|null $id Municipalidad ID
     * @return \Cake\Http\Response|null
     */
    public function deleteMunicipalidad(?int $id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        if (!$id) {
            $this->Flash->error('ID no especificado.');

            return $this->redirect(['action' => 'index']);
        }

        $municipalidadesTable = $this->fetchTable('Municipalidades');
        $entity = $municipalidadesTable->get($id);

        if ($municipalidadesTable->delete($entity)) {
            $this->Flash->success('Municipalidad eliminada.');
        } else {
            $this->Flash->error('No se pudo eliminar la municipalidad.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
