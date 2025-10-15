<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $eventos
 */
$this->assign('title', $title ?? 'Primeros Acercamientos');
?>

<style>
    .primer-index {
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height) - 4rem);
    }

    .primer-index .table-wrapper {
        flex: 1 1 auto;
        overflow-y: auto;
        min-height: 0;
    }

    .pagination-section {
        flex-shrink: 0;
    }

    .input-with-icon {
        position: relative;
    }

    .input-with-icon .input-icon {
        position: absolute;
        left: .75rem;
        top: 50%;
        transform: translateY(-50%);
        color: #666;
        font-size: 14px;
        pointer-events: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .input-with-icon .search-input {
        padding-left: 2.75rem;
        margin-bottom: 0;
    }

    .input-with-icon .input-clear {
        position: absolute;
        right: .5rem;
        top: 50%;
        transform: translateY(-50%);
        width: 28px;
        height: 28px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #999 !important;
        text-decoration: none !important;
        border-radius: 50% !important;
        transition: background-color .15s, color .15s;
        background: transparent !important;
        border: none !important;
        padding: 0 !important;
        line-height: 1 !important;
        box-shadow: none !important;
        z-index: 3;
    }

    .input-with-icon .input-clear:hover {
        background: #f3f4f6;
        color: #666;
    }

    .action-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border: 1px solid #dadce0;
        border-radius: 50%;
        background: #fff;
        text-decoration: none !important;
        transition: background-color .2s ease;
        padding: 0;
        margin: 0;
    }

    .action-icon:hover {
        background: #f8f9fa;
    }

    .icon-edit {
        color: #4285F4;
    }

    .icon-delete {
        color: #DB4437;
    }

    #addEventoModal .modal-content .form-control,
    #addEventoModal .modal-content .btn,
    #editEventoModal .modal-content .form-control,
    #editEventoModal .modal-content .btn {
        font-size: 16px;
    }

    .mini-search {
        font-size: 14px;
        margin-bottom: .25rem;
    }

    /* Softer inner spacing in modals */
    #addEventoModal .modal-body,
    #editEventoModal .modal-body,
    #addContactoModal .modal-body {
        padding: 1.25rem 1.25rem 0.75rem 1.25rem;
    }

    /* Ensure select controls in modals use 16px font size for accessibility */
    #addEventoModal .modal-content .form-select,
    #editEventoModal .modal-content .form-select,
    #addContactoModal .modal-content .form-select {
        font-size: 16px;
    }

    /* Ensure all form controls and buttons in Nuevo Contacto modal use 16px font size */
    #addContactoModal .modal-content .form-control,
    #addContactoModal .modal-content .btn {
        font-size: 16px;
    }

    /* Modal stacking - cuando se abre el modal de contacto sobre el modal de evento */
    #addContactoModal {
        z-index: 1060;
    }

    #addContactoModal .modal-backdrop {
        z-index: 1055;
    }

    /* Cuando el modal de contacto está abierto, oscurecer el modal padre */
    #addEventoModal.modal-dimmed,
    #editEventoModal.modal-dimmed {
        filter: brightness(0.7);
    }

    /* Asegurar que el backdrop del modal de contacto sea más oscuro */
    .modal-backdrop.show {
        opacity: 0.5;
    }

    /* Segundo backdrop para el modal anidado */
    .modal-backdrop.modal-backdrop-nested {
        opacity: 0.7 !important;
        z-index: 1055 !important;
    }

    /* Confirmation dialog styles */
    .confirmation-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 1070;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .confirmation-dialog {
        background: white;
        border-radius: 8px;
        padding: 1.5rem;
        max-width: 500px;
        width: 90%;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
    }

    .confirmation-dialog h5 {
        margin: 0 0 1rem 0;
        font-size: 18px;
        font-weight: 600;
        color: #2c3e50;
    }

    .confirmation-dialog p {
        margin: 0 0 1.5rem 0;
        color: #666;
        font-size: 14px;
        line-height: 1.5;
    }

    .confirmation-dialog .button-group {
        display: flex;
        gap: 0.75rem;
        justify-content: flex-end;
    }

    .confirmation-dialog .btn {
        padding: 0.5rem 1.5rem;
        border-radius: 4px;
        font-size: 14px;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
    }

    .confirmation-dialog .btn-cancel {
        background: #6c757d;
        color: white;
    }

    .confirmation-dialog .btn-cancel:hover {
        background: #5a6268;
    }

    .confirmation-dialog .btn-continue {
        background: #007bff;
        color: white;
    }

    .confirmation-dialog .btn-continue:hover {
        background: #0056b3;
    }
</style>

<div class="primer-index">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <h2 style="margin:0;color:#2c3e50;font-size:24px;font-weight:500;">Primeros Acercamientos</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addEventoModal" style="background:#3498db;color:white;border:none;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <i class="fa-solid fa-plus"></i> Nuevo Primer Acercamiento
        </button>
    </div>

    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;">
        <div style="flex:1;" id="mainSearchContainer" <?= !empty($filterMunicipalidad) || !empty($filterModalidad) || !empty($filterFecha) ? 'hidden' : '' ?>>
            <form method="get" action="<?= $this->Url->build(['controller' => 'PrimerAcercamiento', 'action' => 'index']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar por municipalidad, tipo, lugar o descripción..." class="search-input form-control" style="border:1px solid #ddd;border-radius:4px;font-size:14px;background:white;color:#2c3e50;">
                <input type="hidden" name="per_page" value="<?= $perPage ?>">
                <?php if (!empty($search)) : ?>
                    <a href="<?= $this->Url->build(['controller' => 'PrimerAcercamiento', 'action' => 'index', '?' => ['per_page' => $perPage]]) ?>" class="input-clear" title="Limpiar búsqueda"><i class="fa-solid fa-times"></i></a>
                <?php endif; ?>
            </form>
        </div>
        <button id="toggleFilters" style="background:white;color:#666;border:1px solid #ddd;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <?= !empty($filterMunicipalidad) || !empty($filterModalidad) || !empty($filterFecha) ? '<i class="fa-solid fa-times"></i> CERRAR FILTROS' : '<i class="fa-solid fa-filter"></i> Filtros' ?>
        </button>
    </div>

    <div class="table-wrapper" style="background:white;border-radius:8px;border:1px solid #e0e0e0;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8f9fa;border-bottom:2px solid #e0e0e0;">
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">Municipalidad</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">Tipo</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">Lugar</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">Modalidad</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">Fecha</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">Acciones</th>
                </tr>
                <tr id="filterRow" style="background:white;border-bottom:2px solid #e0e0e0; display: <?= !empty($filterMunicipalidad) || !empty($filterModalidad) || !empty($filterFecha) ? '' : 'none' ?>;">
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterMunicipalidad" value="<?= h($filterMunicipalidad ?? '') ?>" placeholder="Filtrar municipalidad..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <input type="text" id="filterModalidad" value="<?= h($filterModalidad ?? '') ?>" placeholder="Filtrar modalidad..." class="form-control" style="font-size:13px;border:1px solid #ddd;border-radius:4px;">
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <input type="date" id="filterFecha" value="<?= h($filterFecha ?? '') ?>" class="form-control" style="font-size:13px;border:1px solid #ddd;border-radius:4px;">
                    </th>
                    <th colspan="3"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($eventos) && count($eventos) > 0) : ?>
                    <?php foreach ($eventos as $ev) : ?>
                        <tr style="border-bottom:1px solid #f0f0f0;">
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;">
                                <?= h($ev->municipalidad->nombre ?? '') ?>
                            </td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($ev->tipo_acercamiento) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($ev->lugar) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($ev->modalidad ?? '') ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($ev->fecha?->format('Y-m-d')) ?></td>
                            <td style="padding:1rem;vertical-align:middle;">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <button type="button" class="action-icon" title="Editar" onclick='openEditModal(<?= json_encode($ev) ?>)'><i class="fa-solid fa-pen-to-square icon-edit"></i></button>
                                    <?= $this->Form->postLink('<i class="fa-solid fa-trash icon-delete"></i>', ['action' => 'delete', $ev->id_evento], ['confirm' => '¿Está seguro de eliminar este evento?', 'class' => 'action-icon', 'escape' => false, 'title' => 'Eliminar']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="6" style="padding:3rem;text-align:center;color:#95a5a6;font-size:14px;">No hay primeros acercamientos disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-section" style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;margin-top:1.5rem;padding:0 0.5rem;">
        <div style="display:flex;align-items:center;gap:0.5rem;">
            <span style="color:#666;font-size:14px;line-height:1;">Mostrar:</span>
            <select id="perPageSelect" onchange="changePerPage(this.value)" style="padding:0.5rem 2rem 0.5rem 0.75rem;border:1px solid #ddd;border-radius:4px;font-size:14px;cursor:pointer;background:white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 16 16%27%3e%3cpath fill=%27none%27 stroke=%27%23343a40%27 stroke-linecap=%27round%27 stroke-linejoin%27round%27 stroke-width%272%27 d%27m2 5 6 6 6-6%27/%3e%3c/svg%3e') no-repeat right 0.5rem center/12px 12px;height:36px;line-height:1;margin-bottom:0;appearance:none;-webkit-appearance:none;-moz-appearance:none;width:auto;">
                <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                <option value="20" <?= $perPage == 20 ? 'selected' : '' ?>>20</option>
                <option value="40" <?= $perPage == 40 ? 'selected' : '' ?>>40</option>
                <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
            </select>
            <span style="color:#666;font-size:14px;line-height:1;">registros</span>
        </div>
        <nav style="display:flex;gap:0.25rem;justify-content:center;">
            <?php if ($this->Paginator->hasPrev()) : ?>
                <a href="<?= $this->Paginator->generateUrl(['page' => 1, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angles-left"></i></a>
                <a href="<?= $this->Paginator->generateUrl(['page' => $this->Paginator->counter('{{page}}') - 1, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angle-left"></i></a>
            <?php endif; ?>
            <?php $currentPage = $this->Paginator->counter('{{page}}');
            $pageCount = $this->Paginator->counter('{{pages}}');
            $start = max(1, $currentPage - 2);
            $end = min($pageCount, $start + 4);
            $start = max(1, $end - 4);
            for ($i = $start; $i <= $end; $i++) :
                $isActive = $i == $currentPage; ?>
                <a href="<?= $this->Paginator->generateUrl(['page' => $i, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid <?= $isActive ? '#3498db' : '#ddd' ?>;background:<?= $isActive ? '#3498db' : 'white' ?>;color:<?= $isActive ? 'white' : '#666' ?>;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;font-weight:<?= $isActive ? '600' : 'normal' ?>;transition:all 0.2s;" <?= !$isActive ? "onmouseover=\"this.style.background='#f5f5f5'\" onmouseout=\"this.style.background='white'\"" : '' ?>><?= $i ?></a>
            <?php endfor; ?>
            <?php if ($this->Paginator->hasNext()) : ?>
                <a href="<?= $this->Paginator->generateUrl(['page' => $this->Paginator->counter('{{page}}') + 1, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angle-right"></i></a>
                <a href="<?= $this->Paginator->generateUrl(['page' => $pageCount, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angles-right"></i></a>
            <?php endif; ?>
        </nav>
        <div style="color:#666;font-size:14px;text-align:right;"><?php $start = (($this->Paginator->counter('{{page}}') - 1) * $perPage) + 1;
                                                                    $end = min($this->Paginator->counter('{{page}}') * $perPage, $this->Paginator->counter('{{count}}'));
                                                                    $total = $this->Paginator->counter('{{count}}'); ?>Mostrando <?= $start ?> a <?= $end ?> de <?= $total ?> registros</div>
    </div>
</div>

<div class="modal fade" id="addEventoModal" tabindex="-1" aria-labelledby="addEventoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['controller' => 'PrimerAcercamiento', 'action' => 'add']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addEventoLabel">Nuevo Primer Acercamiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <?php
                $municipalidadesMap = [];
                if (!empty($municipalidadesOptions)) {
                    foreach ($municipalidadesOptions as $opt) {
                        $municipalidadesMap[$opt['id']] = $opt['label'];
                    }
                }
                $modalidadesList = $modalidadesOptions ?? [];
                ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_municipalidad', [
                            'type' => 'select',
                            'options' => $municipalidadesMap,
                            'empty' => 'Seleccione una municipalidad',
                            'label' => 'Municipalidad',
                            'class' => 'form-select',
                            'id' => 'add-id_municipalidad',
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contacto <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2">
                            <?= $this->Form->select('id_contacto', [], [
                                'empty' => 'Seleccione un contacto',
                                'class' => 'form-select',
                                'id' => 'add-id_contacto',
                                'required' => true,
                            ]) ?>
                            <button type="button" id="btnAddContacto" class="btn btn-success" style="white-space:nowrap; flex-shrink: 0;">+ Nuevo</button>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('tipo_acercamiento', ['type' => 'text', 'class' => 'form-control', 'label' => 'Tipo de Acercamiento']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('lugar', ['type' => 'text', 'class' => 'form-control', 'label' => 'Lugar']) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha', ['type' => 'date', 'class' => 'form-control', 'label' => 'Fecha']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('modalidad', [
                            'type' => 'select',
                            'options' => $modalidadesList,
                            'empty' => 'Seleccione una modalidad',
                            'class' => 'form-select',
                            'label' => 'Modalidad',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('descripcion', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Descripción']) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="editEventoModal" tabindex="-1" aria-labelledby="editEventoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'editEventoForm', 'url' => ['controller' => 'PrimerAcercamiento', 'action' => 'edit']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editEventoLabel">Editar Primer Acercamiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <?= $this->Form->hidden('id_evento', ['id' => 'edit-id']) ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_municipalidad', [
                            'type' => 'select',
                            'options' => $municipalidadesMap ?? [],
                            'empty' => 'Seleccione una municipalidad',
                            'label' => 'Municipalidad',
                            'class' => 'form-select',
                            'id' => 'edit-id_municipalidad',
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Contacto <span class="text-danger">*</span></label>
                        <div class="d-flex gap-2">
                            <?= $this->Form->select('id_contacto', [], [
                                'empty' => 'Seleccione un contacto',
                                'class' => 'form-select',
                                'id' => 'edit-id_contacto',
                                'required' => true,
                            ]) ?>
                            <button type="button" id="btnEditAddContacto" class="btn btn-success" style="white-space:nowrap; flex-shrink: 0;">+ Nuevo</button>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('tipo_acercamiento', ['type' => 'text', 'id' => 'edit-tipo_acercamiento', 'class' => 'form-control', 'label' => 'Tipo de Acercamiento']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('lugar', ['type' => 'text', 'id' => 'edit-lugar', 'class' => 'form-control', 'label' => 'Lugar']) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha', ['type' => 'date', 'id' => 'edit-fecha', 'class' => 'form-control', 'label' => 'Fecha']) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('modalidad', [
                            'type' => 'select',
                            'options' => $modalidadesList,
                            'empty' => 'Seleccione una modalidad',
                            'id' => 'edit-modalidad',
                            'class' => 'form-select',
                            'label' => 'Modalidad',
                        ]) ?>
                    </div>
                </div>
                <?= $this->Form->control('descripcion', ['type' => 'textarea', 'id' => 'edit-descripcion', 'class' => 'form-control mt-1', 'label' => 'Descripción']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Guardar Cambios'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="addContactoModal" tabindex="-1" aria-labelledby="addContactoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'addContactoForm']) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addContactoLabel">Nuevo Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <?= $this->Form->control('nombre_completo', ['type' => 'text', 'class' => 'form-control', 'label' => 'Nombre Completo', 'required' => true]) ?>
                <?= $this->Form->control('cargo', ['type' => 'text', 'class' => 'form-control', 'label' => 'Cargo', 'required' => true]) ?>
                <?= $this->Form->control('telefono', ['type' => 'text', 'class' => 'form-control', 'label' => 'Teléfono']) ?>
                <?= $this->Form->control('email', ['type' => 'email', 'class' => 'form-control', 'label' => 'Email']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" id="btnSaveContacto" class="btn btn-success">Guardar</button>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(function() {
                    searchForm.submit();
                }, 500);
            });
            searchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    clearTimeout(searchTimeout);
                    searchForm.submit();
                }
            });
        }
    });

    document.addEventListener('DOMContentLoaded', function() {
        const toggleFiltersBtn = document.getElementById('toggleFilters');
        const filterRow = document.getElementById('filterRow');
        const mainSearchContainer = document.getElementById('mainSearchContainer');
        const filterMunicipalidad = document.getElementById('filterMunicipalidad');
        const filterModalidad = document.getElementById('filterModalidad');
        const filterFecha = document.getElementById('filterFecha');
        let filterTimeout;
        toggleFiltersBtn.addEventListener('click', function() {
            const isVisible = filterRow.style.display !== 'none';
            if (isVisible) {
                window.location.href = '<?= $this->Url->build(['action' => 'index', '?' => ['per_page' => $perPage]]) ?>';
            } else {
                filterRow.style.display = '';
                mainSearchContainer.setAttribute('hidden', '');
                toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';
                if (filterMunicipalidad) filterMunicipalidad.focus();
            }
        });

        function applyFilters() {
            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            (filterMunicipalidad.value) ? url.searchParams.set('filter_municipalidad', filterMunicipalidad.value): url.searchParams.delete('filter_municipalidad');
            (filterModalidad.value) ? url.searchParams.set('filter_modalidad', filterModalidad.value): url.searchParams.delete('filter_modalidad');
            (filterFecha.value) ? url.searchParams.set('filter_fecha', filterFecha.value): url.searchParams.delete('filter_fecha');
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }
        [filterMunicipalidad, filterModalidad, filterFecha].forEach(input => {
            if (input) {
                input.addEventListener('input', function() {
                    clearTimeout(filterTimeout);
                    filterTimeout = setTimeout(function() {
                        applyFilters();
                    }, 500);
                });
            }
        });
    });

    function openEditModal(ev) {
        const form = document.getElementById('editEventoForm');
        form.setAttribute('action', "<?= $this->Url->build(['controller' => 'PrimerAcercamiento', 'action' => 'edit']) ?>/" + ev.id_evento);
        document.getElementById('edit-id').value = ev.id_evento;
        document.getElementById('edit-id_municipalidad').value = ev.id_municipalidad;
        document.getElementById('edit-id_contacto').value = ev.id_contacto;
        document.getElementById('edit-tipo_acercamiento').value = ev.tipo_acercamiento || '';
        document.getElementById('edit-lugar').value = ev.lugar || '';
        document.getElementById('edit-fecha').value = ev.fecha ? ev.fecha.substring(0, 10) : '';
        document.getElementById('edit-modalidad').value = ev.modalidad || '';
        document.getElementById('edit-descripcion').value = ev.descripcion || '';
        try {
            new bootstrap.Modal(document.getElementById('editEventoModal')).show();
        } catch (err) {
            console.error(err);
        }
    }

    function changePerPage(perPage) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }

    // Dependent selects and new-contact flow
    document.addEventListener('DOMContentLoaded', function() {
        // Availability of municipalidades options for client-side search
        const MUNICIPALIDADES_OPTIONS = <?= json_encode(array_map(function ($o) {
                                            return ['id' => $o['id'], 'text' => $o['label']];
                                        }, $municipalidadesOptions ?? []), JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_AMP | JSON_HEX_QUOT) ?>;

        const showWarning = (msg, targetElement = null) => {
            // Create a more prominent warning similar to the image
            const el = document.createElement('div');
            el.className = 'alert alert-warning d-flex align-items-center position-fixed top-0 start-50 translate-middle-x mt-3';
            el.style.zIndex = 2000;
            el.style.boxShadow = '0 4px 6px rgba(0,0,0,0.1)';
            el.style.minWidth = '300px';
            el.innerHTML = `
                <i class="fa-solid fa-triangle-exclamation me-2"></i>
                <div>
                    <strong>Advertencia</strong><br>
                    ${msg}
                </div>
                <button type="button" class="btn-close ms-auto" aria-label="Close"></button>
            `;
            document.body.appendChild(el);

            // Add click handler to close button
            el.querySelector('.btn-close').addEventListener('click', () => el.remove());

            // Add visual feedback to the target element
            if (targetElement) {
                targetElement.classList.add('border-warning');
                targetElement.style.borderWidth = '2px';
                setTimeout(() => {
                    targetElement.classList.remove('border-warning');
                    targetElement.style.borderWidth = '';
                }, 3000);
            }

            // Auto-remove after 5 seconds
            setTimeout(() => {
                if (el.parentNode) el.remove();
            }, 5000);
        };

        // Function to show confirmation dialog
        const showConfirmation = (message, municipalidadNombre) => {
            return new Promise((resolve) => {
                const overlay = document.createElement('div');
                overlay.className = 'confirmation-overlay';
                overlay.innerHTML = `
                    <div class="confirmation-dialog">
                        <h5>Confirmación</h5>
                        <p>La municipalidad "${municipalidadNombre}" ya tiene eventos registrados.<br>¿Desea continuar de todos modos?</p>
                        <div class="button-group">
                            <button class="btn btn-cancel" data-action="cancel">Cancelar</button>
                            <button class="btn btn-continue" data-action="continue">Continuar</button>
                        </div>
                    </div>
                `;
                document.body.appendChild(overlay);

                const handleClick = (e) => {
                    const action = e.target.dataset.action;
                    if (action) {
                        overlay.remove();
                        resolve(action === 'continue');
                    }
                };

                overlay.addEventListener('click', (e) => {
                    if (e.target === overlay) {
                        overlay.remove();
                        resolve(false);
                    }
                });

                overlay.querySelectorAll('[data-action]').forEach(btn => {
                    btn.addEventListener('click', handleClick);
                });
            });
        };

        // Function to check if municipalidad has eventos
        async function checkMunicipalidadHasEventos(idMunicipalidad) {
            const url = new URL('<?= $this->Url->build(['controller' => 'PrimerAcercamiento', 'action' => 'checkMunicipalidadEventos']) ?>', window.location.origin);
            url.searchParams.set('id_municipalidad', idMunicipalidad);
            try {
                const res = await fetch(url.toString(), {
                    headers: {
                        'Accept': 'application/json'
                    }
                });
                if (!res.ok) return null;
                const payload = await res.json();
                if (!payload || payload.success !== true) return null;
                return payload;
            } catch (e) {
                console.error('Error checking municipalidad eventos:', e);
                return null;
            }
        }

        async function fetchContactos(idMunicipalidad, q = '') {
            const url = new URL('<?= $this->Url->build(['controller' => 'PrimerAcercamiento', 'action' => 'contactsByMunicipalidad']) ?>', window.location.origin);
            url.searchParams.set('id_municipalidad', idMunicipalidad);
            if (q) url.searchParams.set('q', q);
            const res = await fetch(url.toString(), {
                headers: {
                    'Accept': 'application/json'
                }
            });
            if (!res.ok) throw new Error('Error cargando contactos');
            const payload = await res.json();
            if (!payload || payload.success !== true) return [];
            return payload.data || [];
        }

        function populateSelect(selectEl, items, selectedId = null) {
            selectEl.innerHTML = '';
            const empty = document.createElement('option');
            empty.value = '';
            empty.textContent = 'Seleccione un contacto';
            selectEl.appendChild(empty);
            items.forEach(i => {
                const opt = document.createElement('option');
                opt.value = i.id;
                opt.textContent = i.text;
                if (selectedId && String(selectedId) === String(i.id)) opt.selected = true;
                selectEl.appendChild(opt);
            });
        }

        async function handleMunicipioChange(prefix) {
            const muni = document.getElementById(prefix + '-id_municipalidad');
            const contacto = document.getElementById(prefix + '-id_contacto');
            if (!muni || !contacto) return;
            
            const selectedValue = muni.value;
            
            if (!selectedValue) {
                populateSelect(contacto, []);
                return;
            }

            // Only check for existing eventos when adding (not when editing)
            if (prefix === 'add') {
                const checkResult = await checkMunicipalidadHasEventos(selectedValue);
                if (checkResult && checkResult.hasEventos) {
                    const shouldContinue = await showConfirmation(
                        checkResult.count > 0 ? `${checkResult.count} evento(s)` : 'eventos',
                        checkResult.municipalidadNombre
                    );
                    
                    if (!shouldContinue) {
                        // User cancelled, reset the select
                        muni.value = '';
                        populateSelect(contacto, []);
                        return;
                    }
                }
            }

            // Load contacts
            contacto.innerHTML = '<option value="">Cargando...</option>';
            try {
                const data = await fetchContactos(selectedValue);
                populateSelect(contacto, data);
            } catch (e) {
                populateSelect(contacto, []);
            }
        }

        ['add', 'edit'].forEach(prefix => {
            const muni = document.getElementById(prefix + '-id_municipalidad');
            const contacto = document.getElementById(prefix + '-id_contacto');

            console.log(`Configurando validación para ${prefix}:`, {
                muni,
                contacto
            });

            if (muni) {
                muni.addEventListener('change', () => handleMunicipioChange(prefix));
            }

            if (contacto && muni) {
                // Disable the select until municipalidad is selected
                const checkMunicipality = () => {
                    const hasValue = muni.value && muni.value !== '';
                    console.log(`${prefix} - checkMunicipality:`, {
                        value: muni.value,
                        hasValue
                    });

                    if (!hasValue) {
                        contacto.disabled = true;
                        contacto.style.cursor = 'not-allowed';
                        contacto.style.backgroundColor = '#f5f5f5';
                    } else {
                        contacto.disabled = false;
                        contacto.style.cursor = '';
                        contacto.style.backgroundColor = '';
                    }
                };

                // Initial check
                checkMunicipality();

                // Update when municipalidad changes
                muni.addEventListener('change', checkMunicipality);

                // Show warning when trying to interact with disabled select
                contacto.addEventListener('click', (e) => {
                    console.log(`${prefix} - contacto click:`, {
                        muniValue: muni.value
                    });
                    if (!muni.value || muni.value === '') {
                        e.preventDefault();
                        e.stopPropagation();
                        showWarning('Primero debe seleccionar una municipalidad', muni);
                        return false;
                    }
                });

                contacto.addEventListener('mousedown', (e) => {
                    console.log(`${prefix} - contacto mousedown:`, {
                        muniValue: muni.value
                    });
                    if (!muni.value || muni.value === '') {
                        e.preventDefault();
                        e.stopPropagation();
                        showWarning('Primero debe seleccionar una municipalidad', muni);
                        return false;
                    }
                });

                contacto.addEventListener('focus', (e) => {
                    console.log(`${prefix} - contacto focus:`, {
                        muniValue: muni.value
                    });
                    if (!muni.value || muni.value === '') {
                        showWarning('Primero debe seleccionar una municipalidad', muni);
                        contacto.blur();
                    }
                });
            }
            // mini search for municipalidades
            const muniSearch = document.getElementById(prefix + '-muni-search');
            if (muniSearch && muni) {
                muniSearch.addEventListener('input', () => {
                    const q = muniSearch.value.trim().toLowerCase();
                    const filtered = q ? MUNICIPALIDADES_OPTIONS.filter(o => o.text.toLowerCase().includes(q)) : MUNICIPALIDADES_OPTIONS;
                    // rebuild options
                    const prev = muni.value;
                    muni.innerHTML = '<option value="">Seleccione una municipalidad</option>' + filtered.map(o => `<option value="${o.id}">${o.text}</option>`).join('');
                    // try keep previous selection if still visible
                    if (filtered.some(o => String(o.id) === String(prev))) {
                        muni.value = prev;
                    } else {
                        // reset dependent contactos when muni disappears
                        const cont = document.getElementById(prefix + '-id_contacto');
                        if (cont) cont.innerHTML = '<option value="">Seleccione un contacto</option>';
                    }
                });
            }
            // mini search for contactos (server-side via q)
            const contactoSearch = document.getElementById(prefix + '-contacto-search');
            if (contactoSearch && muni && contacto) {
                let t;
                contactoSearch.addEventListener('input', () => {
                    clearTimeout(t);
                    t = setTimeout(async () => {
                        if (!muni.value) {
                            showWarning('Primero debe seleccionar una municipalidad', muni);
                            return;
                        }
                        try {
                            const list = await fetchContactos(muni.value, contactoSearch.value.trim());
                            populateSelect(contacto, list);
                        } catch (e) {
                            populateSelect(contacto, []);
                        }
                    }, 300);
                });
            }
        });

        // Open new-contact modal
        const newBtns = [{
                btn: document.getElementById('btnAddContacto'),
                prefix: 'add'
            },
            {
                btn: document.getElementById('btnEditAddContacto'),
                prefix: 'edit'
            }
        ];

        console.log('Configurando botones + Nuevo:', newBtns);

        const addContactoModalEl = document.getElementById('addContactoModal');
        const addEventoModalEl = document.getElementById('addEventoModal');
        const editEventoModalEl = document.getElementById('editEventoModal');

        newBtns.forEach(({
            btn,
            prefix
        }) => {
            if (!btn) {
                console.log(`Botón ${prefix} no encontrado`);
                return;
            }

            const muni = document.getElementById(prefix + '-id_municipalidad');

            if (!muni) {
                console.log(`Municipalidad ${prefix} no encontrada`);
                return;
            }

            // Function to update button state
            const updateButtonState = () => {
                const hasValue = muni.value && muni.value !== '';
                console.log(`${prefix} - updateButtonState:`, {
                    value: muni.value,
                    hasValue
                });

                if (!hasValue) {
                    btn.disabled = true;
                    btn.style.cursor = 'not-allowed';
                    btn.style.opacity = '0.6';
                } else {
                    btn.disabled = false;
                    btn.style.cursor = 'pointer';
                    btn.style.opacity = '1';
                }
            };

            // Initial state
            updateButtonState();

            // Update when municipalidad changes
            muni.addEventListener('change', updateButtonState);

            // Handle click
            btn.addEventListener('click', (e) => {
                console.log(`${prefix} - botón click:`, {
                    muniValue: muni.value,
                    disabled: btn.disabled
                });

                if (!muni.value || muni.value === '') {
                    e.preventDefault();
                    e.stopPropagation();
                    showWarning('Primero debe seleccionar una municipalidad', muni);
                    return false;
                }

                // Store which modal is the parent
                const parentModalEl = prefix === 'add' ? addEventoModalEl : editEventoModalEl;

                const modal = new bootstrap.Modal(addContactoModalEl);
                document.getElementById('addContactoForm').dataset.targetPrefix = prefix;

                // Add dimmed class to parent modal when nested modal opens
                addContactoModalEl.addEventListener('shown.bs.modal', function onShown() {
                    if (parentModalEl) {
                        parentModalEl.classList.add('modal-dimmed');
                    }
                    addContactoModalEl.removeEventListener('shown.bs.modal', onShown);
                });

                // Remove dimmed class when nested modal closes
                addContactoModalEl.addEventListener('hidden.bs.modal', function onHidden() {
                    if (parentModalEl) {
                        parentModalEl.classList.remove('modal-dimmed');
                    }
                    addContactoModalEl.removeEventListener('hidden.bs.modal', onHidden);
                });

                modal.show();
            });
        });

        // Save new contacto via AJAX
        const saveBtn = document.getElementById('btnSaveContacto');
        if (saveBtn) {
            saveBtn.addEventListener('click', async () => {
                const form = document.getElementById('addContactoForm');
                const prefix = form.dataset.targetPrefix || 'add';
                const muni = document.getElementById(prefix + '-id_municipalidad');
                const payload = {
                    id_municipalidad: muni.value,
                    nombre_completo: form.querySelector('[name="nombre_completo"]').value,
                    cargo: form.querySelector('[name="cargo"]').value,
                    telefono: form.querySelector('[name="telefono"]').value,
                    email: form.querySelector('[name="email"]').value,
                };
                // Read CSRF token from cookie if present (CakePHP default)
                const csrfCookie = document.cookie.split('; ').find(r => r.startsWith('csrfToken='));
                const csrfToken = csrfCookie ? decodeURIComponent(csrfCookie.split('=')[1]) : '';
                try {
                    const res = await fetch('<?= $this->Url->build(['controller' => 'PrimerAcercamiento', 'action' => 'addContacto']) ?>', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            ...(csrfToken ? {
                                'X-CSRF-Token': csrfToken
                            } : {})
                        },
                        body: JSON.stringify(payload),
                    });
                    const payloadRes = await res.json();
                    if (!res.ok || !payloadRes?.success) throw new Error('Error');
                    const newContact = payloadRes.data;
                    // refresh contactos and select the new one
                    const contactoSelect = document.getElementById(prefix + '-id_contacto');
                    const list = await fetchContactos(muni.value);
                    populateSelect(contactoSelect, list, newContact.id);
                    bootstrap.Modal.getInstance(document.getElementById('addContactoModal')).hide();
                } catch (e) {
                    showWarning('No se pudo crear el contacto');
                }
            });
        }
    });
</script>
<?php $this->end(); ?>