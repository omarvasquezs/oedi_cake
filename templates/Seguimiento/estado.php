<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $estadosSeguimiento
 */
$this->assign('title', $title ?? 'Estados de Seguimiento');
?>

<style>
    .estados-seguimiento-index {
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height) - 4rem);
    }

    .estados-seguimiento-index .table-wrapper {
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

    .icon-edit {
        color: #4285F4;
    }

    .icon-delete {
        color: #DB4437;
    }

    #addEstadoModal .modal-content .form-control,
    #addEstadoModal .modal-content .btn,
    #editEstadoModal .modal-content .form-control,
    #editEstadoModal .modal-content .btn {
        font-size: 16px;
    }

    #addEstadoModal textarea,
    #editEstadoModal textarea {
        min-height: 120px;
    }

    /* Custom Select Styles */
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

    /* Select2 Custom Styles */
    .select2-container--default .select2-selection--single {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        height: calc(3.5rem + 2px);
        padding: 0.875rem 0.75rem;
        font-size: 16px;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.75rem;
        color: #495057;
        padding-left: 0;
        padding-right: 20px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: calc(3.5rem);
        right: 8px;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow b {
        border-color: #6c757d transparent transparent transparent;
        border-width: 6px 5px 0 5px;
    }

    .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b {
        border-color: transparent transparent #6c757d transparent;
        border-width: 0 5px 6px 5px;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        padding: 0.625rem 0.75rem;
        font-size: 16px;
        outline: none;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field:focus {
        border-color: #80bdff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .select2-dropdown {
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    .select2-container--default .select2-results__option {
        padding: 0.625rem 0.75rem;
        font-size: 16px;
    }

    .select2-container--default .select2-results__option--highlighted[aria-selected] {
        background-color: #3498db;
        color: white;
    }

    .select2-container--default .select2-results__option[aria-selected=true] {
        background-color: #e9ecef;
        color: #495057;
    }

    .select2-container {
        width: 100% !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__placeholder {
        color: #6c757d;
    }

    .select2-results__message {
        padding: 0.625rem 0.75rem;
        color: #6c757d;
        font-size: 16px;
    }

    /* Custom evento option styles */
    .select2-evento-option {
        padding: 0.25rem 0;
    }

    .select2-evento-option .evento-name {
        font-size: 16px;
        font-weight: 500;
        color: #212529;
        margin-bottom: 0.25rem;
    }

    .select2-evento-option .evento-fecha {
        font-size: 14px;
        color: #6c757d;
        font-weight: 400;
    }

    .select2-container--default .select2-results__option {
        padding: 0.5rem 0.75rem;
    }
</style>

<div class="estados-seguimiento-index">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <h2 style="margin:0;color:#2c3e50;font-size:24px;font-weight:500;">Estados de Seguimiento</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addEstadoModal" style="background:#3498db;color:white;border:none;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <i class="fa-solid fa-plus"></i> Nuevo Estado
        </button>
    </div>

    <!-- Search and Filters -->
    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;">
        <div style="flex:1;" id="mainSearchContainer" <?= (!empty($filterEvento) || !empty($filterDepartamento) || !empty($filterFecha) || !empty($filterEstado) || !empty($filterFechaCompromiso)) ? 'hidden' : '' ?>>
            <form method="get" action="<?= $this->Url->build(['controller' => 'Seguimiento', 'action' => 'estado']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar estados de seguimiento..." class="search-input form-control" style="border:1px solid #ddd;border-radius:4px;font-size:14px;background:white;color:#2c3e50;">
                <input type="hidden" name="per_page" value="<?= $perPage ?>">
                <?php if (!empty($search)): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Seguimiento', 'action' => 'estado', '?' => ['per_page' => $perPage]]) ?>" class="input-clear" title="Limpiar búsqueda"><i class="fa-solid fa-times"></i></a>
                <?php endif; ?>
            </form>
        </div>
        <button id="toggleFilters" style="background:white;color:#666;border:1px solid #ddd;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <?= (!empty($filterEvento) || !empty($filterDepartamento) || !empty($filterFecha) || !empty($filterEstado) || !empty($filterFechaCompromiso)) ? '<i class="fa-solid fa-times"></i> CERRAR FILTROS' : '<i class="fa-solid fa-filter"></i> Filtros' ?>
        </button>
    </div>

    <div class="table-wrapper" style="background:white;border-radius:8px;border:1px solid #e0e0e0;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8f9fa;border-bottom:2px solid #e0e0e0;">
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ENTIDAD - FECHA 1ER ACERC.</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">DEPARTAMENTO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">FECHA</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ESTADO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">FECHA COMPROMISO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ACCIONES</th>
                </tr>
                <tr id="filterRow" style="background:white;border-bottom:2px solid #e0e0e0; display: <?= (!empty($filterEvento) || !empty($filterDepartamento) || !empty($filterFecha) || !empty($filterEstado) || !empty($filterFechaCompromiso)) ? '' : 'none' ?>;">
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterEvento" value="<?= h($filterEvento ?? '') ?>" placeholder="Filtrar entidad..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterEvento)): ?>
                                <button type="button" onclick="clearFilter('filterEvento')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterDepartamento" value="<?= h($filterDepartamento ?? '') ?>" placeholder="Filtrar departamento..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterDepartamento)): ?>
                                <button type="button" onclick="clearFilter('filterDepartamento')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
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
                        <input type="date" id="filterFechaCompromiso" value="<?= h($filterFechaCompromiso ?? '') ?>" class="form-control" style="padding:0.5rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                    </th>
                    <th style="padding:0.5rem 1rem;"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($estadosSeguimiento) && count($estadosSeguimiento) > 0): ?>
                    <?php foreach ($estadosSeguimiento as $es): ?>
                        <tr style="border-bottom:1px solid #f0f0f0;">
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;">
                                <?= h($es->evento->municipalidade->nombre ?? 'N/A') ?><br>
                                <small style="color:#999;"><?= h($es->evento->fecha->format('d/m/Y')) ?></small>
                            </td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($es->evento->municipalidade->departamento ?? 'N/A') ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($es->fecha->format('d/m/Y')) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($es->estado->descripcion ?? 'N/A') ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;">
                                <?= $es->fecha_compromiso ? h($es->fecha_compromiso->format('d/m/Y')) : '-' ?>
                                <?php if ($es->compromiso_concluido): ?>
                                    <span style="color:#27ae60;margin-left:0.5rem;" title="Compromiso concluido"><i class="fa-solid fa-check-circle"></i></span>
                                <?php endif; ?>
                            </td>
                            <td style="padding:1rem;vertical-align:middle;">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <button type="button" class="action-icon" title="Editar" onclick='openEditModal(<?= json_encode($es) ?>)'><i class="fa-solid fa-pen-to-square icon-edit"></i></button>
                                    <?= $this->Form->postLink('<i class="fa-solid fa-trash icon-delete"></i>', ['action' => 'deleteEstado', $es->id_estado], ['confirm' => "¿Está seguro de eliminar este estado de seguimiento?", 'class' => 'action-icon', 'escape' => false, 'title' => 'Eliminar']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding:3rem;text-align:center;color:#95a5a6;font-size:14px;">No hay estados de seguimiento disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if (!empty($estadosSeguimiento) && count($estadosSeguimiento) > 0): ?>
        <div class="pagination-section" style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;margin-top:1.5rem;padding:0 0.5rem;">
            <div style="display:flex;align-items:center;gap:0.5rem;">
                <span style="color:#666;font-size:14px;line-height:1;">Mostrar:</span>
                <select id="perPageSelect" onchange="changePerPage(this.value)" style="padding:0.5rem 2rem 0.5rem 0.75rem;border:1px solid #ddd;border-radius:4px;font-size:14px;cursor:pointer;background:white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 16 16%27%3e%3cpath fill=%27none%27 stroke=%27%23343a40%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 5 6 6 6-6%27/%3e%3c/svg%3e') no-repeat right 0.5rem center/12px 12px;height:36px;line-height:1;margin-bottom:0;appearance:none;-webkit-appearance:none;-moz-appearance:none;width:auto;">
                    <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                    <option value="20" <?= $perPage == 20 ? 'selected' : '' ?>>20</option>
                    <option value="40" <?= $perPage == 40 ? 'selected' : '' ?>>40</option>
                    <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                    <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
                </select>
                <span style="color:#666;font-size:14px;line-height:1;">registros</span>
            </div>
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
            <div style="color:#666;font-size:14px;text-align:right;"><?php $start = (($this->Paginator->counter('{{page}}') - 1) * $perPage) + 1;
                                                                        $end = min($this->Paginator->counter('{{page}}') * $perPage, $this->Paginator->counter('{{count}}'));
                                                                        $total = $this->Paginator->counter('{{count}}'); ?>Mostrando <?= $start ?> a <?= $end ?> de <?= $total ?> registros</div>
        </div>
    <?php endif; ?>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addEstadoModal" tabindex="-1" aria-labelledby="addEstadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Seguimiento', 'action' => 'addEstado']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addEstadoLabel">Nuevo Estado de Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_evento', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un evento',
                            'class' => 'form-select',
                            'label' => 'Evento',
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
                            <button type="button" id="btnAddContacto" class="btn btn-success" style="white-space:nowrap; flex-shrink: 0;">+ Nuevo Contacto</button>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_tipo_reunion', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un tipo de reunión',
                            'class' => 'form-select',
                            'label' => 'Tipo de Reunión',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha', [
                            'type' => 'date',
                            'class' => 'form-control',
                            'label' => 'Fecha',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <?= $this->Form->control('id_estado_ref', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un estado',
                            'class' => 'form-select',
                            'label' => 'Estado (Referencia)',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('descripcion', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => 'Descripción',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha_compromiso', [
                            'type' => 'date',
                            'class' => 'form-control',
                            'label' => 'Fecha de Compromiso',
                            'required' => false,
                        ]) ?>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check mb-3">
                            <?= $this->Form->checkbox('compromiso_concluido', [
                                'class' => 'form-check-input',
                                'id' => 'compromisoConcluidoAdd',
                            ]) ?>
                            <label class="form-check-label" for="compromisoConcluidoAdd">
                                Compromiso Concluido
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('compromiso', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => 'Compromiso',
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
<div class="modal fade" id="editEstadoModal" tabindex="-1" aria-labelledby="editEstadoLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'editEstadoForm', 'url' => ['controller' => 'Seguimiento', 'action' => 'editEstado']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editEstadoLabel">Editar Estado de Seguimiento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <?= $this->Form->hidden('id_estado', ['id' => 'edit-id']) ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_evento', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un evento',
                            'id' => 'edit-evento',
                            'class' => 'form-select',
                            'label' => 'Evento',
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('id_contacto', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un contacto',
                            'id' => 'edit-contacto',
                            'class' => 'form-select',
                            'label' => 'Contacto',
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_tipo_reunion', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un tipo de reunión',
                            'id' => 'edit-tipo-reunion',
                            'class' => 'form-select',
                            'label' => 'Tipo de Reunión',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha', [
                            'type' => 'date',
                            'id' => 'edit-fecha',
                            'class' => 'form-control',
                            'label' => 'Fecha',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-12">
                        <?= $this->Form->control('id_estado_ref', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un estado',
                            'id' => 'edit-estado-ref',
                            'class' => 'form-select',
                            'label' => 'Estado (Referencia)',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('descripcion', [
                            'type' => 'textarea',
                            'id' => 'edit-descripcion',
                            'class' => 'form-control',
                            'label' => 'Descripción',
                            'rows' => 3,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha_compromiso', [
                            'type' => 'date',
                            'id' => 'edit-fecha-compromiso',
                            'class' => 'form-control',
                            'label' => 'Fecha de Compromiso',
                            'required' => false,
                        ]) ?>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check mb-3">
                            <?= $this->Form->checkbox('compromiso_concluido', [
                                'class' => 'form-check-input',
                                'id' => 'edit-compromiso-concluido',
                            ]) ?>
                            <label class="form-check-label" for="edit-compromiso-concluido">
                                Compromiso Concluido
                            </label>
                        </div>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('compromiso', [
                            'type' => 'textarea',
                            'id' => 'edit-compromiso',
                            'class' => 'form-control',
                            'label' => 'Compromiso',
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

<?php $this->start('script'); ?>
<!-- jQuery (required for Select2) -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let dropdownData = null;

    // Template function for displaying eventos with fecha
    function formatEvento(evento) {
        if (!evento.id) {
            return evento.text;
        }

        var $evento = $(
            '<div class="select2-evento-option">' +
            '<div class="evento-name">' + evento.text + '</div>' +
            '<div class="evento-fecha">Fecha: ' + evento.fecha + '</div>' +
            '</div>'
        );
        return $evento;
    }

    function formatEventoSelection(evento) {
        if (!evento.id) {
            return evento.text;
        }
        return evento.text;
    }

    // Load dropdown data on page load
    document.addEventListener('DOMContentLoaded', function() {
        fetch('<?= $this->Url->build(['controller' => 'Seguimiento', 'action' => 'getDropdownData']) ?>')
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
    });

    function populateDropdowns() {
        if (!dropdownData) return;

        // Populate Add Modal
        const addEvento = document.querySelector('#addEstadoModal select[name="id_evento"]');
        const addContacto = document.querySelector('#addEstadoModal select[name="id_contacto"]');
        const addTipoReunion = document.querySelector('#addEstadoModal select[name="id_tipo_reunion"]');
        const addEstadoRef = document.querySelector('#addEstadoModal select[name="id_estado_ref"]');

        if (addEvento) {
            // Clear and use data from API directly for eventos (which includes fecha)
            $(addEvento).empty();
            $(addEvento).select2({
                dropdownParent: $('#addEstadoModal'),
                placeholder: 'Seleccione un evento',
                allowClear: true,
                data: [{
                    id: '',
                    text: 'Seleccione un evento'
                }].concat(dropdownData.eventos),
                templateResult: formatEvento,
                templateSelection: formatEventoSelection,
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

        if (addContacto) {
            addContacto.innerHTML = '<option value="">Seleccione un contacto</option>';
            Object.entries(dropdownData.contactos).forEach(([key, value]) => {
                addContacto.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(addContacto).select2({
                dropdownParent: $('#addEstadoModal'),
                placeholder: 'Seleccione un contacto',
                allowClear: true,
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

        if (addTipoReunion) {
            addTipoReunion.innerHTML = '<option value="">Seleccione tipo de reunión</option>';
            Object.entries(dropdownData.tiposReunion).forEach(([key, value]) => {
                addTipoReunion.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(addTipoReunion).select2({
                dropdownParent: $('#addEstadoModal'),
                placeholder: 'Seleccione tipo de reunión',
                allowClear: true,
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

        if (addEstadoRef) {
            addEstadoRef.innerHTML = '<option value="">Seleccione un estado</option>';
            Object.entries(dropdownData.estados).forEach(([key, value]) => {
                addEstadoRef.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(addEstadoRef).select2({
                dropdownParent: $('#addEstadoModal'),
                placeholder: 'Seleccione un estado',
                allowClear: true,
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

        // Populate Edit Modal
        const editEvento = document.getElementById('edit-evento');
        const editContacto = document.getElementById('edit-contacto');
        const editTipoReunion = document.getElementById('edit-tipo-reunion');
        const editEstadoRef = document.getElementById('edit-estado-ref');

        if (editEvento) {
            $(editEvento).empty();
            $(editEvento).select2({
                dropdownParent: $('#editEstadoModal'),
                placeholder: 'Seleccione un evento',
                allowClear: true,
                data: [{
                    id: '',
                    text: 'Seleccione un evento'
                }].concat(dropdownData.eventos),
                templateResult: formatEvento,
                templateSelection: formatEventoSelection,
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

        if (editContacto) {
            editContacto.innerHTML = '<option value="">Seleccione un contacto</option>';
            Object.entries(dropdownData.contactos).forEach(([key, value]) => {
                editContacto.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(editContacto).select2({
                dropdownParent: $('#editEstadoModal'),
                placeholder: 'Seleccione un contacto',
                allowClear: true,
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

        if (editTipoReunion) {
            editTipoReunion.innerHTML = '<option value="">Seleccione tipo de reunión</option>';
            Object.entries(dropdownData.tiposReunion).forEach(([key, value]) => {
                editTipoReunion.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(editTipoReunion).select2({
                dropdownParent: $('#editEstadoModal'),
                placeholder: 'Seleccione tipo de reunión',
                allowClear: true,
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

        if (editEstadoRef) {
            editEstadoRef.innerHTML = '<option value="">Seleccione un estado</option>';
            Object.entries(dropdownData.estados).forEach(([key, value]) => {
                editEstadoRef.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(editEstadoRef).select2({
                dropdownParent: $('#editEstadoModal'),
                placeholder: 'Seleccione un estado',
                allowClear: true,
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
    }

    // Filters and UI toggling
    document.addEventListener('DOMContentLoaded', function() {
        const toggleFiltersBtn = document.getElementById('toggleFilters');
        const filterRow = document.getElementById('filterRow');
        const mainSearchContainer = document.getElementById('mainSearchContainer');
        const filterEvento = document.getElementById('filterEvento');
        const filterDepartamento = document.getElementById('filterDepartamento');
        const filterFecha = document.getElementById('filterFecha');
        const filterEstado = document.getElementById('filterEstado');
        const filterFechaCompromiso = document.getElementById('filterFechaCompromiso');
        let filterTimeout;

        toggleFiltersBtn.addEventListener('click', function() {
            const isVisible = filterRow.style.display !== 'none';
            if (isVisible) {
                window.location.href = '<?= $this->Url->build(['action' => 'estado', '?' => ['per_page' => $perPage]]) ?>';
            } else {
                filterRow.style.display = '';
                mainSearchContainer.setAttribute('hidden', '');
                toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';
                if (filterEvento) filterEvento.focus();
            }
        });

        function applyFilters() {
            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            if (filterEvento.value) url.searchParams.set('filter_evento', filterEvento.value);
            else url.searchParams.delete('filter_evento');
            if (filterDepartamento.value) url.searchParams.set('filter_departamento', filterDepartamento.value);
            else url.searchParams.delete('filter_departamento');
            if (filterFecha.value) url.searchParams.set('filter_fecha', filterFecha.value);
            else url.searchParams.delete('filter_fecha');
            if (filterEstado.value) url.searchParams.set('filter_estado', filterEstado.value);
            else url.searchParams.delete('filter_estado');
            if (filterFechaCompromiso.value) url.searchParams.set('filter_fecha_compromiso', filterFechaCompromiso.value);
            else url.searchParams.delete('filter_fecha_compromiso');
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }

        window.clearFilter = function(inputId) {
            const input = document.getElementById(inputId);
            input.value = '';
            applyFilters();
        };

        [filterEvento, filterDepartamento, filterFecha, filterEstado, filterFechaCompromiso].forEach(input => {
            if (input) {
                input.addEventListener('input', function() {
                    clearTimeout(filterTimeout);
                    filterTimeout = setTimeout(function() {
                        applyFilters();
                    }, 500);
                });
                // For date inputs, trigger immediately on change
                if (input.type === 'date') {
                    input.addEventListener('change', function() {
                        clearTimeout(filterTimeout);
                        applyFilters();
                    });
                }
            }
        });
    });

    // Edit modal opener
    function openEditModal(estadoSeguimiento) {
        const form = document.getElementById('editEstadoForm');
        form.setAttribute('action', "<?= $this->Url->build(['controller' => 'Seguimiento', 'action' => 'editEstado']) ?>/" + estadoSeguimiento.id_estado);
        document.getElementById('edit-id').value = estadoSeguimiento.id_estado;
        document.getElementById('edit-evento').value = estadoSeguimiento.id_evento || '';
        document.getElementById('edit-contacto').value = estadoSeguimiento.id_contacto || '';
        document.getElementById('edit-tipo-reunion').value = estadoSeguimiento.id_tipo_reunion || '';
        document.getElementById('edit-fecha').value = estadoSeguimiento.fecha ? estadoSeguimiento.fecha.date.split(' ')[0] : '';
        document.getElementById('edit-estado-ref').value = estadoSeguimiento.id_estado_ref || '';
        document.getElementById('edit-fecha-compromiso').value = estadoSeguimiento.fecha_compromiso ? estadoSeguimiento.fecha_compromiso.date.split(' ')[0] : '';
        document.getElementById('edit-descripcion').value = estadoSeguimiento.descripcion || '';
        document.getElementById('edit-compromiso').value = estadoSeguimiento.compromiso || '';
        document.getElementById('edit-compromiso-concluido').checked = estadoSeguimiento.compromiso_concluido || false;
        try {
            new bootstrap.Modal(document.getElementById('editEstadoModal')).show();
        } catch (e) {
            console.error(e);
        }
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