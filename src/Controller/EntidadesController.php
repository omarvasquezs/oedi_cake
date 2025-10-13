<?php

declare(strict_types=1);

namespace App\Controller;

class EntidadesController extends AppController
{
    public function index()
    {
        $this->set('title', 'Entidades');

        // Load municipalidades and paginate
        $municipalidadesTable = $this->fetchTable('Municipalidades');
        $query = $municipalidadesTable->find()->orderBy(['nombre' => 'ASC']);

        $perPage = $this->request->getQuery('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 40, 50, 100]) ? $perPage : 10;

        $this->paginate = [
            'limit' => $perPage
        ];

        $municipalidades = $this->paginate($query);

        $this->set(compact('municipalidades', 'perPage'));
    }

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

    public function deleteMunicipalidad($id = null)
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
