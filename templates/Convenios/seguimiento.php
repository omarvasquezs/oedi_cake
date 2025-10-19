<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $seguimientos
 */
$this->assign('title', $title ?? 'Seguimiento de Convenios');
$this->Html->css('seguimiento', ['block' => true]);
?>
<style>
    .convenios-seguimiento-index {
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height) - 4rem);
    }

    .convenios-seguimiento-index .table-wrapper {
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
        left: 0.75rem;
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
        right: 0.5rem;
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
        background-color: #f3f4f6;
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

    .icon-view {
        color: #34A853;
    }

    .icon-edit {
        color: #4285F4;
    }

    .icon-delete {
        color: #DB4437;
    }

    /* Custom select caret (match other CRUD pages) */
    .custom-select-wrapper {
        position: relative;
    }

    .custom-select-wrapper select {
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
        background-color: white;
        background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
        background-repeat: no-repeat;
        background-position: right 0.75rem center;
        background-size: 1.25rem;
        padding-right: 2.5rem;
    }

    /* Inline override: force Select2 font-size inside seguimiento modals (highest precedence) */
    #addSeguimientoModal .select2-selection--single,
    #editSeguimientoModal .select2-selection--single,
    #viewSeguimientoModal .select2-selection--single,
    #addSeguimientoModal .select2-selection__rendered,
    #editSeguimientoModal .select2-selection__rendered,
    #viewSeguimientoModal .select2-selection__rendered,
    #addSeguimientoModal .select2-container,
    #editSeguimientoModal .select2-container,
    #viewSeguimientoModal .select2-container {
        font-size: 16px !important;
        line-height: 1.4 !important;
    }

    #addSeguimientoModal .select2-selection--single .select2-selection__rendered,
    #editSeguimientoModal .select2-selection--single .select2-selection__rendered,
    #viewSeguimientoModal .select2-selection--single .select2-selection__rendered {
        font-size: 16px !important;
    }

    /* Custom highlight styles for Select2 dropdown options */
    .select2-container--bootstrap-5 .select2-results__option--highlighted {
        background-color: #3498db !important;
        color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--highlighted .convenio-main {
        color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--highlighted .convenio-sub {
        color: rgba(255, 255, 255, 0.9) !important;
    }

    /* Selected option style - more visible */
    .select2-container--bootstrap-5 .select2-results__option--selected {
        background-color: #2980b9 !important;
        color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--selected .convenio-main {
        color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option--selected .convenio-sub {
        color: rgba(255, 255, 255, 0.85) !important;
    }

    /* Hover effect */
    .select2-container--bootstrap-5 .select2-results__option:hover {
        background-color: #3498db !important;
        color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option:hover .convenio-main {
        color: white !important;
    }

    .select2-container--bootstrap-5 .select2-results__option:hover .convenio-sub {
        color: rgba(255, 255, 255, 0.9) !important;
    }
</style>
<?php
?>

<style>
    .convenios-seguimiento-index {
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height) - 4rem);
    }

    .convenios-seguimiento-index .table-wrapper {
        flex: 1 1 auto;
        overflow-y: auto;
        min-height: 0;
    }

    .pagination-section {
        flex-shrink: 0;
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

    .icon-view {
        color: #34A853;
    }

    .icon-edit {
        color: #4285F4;
    }

    .icon-delete {
        color: #DB4437;
    }
</style>

<div class="convenios-seguimiento-index">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <h2 style="margin:0;color:#2c3e50;font-size:24px;font-weight:500;">Seguimiento de Convenios</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addSeguimientoModal" style="background:#3498db;color:white;border:none;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <i class="fa-solid fa-plus"></i> Nuevo Seguimiento
        </button>
    </div>

    <!-- Search and Filters -->
    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;">
        <div style="flex:1;" id="mainSearchContainer" <?= (!empty($filterConvenio) || !empty($filterFecha) || !empty($filterEstado) || !empty($filterFechaSeguimiento)) ? 'hidden' : '' ?>>
            <form method="get" action="<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'seguimiento']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar seguimientos..." class="search-input form-control" style="border:1px solid #ddd;border-radius:4px;font-size:14px;background:white;color:#2c3e50;">
                <input type="hidden" name="per_page" value="<?= $perPage ?>">
                <?php if (!empty($search)): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'seguimiento', '?' => ['per_page' => $perPage]]) ?>" class="input-clear" title="Limpiar búsqueda"><i class="fa-solid fa-times"></i></a>
                <?php endif; ?>
            </form>
        </div>
        <button id="toggleFilters" style="background:white;color:#666;border:1px solid #ddd;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <?= (!empty($filterConvenio) || !empty($filterFecha) || !empty($filterEstado) || !empty($filterFechaSeguimiento)) ? '<i class="fa-solid fa-times"></i> CERRAR FILTROS' : '<i class="fa-solid fa-filter"></i> Filtros' ?>
        </button>
    </div>

    <div class="table-wrapper" style="background:white;border-radius:8px;border:1px solid #e0e0e0;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8f9fa;border-bottom:2px solid #e0e0e0;">
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">CONVENIO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">FECHA</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ESTADO ACTUAL</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">FECHA SEGUIMIENTO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ACCIONES</th>
                </tr>
                <tr id="filterRow" style="background:white;border-bottom:2px solid #e0e0e0; display: <?= (!empty($filterConvenio) || !empty($filterFecha) || !empty($filterEstado) || !empty($filterFechaSeguimiento)) ? '' : 'none' ?>;">
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterConvenio" value="<?= h($filterConvenio ?? '') ?>" placeholder="Filtrar convenio..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterConvenio)): ?>
                                <button type="button" onclick="clearFilter('filterConvenio')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <input type="date" id="filterFecha" value="<?= h($filterFecha ?? '') ?>" class="form-control" style="padding:0.5rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterEstado" value="<?= h($filterEstado ?? '') ?>" placeholder="Filtrar estado..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterEstado)): ?>
                                <button type="button" onclick="clearFilter('filterEstado')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <input type="date" id="filterFechaSeguimiento" value="<?= h($filterFechaSeguimiento ?? '') ?>" class="form-control" style="padding:0.5rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                    </th>
                    <th style="padding:0.5rem 1rem;"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($seguimientos) && count($seguimientos) > 0): ?>
                    <?php foreach ($seguimientos as $seguimiento): ?>
                        <tr style="border-bottom:1px solid #f0f0f0;">
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;">
                                <div style="font-weight:600;color:#222;margin-bottom:4px;"><?= strtoupper(h($seguimiento->convenio->municipalidade->nombre ?? 'N/A')) ?></div>
                                <small style="color:#666;font-size:12px;">
                                    Interno: <?= h($seguimiento->convenio->codigo_interno ?? '-') ?> -
                                    CUI: <?= h($seguimiento->convenio->codigo_idea_cui ?? '-') ?> -
                                    Ubigeo: <?= h($seguimiento->convenio->municipalidade->ubigeo ?? '-') ?>
                                </small>
                            </td>
                            <td style="padding:1rem;font-size:14px;color:#555;"><?= h($seguimiento->fecha->format('d/m/Y')) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#555;"><?= h($seguimiento->estados_convenio->descripcion ?? 'N/A') ?></td>
                            <td style="padding:1rem;font-size:14px;color:#555;"><?= $seguimiento->fecha_seguimiento ? h($seguimiento->fecha_seguimiento->format('d/m/Y')) : 'N/A' ?></td>
                            <td style="padding:1rem;vertical-align:middle;">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <button type="button" class="action-icon" title="Ver" onclick='openViewModal(<?= json_encode($seguimiento) ?>)'><i class="fa-solid fa-eye icon-view"></i></button>
                                    <button type="button" class="action-icon" title="Editar" onclick='openEditModal(<?= json_encode($seguimiento) ?>)'><i class="fa-solid fa-pen-to-square icon-edit"></i></button>
                                    <?= $this->Form->postLink('<i class="fa-solid fa-trash icon-delete"></i>', ['action' => 'deleteSeguimiento', $seguimiento->id_convenio_seguimiento], ['confirm' => "¿Está seguro de eliminar este seguimiento?", 'class' => 'action-icon', 'escape' => false, 'title' => 'Eliminar']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="padding:3rem;text-align:center;color:#95a5a6;font-size:14px;">
                            <?= empty($search) && empty($filterConvenio) && empty($filterFecha) && empty($filterEstado) && empty($filterFechaSeguimiento) ? 'No hay seguimientos disponibles' : 'No se encontraron resultados' ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination Controls -->
    <div class="pagination-section" style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;margin-top:1.5rem;padding:0 0.5rem;">
        <!-- Per Page Selector (always visible) -->
        <div style="display:flex;align-items:center;gap:0.5rem;">
            <span style="color:#666;font-size:14px;line-height:1;">Mostrar</span>
            <div class="custom-select-wrapper">
                <select onchange="changePerPage(this.value)" style="padding:0.4rem 2.5rem 0.4rem 0.75rem;border:1px solid #ddd;border-radius:4px;font-size:14px;cursor:pointer;margin-bottom:0;">
                    <?php foreach ([10, 20, 40, 50, 100] as $option): ?>
                        <option value="<?= $option ?>" <?= $perPage == $option ? 'selected' : '' ?>><?= $option ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <span style="color:#666;font-size:14px;">registros</span>
        </div>

        <!-- Pagination Buttons (only when multiple pages exist) -->
        <?php if (!empty($seguimientos) && $this->Paginator->counter('{{pages}}') > 1): ?>
            <nav style="display:flex;gap:0.25rem;justify-content:center;">
                <?php if ($this->Paginator->hasPrev()): ?>
                    <a href="<?= $this->Paginator->generateUrl(['page' => 1, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angles-left"></i></a>
                    <a href="<?= $this->Paginator->generateUrl(['page' => $this->Paginator->counter('{{page}}') - 1, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angle-left"></i></a>
                <?php endif; ?>
                <?php $currentPage = $this->Paginator->counter('{{page}}');
                $pageCount = $this->Paginator->counter('{{pages}}');
                $start = max(1, $currentPage - 2);
                $end = min($pageCount, $start + 4);
                $start = max(1, $end - 4);
                for ($i = $start; $i <= $end; $i++): $isActive = $i == $currentPage; ?>
                    <a href="<?= $this->Paginator->generateUrl(['page' => $i, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid <?= $isActive ? '#3498db' : '#ddd' ?>;background:<?= $isActive ? '#3498db' : 'white' ?>;color:<?= $isActive ? 'white' : '#666' ?>;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;font-weight:<?= $isActive ? '600' : 'normal' ?>;transition:all 0.2s;" <?= !$isActive ? "onmouseover=\"this.style.background='#f5f5f5'\" onmouseout=\"this.style.background='white'\"" : '' ?>><?= $i ?></a>
                <?php endfor; ?>
                <?php if ($this->Paginator->hasNext()): ?>
                    <a href="<?= $this->Paginator->generateUrl(['page' => $this->Paginator->counter('{{page}}') + 1, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angle-right"></i></a>
                    <a href="<?= $this->Paginator->generateUrl(['page' => $pageCount, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #ddd;background:white;color:#666;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;transition:all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'"><i class="fa-solid fa-angles-right"></i></a>
                <?php endif; ?>
            </nav>
        <?php elseif (!empty($seguimientos)): ?>
            <!-- Single page - show page 1 button -->
            <nav style="display:flex;gap:0.25rem;justify-content:center;">
                <a href="<?= $this->Paginator->generateUrl(['page' => 1, 'per_page' => $perPage]) ?>" style="padding:0.5rem 0.75rem;border:1px solid #3498db;background:#3498db;color:white;text-decoration:none;border-radius:4px;font-size:14px;display:inline-flex;align-items:center;justify-content:center;min-width:36px;font-weight:600;">1</a>
            </nav>
        <?php else: ?>
            <!-- No records - empty space -->
            <div></div>
        <?php endif; ?>

        <!-- Records Counter (always visible) -->
        <?php if (!empty($seguimientos)): ?>
            <div style="color:#666;font-size:14px;text-align:right;">
                <?php
                $start = (($this->Paginator->counter('{{page}}') - 1) * $perPage) + 1;
                $end = min($this->Paginator->counter('{{page}}') * $perPage, $this->Paginator->counter('{{count}}'));
                $total = $this->Paginator->counter('{{count}}');
                ?>
                Mostrando <?= $start ?> a <?= $end ?> de <?= $total ?> registros
            </div>
        <?php else: ?>
            <div style="color:#666;font-size:14px;text-align:right;">Mostrando 0 registros</div>
        <?php endif; ?>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addSeguimientoModal" tabindex="-1" aria-labelledby="addSeguimientoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Convenios', 'action' => 'addSeguimiento']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addSeguimientoLabel">Nuevo Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_convenio', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un convenio',
                            'class' => 'form-select',
                            'label' => 'Convenio <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha', [
                            'type' => 'date',
                            'id' => 'add-fecha',
                            'class' => 'form-control',
                            'label' => 'Fecha <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_estado_convenio', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un estado',
                            'class' => 'form-select',
                            'label' => 'Estado Actual <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha_seguimiento', [
                            'type' => 'date',
                            'class' => 'form-control',
                            'label' => 'Fecha Seguimiento',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('comentarios', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => 'Comentarios',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('acciones_realizadas', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => 'Acciones Realizadas',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('alertas_identificadas', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => 'Alertas Identificadas',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('acciones_desarrollar', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => 'Acciones a Desarrollar',
                            'rows' => 3,
                        ]) ?>
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

<!-- Edit Modal -->
<div class="modal fade" id="editSeguimientoModal" tabindex="-1" aria-labelledby="editSeguimientoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'editSeguimientoForm', 'url' => ['controller' => 'Convenios', 'action' => 'editSeguimiento']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editSeguimientoLabel">Editar Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <?= $this->Form->hidden('id_convenio_seguimiento', ['id' => 'edit-id']) ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_convenio', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un convenio',
                            'id' => 'edit-convenio',
                            'class' => 'form-select',
                            'label' => 'Convenio <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha', [
                            'type' => 'date',
                            'id' => 'edit-fecha',
                            'class' => 'form-control',
                            'label' => 'Fecha <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_estado_convenio', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un estado',
                            'id' => 'edit-estado-convenio',
                            'class' => 'form-select',
                            'label' => 'Estado Actual <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha_seguimiento', [
                            'type' => 'date',
                            'id' => 'edit-fecha-seguimiento',
                            'class' => 'form-control',
                            'label' => 'Fecha Seguimiento',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('comentarios', [
                            'type' => 'textarea',
                            'id' => 'edit-comentarios',
                            'class' => 'form-control',
                            'label' => 'Comentarios',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('acciones_realizadas', [
                            'type' => 'textarea',
                            'id' => 'edit-acciones-realizadas',
                            'class' => 'form-control',
                            'label' => 'Acciones Realizadas',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('alertas_identificadas', [
                            'type' => 'textarea',
                            'id' => 'edit-alertas-identificadas',
                            'class' => 'form-control',
                            'label' => 'Alertas Identificadas',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('acciones_desarrollar', [
                            'type' => 'textarea',
                            'id' => 'edit-acciones-desarrollar',
                            'class' => 'form-control',
                            'label' => 'Acciones a Desarrollar',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Guardar Cambios'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewSeguimientoModal" tabindex="-1" aria-labelledby="viewSeguimientoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewSeguimientoLabel">Detalle del Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">CONVENIO</label>
                        <div id="view-convenio" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">FECHA</label>
                        <div id="view-fecha" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">ESTADO ACTUAL</label>
                        <div id="view-estado" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">FECHA SEGUIMIENTO</label>
                        <div id="view-fecha-seguimiento" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-12">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">COMENTARIOS</label>
                        <div id="view-comentarios" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px; min-height: 80px; white-space: pre-wrap;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-12">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">ACCIONES REALIZADAS</label>
                        <div id="view-acciones-realizadas" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px; min-height: 80px; white-space: pre-wrap;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-12">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">ALERTAS IDENTIFICADAS</label>
                        <div id="view-alertas-identificadas" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px; min-height: 80px; white-space: pre-wrap;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-12">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">ACCIONES A DESARROLLAR</label>
                        <div id="view-acciones-desarrollar" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px; min-height: 80px; white-space: pre-wrap;"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let dropdownData = null;

    // Load dropdown data on page load
    document.addEventListener('DOMContentLoaded', function() {
        fetch('<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'getSeguimientoDropdownData']) ?>')
            .then(response => response.json())
            .then(data => {
                dropdownData = data;
                populateDropdowns();
            })
            .catch(error => console.error('Error loading dropdown data:', error));

        // Debounced global search
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

        // Set today's date in Add Modal when opened
        const addSeguimientoModal = document.getElementById('addSeguimientoModal');
        if (addSeguimientoModal) {
            addSeguimientoModal.addEventListener('shown.bs.modal', function() {
                const fechaInput = document.getElementById('add-fecha');
                if (fechaInput && !fechaInput.value) {
                    const today = new Date();
                    const year = today.getFullYear();
                    const month = String(today.getMonth() + 1).padStart(2, '0');
                    const day = String(today.getDate()).padStart(2, '0');
                    fechaInput.value = `${year}-${month}-${day}`;
                }
            });
        }
    });

    function populateDropdowns() {
        if (!dropdownData) return;

        // Helper templates for convenio items (main line + secondary line)
        function formatConvenio(conv) {
            if (!conv.id) return conv.text;

            // Get data from data attributes
            const $option = $(conv.element);
            const nombre = ($option.data('nombre') || '').toString().toUpperCase();
            const interno = $option.data('interno') || '';
            const cui = $option.data('cui') || '';
            const ubigeo = $option.data('ubigeo') || '';

            const $el = $(
                '<div class="convenio-option">' +
                '<div class="convenio-main" style="font-weight:700;color:#222;">' + nombre + '</div>' +
                '<div class="convenio-sub" style="font-size:13px;color:#666;">Interno: ' + interno + ' - CUI: ' + cui + ' - Ubigeo: ' + ubigeo + '</div>' +
                '</div>'
            );
            return $el;
        }

        function formatConvenioSelection(conv) {
            if (!conv.id) return conv.text;
            const $option = $(conv.element);
            const nombre = ($option.data('nombre') || '').toString().toUpperCase();
            return nombre || conv.text;
        }

        // Populate Add Modal - Convenios
        const addConvenio = document.querySelector('#addSeguimientoModal select[name="id_convenio"]');
        if (addConvenio) {
            addConvenio.innerHTML = '<option value="">Seleccione un convenio</option>';
            dropdownData.convenios.forEach(conv => {
                const option = document.createElement('option');
                option.value = conv.id;
                option.text = conv.text;
                option.setAttribute('data-tipo', conv.tipo_convenio || '');
                option.setAttribute('data-nombre', conv.nombre || '');
                option.setAttribute('data-interno', conv.codigo_interno || '');
                option.setAttribute('data-cui', conv.codigo_idea_cui || '');
                option.setAttribute('data-ubigeo', conv.ubigeo || '');
                addConvenio.appendChild(option);
            });
            $(addConvenio).select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#addSeguimientoModal'),
                placeholder: 'Seleccione un convenio',
                allowClear: true,
                templateResult: formatConvenio,
                templateSelection: formatConvenioSelection,
                escapeMarkup: function(m) {
                    return m;
                },
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }
            });
        }

        // Populate Add Modal - Estados Convenio
        const addEstado = document.querySelector('#addSeguimientoModal select[name="id_estado_convenio"]');
        if (addEstado) {
            addEstado.innerHTML = '<option value="">Seleccione un estado</option>';
            Object.entries(dropdownData.estadosConvenio).forEach(([key, value]) => {
                addEstado.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(addEstado).select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#addSeguimientoModal'),
                placeholder: 'Seleccione un estado',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Edit Modal - Convenios
        const editConvenio = document.getElementById('edit-convenio');
        if (editConvenio) {
            editConvenio.innerHTML = '<option value="">Seleccione un convenio</option>';
            dropdownData.convenios.forEach(conv => {
                const option = document.createElement('option');
                option.value = conv.id;
                option.text = conv.text;
                option.setAttribute('data-tipo', conv.tipo_convenio || '');
                option.setAttribute('data-nombre', conv.nombre || '');
                option.setAttribute('data-interno', conv.codigo_interno || '');
                option.setAttribute('data-cui', conv.codigo_idea_cui || '');
                option.setAttribute('data-ubigeo', conv.ubigeo || '');
                editConvenio.appendChild(option);
            });
            $(editConvenio).select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#editSeguimientoModal'),
                placeholder: 'Seleccione un convenio',
                allowClear: true,
                templateResult: formatConvenio,
                templateSelection: formatConvenioSelection,
                escapeMarkup: function(m) {
                    return m;
                },
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }
            });
        }

        // Populate Edit Modal - Estados Convenio
        const editEstado = document.getElementById('edit-estado-convenio');
        if (editEstado) {
            editEstado.innerHTML = '<option value="">Seleccione un estado</option>';
            Object.entries(dropdownData.estadosConvenio).forEach(([key, value]) => {
                editEstado.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(editEstado).select2({
                theme: 'bootstrap-5',
                dropdownParent: $('#editSeguimientoModal'),
                placeholder: 'Seleccione un estado',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }
    }

    // Filters and UI toggling
    document.addEventListener('DOMContentLoaded', function() {
        const toggleFiltersBtn = document.getElementById('toggleFilters');
        const filterRow = document.getElementById('filterRow');
        const mainSearchContainer = document.getElementById('mainSearchContainer');
        const searchInput = document.getElementById('searchInput');
        const filterConvenio = document.getElementById('filterConvenio');
        const filterFecha = document.getElementById('filterFecha');
        const filterEstado = document.getElementById('filterEstado');
        const filterFechaSeguimiento = document.getElementById('filterFechaSeguimiento');

        const filterFields = [filterConvenio, filterFecha, filterEstado, filterFechaSeguimiento];

        // Restore focus to last focused filter
        const lastFocused = sessionStorage.getItem('lastFocusedFilter');
        if (lastFocused) {
            const field = document.getElementById(lastFocused);
            if (field && field.offsetParent !== null) {
                setTimeout(() => field.focus(), 100);
            }
            sessionStorage.removeItem('lastFocusedFilter');
        }

        // Save focus state before page reload
        filterFields.forEach(field => {
            if (field) {
                field.addEventListener('focus', function() {
                    sessionStorage.setItem('lastFocusedFilter', this.id);
                });
            }
        });

        if (toggleFiltersBtn) {
            toggleFiltersBtn.addEventListener('click', function() {
                const isVisible = filterRow.style.display !== 'none';
                if (isVisible) {
                    filterRow.style.display = 'none';
                    mainSearchContainer.removeAttribute('hidden');
                    toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-filter"></i> Filtros';
                    filterFields.forEach(field => {
                        if (field) field.value = '';
                    });
                    applyFilters();
                } else {
                    filterRow.style.display = '';
                    mainSearchContainer.setAttribute('hidden', '');
                    toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';
                    if (searchInput) searchInput.value = '';
                    setTimeout(() => {
                        if (filterConvenio) filterConvenio.focus();
                    }, 100);
                }
            });
        }

        filterFields.forEach(field => {
            if (field) {
                field.addEventListener('input', function() {
                    clearTimeout(window.filterTimeout);
                    window.filterTimeout = setTimeout(applyFilters, 500);
                });
                field.addEventListener('change', applyFilters);
            }
        });
    });

    function applyFilters() {
        const filterConvenioValue = document.getElementById('filterConvenio')?.value || '';
        const filterFechaValue = document.getElementById('filterFecha')?.value || '';
        const filterEstadoValue = document.getElementById('filterEstado')?.value || '';
        const filterFechaSeguimientoValue = document.getElementById('filterFechaSeguimiento')?.value || '';
        const perPage = <?= $perPage ?>;

        const url = new URL(window.location.href);
        url.searchParams.set('page', '1');
        url.searchParams.set('per_page', perPage);
        url.searchParams.delete('search');

        if (filterConvenioValue) url.searchParams.set('filter_convenio', filterConvenioValue);
        else url.searchParams.delete('filter_convenio');

        if (filterFechaValue) url.searchParams.set('filter_fecha', filterFechaValue);
        else url.searchParams.delete('filter_fecha');

        if (filterEstadoValue) url.searchParams.set('filter_estado', filterEstadoValue);
        else url.searchParams.delete('filter_estado');

        if (filterFechaSeguimientoValue) url.searchParams.set('filter_fecha_seguimiento', filterFechaSeguimientoValue);
        else url.searchParams.delete('filter_fecha_seguimiento');

        window.location.href = url.toString();
    }

    function clearFilter(filterId) {
        const field = document.getElementById(filterId);
        if (field) {
            field.value = '';
            applyFilters();
        }
    }

    // Edit modal opener
    function openEditModal(seguimiento) {
        const form = document.getElementById('editSeguimientoForm');
        form.setAttribute('action', "<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'editSeguimiento']) ?>/" + seguimiento.id_convenio_seguimiento);
        document.getElementById('edit-id').value = seguimiento.id_convenio_seguimiento;

        // Convenio
        $('#edit-convenio').val(seguimiento.id_convenio || '').trigger('change');

        // Fecha
        let fechaValue = '';
        if (seguimiento.fecha) {
            if (typeof seguimiento.fecha === 'string') {
                fechaValue = seguimiento.fecha.split(' ')[0];
            } else if (seguimiento.fecha.date) {
                fechaValue = seguimiento.fecha.date.split(' ')[0];
            }
        }
        document.getElementById('edit-fecha').value = fechaValue;

        // Estado
        document.getElementById('edit-estado-convenio').value = seguimiento.id_estado_convenio || '';
        $('#edit-estado-convenio').trigger('change');

        // Fecha Seguimiento
        let fechaSeguimientoValue = '';
        if (seguimiento.fecha_seguimiento) {
            if (typeof seguimiento.fecha_seguimiento === 'string') {
                fechaSeguimientoValue = seguimiento.fecha_seguimiento.split(' ')[0];
            } else if (seguimiento.fecha_seguimiento.date) {
                fechaSeguimientoValue = seguimiento.fecha_seguimiento.date.split(' ')[0];
            }
        }
        document.getElementById('edit-fecha-seguimiento').value = fechaSeguimientoValue;

        // Text fields
        document.getElementById('edit-comentarios').value = seguimiento.comentarios || '';
        document.getElementById('edit-acciones-realizadas').value = seguimiento.acciones_realizadas || '';
        document.getElementById('edit-alertas-identificadas').value = seguimiento.alertas_identificadas || '';
        document.getElementById('edit-acciones-desarrollar').value = seguimiento.acciones_desarrollar || '';

        try {
            new bootstrap.Modal(document.getElementById('editSeguimientoModal')).show();
        } catch (e) {
            console.error(e);
        }
    }

    // View modal opener
    function openViewModal(seguimiento) {
        // Convenio
        const convenioText = seguimiento.convenio?.tipo_convenio || 'N/A';
        const municipalidadText = seguimiento.convenio?.municipalidade?.nombre || '';
        const codigoText = seguimiento.convenio?.codigo_interno || '';
        document.getElementById('view-convenio').innerHTML = `${convenioText}<br><small style="color:#666;">${municipalidadText} [${codigoText}]</small>`;

        // Fecha
        let fechaText = 'N/A';
        if (seguimiento.fecha) {
            fechaText = formatDate(seguimiento.fecha);
        }
        document.getElementById('view-fecha').textContent = fechaText;

        // Estado
        document.getElementById('view-estado').textContent = seguimiento.estados_convenio?.descripcion || 'N/A';

        // Fecha Seguimiento
        let fechaSeguimientoText = 'N/A';
        if (seguimiento.fecha_seguimiento) {
            fechaSeguimientoText = formatDate(seguimiento.fecha_seguimiento);
        }
        document.getElementById('view-fecha-seguimiento').textContent = fechaSeguimientoText;

        // Text fields
        document.getElementById('view-comentarios').textContent = seguimiento.comentarios || 'Sin comentarios';
        document.getElementById('view-acciones-realizadas').textContent = seguimiento.acciones_realizadas || 'Sin acciones realizadas';
        document.getElementById('view-alertas-identificadas').textContent = seguimiento.alertas_identificadas || 'Sin alertas identificadas';
        document.getElementById('view-acciones-desarrollar').textContent = seguimiento.acciones_desarrollar || 'Sin acciones a desarrollar';

        // Mostrar modal
        try {
            new bootstrap.Modal(document.getElementById('viewSeguimientoModal')).show();
        } catch (e) {
            console.error(e);
        }
    }

    // Helper function to format dates
    function formatDate(dateValue) {
        if (!dateValue) return 'N/A';

        let dateStr = '';
        if (typeof dateValue === 'string') {
            dateStr = dateValue;
        } else if (dateValue.date) {
            dateStr = dateValue.date;
        }

        if (!dateStr) return 'N/A';

        // Parse and format as DD/MM/YYYY
        const parts = dateStr.split(/[-\s]/);
        if (parts.length >= 3) {
            const year = parts[0];
            const month = parts[1];
            const day = parts[2];
            return `${day}/${month}/${year}`;
        }

        return dateStr;
    }

    // Change per page
    function changePerPage(perPage) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }
</script>
<?php $this->end(); ?>