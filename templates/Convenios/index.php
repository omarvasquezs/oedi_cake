<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $convenios
 */
$this->assign('title', $title ?? 'Convenios');
?>

<style>
    .convenios-index {
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height) - 4rem);
    }

    .convenios-index .table-wrapper {
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

    #addConvenioModal .modal-content .form-control,
    #addConvenioModal .modal-content .form-select,
    #addConvenioModal .modal-content .btn,
    #editConvenioModal .modal-content .form-control,
    #editConvenioModal .modal-content .form-select,
    #editConvenioModal .modal-content .btn {
        font-size: 16px;
    }

    #addConvenioModal textarea,
    #editConvenioModal textarea {
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

<div class="convenios-index">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <h2 style="margin:0;color:#2c3e50;font-size:24px;font-weight:500;">Convenios</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addConvenioModal" style="background:#3498db;color:white;border:none;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <i class="fa-solid fa-plus"></i> Nuevo Convenio
        </button>
    </div>

    <!-- Search and Filters -->
    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;">
        <div style="flex:1;" id="mainSearchContainer" <?= (!empty($filterTipoConvenio) || !empty($filterMunicipalidad) || !empty($filterSector) || !empty($filterFechaFirma) || !empty($filterEstado) || !empty($filterCodigoInterno)) ? 'hidden' : '' ?>>
            <form method="get" action="<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'index']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar convenios..." class="search-input form-control" style="border:1px solid #ddd;border-radius:4px;font-size:14px;background:white;color:#2c3e50;">
                <input type="hidden" name="per_page" value="<?= $perPage ?>">
                <?php if (!empty($search)): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'index', '?' => ['per_page' => $perPage]]) ?>" class="input-clear" title="Limpiar búsqueda"><i class="fa-solid fa-times"></i></a>
                <?php endif; ?>
            </form>
        </div>
        <button id="toggleFilters" style="background:white;color:#666;border:1px solid #ddd;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <?= (!empty($filterTipoConvenio) || !empty($filterMunicipalidad) || !empty($filterSector) || !empty($filterFechaFirma) || !empty($filterEstado) || !empty($filterCodigoInterno)) ? '<i class="fa-solid fa-times"></i> CERRAR FILTROS' : '<i class="fa-solid fa-filter"></i> Filtros' ?>
        </button>
    </div>

    <div class="table-wrapper" style="background:white;border-radius:8px;border:1px solid #e0e0e0;overflow-y:auto;min-height:0;max-height:calc(100vh - 300px);">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8f9fa;border-bottom:2px solid #e0e0e0;">
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">TIPO CONVENIO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">MUNICIPALIDAD</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">SECTOR</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">MONTO (S/.)</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">FECHA FIRMA</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ESTADO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">CÓDIGO INTERNO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ACCIONES</th>
                </tr>
                <tr id="filterRow" style="background:white;border-bottom:2px solid #e0e0e0; display: <?= (!empty($filterTipoConvenio) || !empty($filterMunicipalidad) || !empty($filterSector) || !empty($filterFechaFirma) || !empty($filterEstado) || !empty($filterCodigoInterno)) ? '' : 'none' ?>;">
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterTipoConvenio" value="<?= h($filterTipoConvenio ?? '') ?>" placeholder="Filtrar tipo..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterTipoConvenio)): ?>
                                <button type="button" onclick="clearFilter('filterTipoConvenio')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterMunicipalidad" value="<?= h($filterMunicipalidad ?? '') ?>" placeholder="Filtrar departamento..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterMunicipalidad)): ?>
                                <button type="button" onclick="clearFilter('filterMunicipalidad')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterSector" value="<?= h($filterSector ?? '') ?>" placeholder="Filtrar sector..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterSector)): ?>
                                <button type="button" onclick="clearFilter('filterSector')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;"></th>
                    <th style="padding:0.5rem 1rem;">
                        <input type="date" id="filterFechaFirma" value="<?= h($filterFechaFirma ?? '') ?>" class="form-control" style="padding:0.5rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
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
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterCodigoInterno" value="<?= h($filterCodigoInterno ?? '') ?>" placeholder="Filtrar código..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterCodigoInterno)): ?>
                                <button type="button" onclick="clearFilter('filterCodigoInterno')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($convenios) && count($convenios) > 0): ?>
                    <?php foreach ($convenios as $convenio): ?>
                        <tr style="border-bottom:1px solid #f0f0f0;">
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($convenio->tipo_convenio) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($convenio->municipalidade->nombre ?? 'N/A') ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($convenio->sectore->descripcion ?? 'N/A') ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;">S/. <?= number_format($convenio->monto, 2) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($convenio->fecha_firma->format('d/m/Y')) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($convenio->estados_convenio->descripcion ?? 'N/A') ?></td>
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($convenio->codigo_interno) ?></td>
                            <td style="padding:1rem;vertical-align:middle;">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <button type="button" class="action-icon" title="Ver" onclick='openViewModal(<?= json_encode($convenio) ?>)'><i class="fa-solid fa-eye icon-view"></i></button>
                                    <button type="button" class="action-icon" title="Editar" onclick='openEditModal(<?= json_encode($convenio) ?>)'><i class="fa-solid fa-pen-to-square icon-edit"></i></button>
                                    <?= $this->Form->postLink('<i class="fa-solid fa-trash icon-delete"></i>', ['action' => 'delete', $convenio->id_convenio], ['confirm' => "¿Está seguro de eliminar este convenio?", 'class' => 'action-icon', 'escape' => false, 'title' => 'Eliminar']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" style="padding:3rem;text-align:center;color:#95a5a6;font-size:14px;">No hay convenios disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <?php if (!empty($convenios) && count($convenios) > 0): ?>
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
<div class="modal fade" id="addConvenioModal" tabindex="-1" aria-labelledby="addConvenioLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Convenios', 'action' => 'add']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addConvenioLabel">Nuevo Convenio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_municipalidad', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione una municipalidad',
                            'class' => 'form-select select2-municipalidad',
                            'label' => 'Municipalidad <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('tipo_convenio', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un tipo',
                            'class' => 'form-select',
                            'label' => 'Tipo de Convenio <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_sector', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un sector',
                            'class' => 'form-select',
                            'label' => 'Sector <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('id_direccion_linea', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione una dirección de línea',
                            'class' => 'form-select',
                            'label' => 'Dirección de Línea <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('monto', [
                            'type' => 'number',
                            'step' => '0.01',
                            'class' => 'form-control',
                            'label' => 'Monto <span class="text-danger">*</span>',
                            'escape' => false,
                            'placeholder' => '0.00',
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha_firma', [
                            'type' => 'date',
                            'class' => 'form-control',
                            'label' => 'Fecha de Firma <span class="text-danger">*</span>',
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
                            'label' => 'Estado <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('codigo_interno', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'Código Interno <span class="text-danger">*</span>',
                            'escape' => false,
                            'placeholder' => 'Ingrese el código interno',
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('codigo_convenio', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'Código Convenio',
                            'placeholder' => 'Ingrese el código del convenio',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('codigo_idea_cui', [
                            'type' => 'number',
                            'class' => 'form-control',
                            'label' => 'Código IDEA/CUI',
                            'placeholder' => 'Ingrese el código IDEA/CUI',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('beneficiarios', [
                            'type' => 'number',
                            'class' => 'form-control',
                            'label' => 'Beneficiarios',
                            'placeholder' => 'Número de beneficiarios',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('descripcion_idea_cui', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'label' => 'Descripción IDEA/CUI',
                            'placeholder' => 'Descripción del proyecto IDEA/CUI',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-12">
                        <?= $this->Form->control('descripcion', [
                            'type' => 'textarea',
                            'class' => 'form-control',
                            'label' => 'Descripción',
                            'placeholder' => 'Descripción general del convenio',
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
<div class="modal fade" id="editConvenioModal" tabindex="-1" aria-labelledby="editConvenioLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'editConvenioForm', 'url' => ['controller' => 'Convenios', 'action' => 'edit']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editConvenioLabel">Editar Convenio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <?= $this->Form->hidden('id_convenio', ['id' => 'edit-id']) ?>
                <div class="row g-3">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_municipalidad', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione una municipalidad',
                            'id' => 'edit-municipalidad',
                            'class' => 'form-select select2-municipalidad-edit',
                            'label' => 'Municipalidad <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('tipo_convenio', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un tipo',
                            'id' => 'edit-tipo-convenio',
                            'class' => 'form-select',
                            'label' => 'Tipo de Convenio <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('id_sector', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione un sector',
                            'id' => 'edit-sector',
                            'class' => 'form-select',
                            'label' => 'Sector <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('id_direccion_linea', [
                            'type' => 'select',
                            'options' => [],
                            'empty' => 'Seleccione una dirección de línea',
                            'id' => 'edit-direccion-linea',
                            'class' => 'form-select',
                            'label' => 'Dirección de Línea <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('monto', [
                            'type' => 'number',
                            'step' => '0.01',
                            'id' => 'edit-monto',
                            'class' => 'form-control',
                            'label' => 'Monto <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('fecha_firma', [
                            'type' => 'date',
                            'id' => 'edit-fecha-firma',
                            'class' => 'form-control',
                            'label' => 'Fecha de Firma <span class="text-danger">*</span>',
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
                            'label' => 'Estado <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('codigo_interno', [
                            'type' => 'text',
                            'id' => 'edit-codigo-interno',
                            'class' => 'form-control',
                            'label' => 'Código Interno <span class="text-danger">*</span>',
                            'escape' => false,
                            'required' => true,
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('codigo_convenio', [
                            'type' => 'text',
                            'id' => 'edit-codigo-convenio',
                            'class' => 'form-control',
                            'label' => 'Código Convenio',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('codigo_idea_cui', [
                            'type' => 'number',
                            'id' => 'edit-codigo-idea-cui',
                            'class' => 'form-control',
                            'label' => 'Código IDEA/CUI',
                        ]) ?>
                    </div>
                </div>
                <div class="row g-3 mt-1">
                    <div class="col-md-6">
                        <?= $this->Form->control('beneficiarios', [
                            'type' => 'number',
                            'id' => 'edit-beneficiarios',
                            'class' => 'form-control',
                            'label' => 'Beneficiarios',
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <?= $this->Form->control('descripcion_idea_cui', [
                            'type' => 'text',
                            'id' => 'edit-descripcion-idea-cui',
                            'class' => 'form-control',
                            'label' => 'Descripción IDEA/CUI',
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
<div class="modal fade" id="viewConvenioModal" tabindex="-1" aria-labelledby="viewConvenioLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewConvenioLabel">Detalle del Convenio</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <div class="row g-4">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">MUNICIPALIDAD</label>
                        <div id="view-municipalidad" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">TIPO DE CONVENIO</label>
                        <div id="view-tipo-convenio" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">SECTOR</label>
                        <div id="view-sector" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">DIRECCIÓN DE LÍNEA</label>
                        <div id="view-direccion-linea" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">MONTO</label>
                        <div id="view-monto" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">FECHA DE FIRMA</label>
                        <div id="view-fecha-firma" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">ESTADO</label>
                        <div id="view-estado" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">CÓDIGO INTERNO</label>
                        <div id="view-codigo-interno" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">CÓDIGO CONVENIO</label>
                        <div id="view-codigo-convenio" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">CÓDIGO IDEA/CUI</label>
                        <div id="view-codigo-idea-cui" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">BENEFICIARIOS</label>
                        <div id="view-beneficiarios" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">DESCRIPCIÓN IDEA/CUI</label>
                        <div id="view-descripcion-idea-cui" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px;"></div>
                    </div>
                </div>
                <div class="row g-4 mt-1">
                    <div class="col-12">
                        <label class="fw-bold text-secondary mb-2" style="font-size: 14px;">DESCRIPCIÓN</label>
                        <div id="view-descripcion" style="padding: 12px; background: #f8f9fa; border-radius: 6px; font-size: 15px; min-height: 80px; white-space: pre-wrap;"></div>
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
<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    let dropdownData = null;

    // Template function for displaying municipalidades with two lines
    function formatMunicipalidad(municipalidad) {
        if (!municipalidad.id) {
            return municipalidad.text;
        }

        var $municipalidad = $(
            '<div class="select2-municipalidad-option">' +
            '<div class="municipalidad-nombre" style="font-weight: 500; color: #333;">' + municipalidad.nombre + '</div>' +
            '<div class="municipalidad-ubicacion" style="font-size: 13px; color: #666;">[' + municipalidad.ubigeo + ', ' + municipalidad.departamento + ']</div>' +
            '</div>'
        );
        return $municipalidad;
    }

    function formatMunicipalidadSelection(municipalidad) {
        if (!municipalidad.id) {
            return municipalidad.text;
        }
        return municipalidad.nombre || municipalidad.text;
    }

    // Load dropdown data on page load
    document.addEventListener('DOMContentLoaded', function() {
        fetch('<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'getDropdownData']) ?>')
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

        // Populate Add Modal - Municipalidades
        const addMunicipalidad = document.querySelector('#addConvenioModal select[name="id_municipalidad"]');
        if (addMunicipalidad) {
            $(addMunicipalidad).empty();
            $(addMunicipalidad).select2({
                dropdownParent: $('#addConvenioModal'),
                placeholder: 'Seleccione una municipalidad',
                allowClear: true,
                data: [{
                    id: '',
                    text: 'Seleccione una municipalidad'
                }].concat(dropdownData.municipalidades),
                templateResult: formatMunicipalidad,
                templateSelection: formatMunicipalidadSelection,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    },
                    searching: function() {
                        return "Buscando...";
                    }
                }
            });
            // Auto-fill Codigo Interno when a municipalidad is selected in Add Modal
            const addCodigoInternoInput = document.querySelector('#addConvenioModal input[name="codigo_interno"]');
            if (addCodigoInternoInput) {
                $(addMunicipalidad).on('select2:select', function(e) {
                    const data = e.params.data || {};
                    const ubigeo = data.ubigeo || '';
                    if (!ubigeo) return;

                    fetch('<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'nextCodigoInterno']) ?>?ubigeo=' + encodeURIComponent(ubigeo))
                        .then(r => r.json())
                        .then(json => {
                            if (json && json.next) {
                                addCodigoInternoInput.value = json.next;
                            }
                        })
                        .catch(err => {
                            console.error('Error obteniendo siguiente código interno:', err);
                        });
                });

                $(addMunicipalidad).on('select2:unselect', function() {
                    addCodigoInternoInput.value = '';
                });
            }
        }

        // Populate Add Modal - Tipo Convenio
        const addTipoConvenio = document.querySelector('#addConvenioModal select[name="tipo_convenio"]');
        if (addTipoConvenio) {
            addTipoConvenio.innerHTML = '<option value="">Seleccione un tipo</option>' +
                '<option value="Colaboración">Colaboración</option>' +
                '<option value="Delegación">Delegación</option>' +
                '<option value="Asistencia Técnica">Asistencia Técnica</option>' +
                '<option value="Otros">Otros</option>';
            $(addTipoConvenio).select2({
                dropdownParent: $('#addConvenioModal'),
                placeholder: 'Seleccione un tipo',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Add Modal - Sectores
        const addSector = document.querySelector('#addConvenioModal select[name="id_sector"]');
        if (addSector) {
            addSector.innerHTML = '<option value="">Seleccione un sector</option>';
            Object.entries(dropdownData.sectores).forEach(([key, value]) => {
                addSector.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(addSector).select2({
                dropdownParent: $('#addConvenioModal'),
                placeholder: 'Seleccione un sector',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Add Modal - Direcciones Linea
        const addDireccionLinea = document.querySelector('#addConvenioModal select[name="id_direccion_linea"]');
        if (addDireccionLinea) {
            addDireccionLinea.innerHTML = '<option value="">Seleccione una dirección de línea</option>';
            Object.entries(dropdownData.direccionesLinea).forEach(([key, value]) => {
                addDireccionLinea.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(addDireccionLinea).select2({
                dropdownParent: $('#addConvenioModal'),
                placeholder: 'Seleccione una dirección de línea',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Add Modal - Estados Convenio
        const addEstadoConvenio = document.querySelector('#addConvenioModal select[name="id_estado_convenio"]');
        if (addEstadoConvenio) {
            addEstadoConvenio.innerHTML = '<option value="">Seleccione un estado</option>';
            Object.entries(dropdownData.estadosConvenio).forEach(([key, value]) => {
                addEstadoConvenio.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(addEstadoConvenio).select2({
                dropdownParent: $('#addConvenioModal'),
                placeholder: 'Seleccione un estado',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Edit Modal - Municipalidades
        const editMunicipalidad = document.getElementById('edit-municipalidad');
        if (editMunicipalidad) {
            $(editMunicipalidad).empty();
            $(editMunicipalidad).select2({
                dropdownParent: $('#editConvenioModal'),
                placeholder: 'Seleccione una municipalidad',
                allowClear: true,
                data: [{
                    id: '',
                    text: 'Seleccione una municipalidad'
                }].concat(dropdownData.municipalidades),
                templateResult: formatMunicipalidad,
                templateSelection: formatMunicipalidadSelection,
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

        // Populate Edit Modal - Tipo Convenio
        const editTipoConvenio = document.getElementById('edit-tipo-convenio');
        if (editTipoConvenio) {
            editTipoConvenio.innerHTML = '<option value="">Seleccione un tipo</option>' +
                '<option value="Colaboración">Colaboración</option>' +
                '<option value="Delegación">Delegación</option>' +
                '<option value="Asistencia Técnica">Asistencia Técnica</option>' +
                '<option value="Otros">Otros</option>';
            $(editTipoConvenio).select2({
                dropdownParent: $('#editConvenioModal'),
                placeholder: 'Seleccione un tipo',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Edit Modal - Sectores
        const editSector = document.getElementById('edit-sector');
        if (editSector) {
            editSector.innerHTML = '<option value="">Seleccione un sector</option>';
            Object.entries(dropdownData.sectores).forEach(([key, value]) => {
                editSector.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(editSector).select2({
                dropdownParent: $('#editConvenioModal'),
                placeholder: 'Seleccione un sector',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Edit Modal - Direcciones Linea
        const editDireccionLinea = document.getElementById('edit-direccion-linea');
        if (editDireccionLinea) {
            editDireccionLinea.innerHTML = '<option value="">Seleccione una dirección de línea</option>';
            Object.entries(dropdownData.direccionesLinea).forEach(([key, value]) => {
                editDireccionLinea.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(editDireccionLinea).select2({
                dropdownParent: $('#editConvenioModal'),
                placeholder: 'Seleccione una dirección de línea',
                allowClear: true,
                language: {
                    noResults: function() {
                        return "No se encontraron resultados";
                    }
                }
            });
        }

        // Populate Edit Modal - Estados Convenio
        const editEstadoConvenio = document.getElementById('edit-estado-convenio');
        if (editEstadoConvenio) {
            editEstadoConvenio.innerHTML = '<option value="">Seleccione un estado</option>';
            Object.entries(dropdownData.estadosConvenio).forEach(([key, value]) => {
                editEstadoConvenio.innerHTML += `<option value="${key}">${value}</option>`;
            });
            $(editEstadoConvenio).select2({
                dropdownParent: $('#editConvenioModal'),
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
        const filterTipoConvenio = document.getElementById('filterTipoConvenio');
        const filterMunicipalidad = document.getElementById('filterMunicipalidad');
        const filterSector = document.getElementById('filterSector');
        const filterFechaFirma = document.getElementById('filterFechaFirma');
        const filterEstado = document.getElementById('filterEstado');
        const filterCodigoInterno = document.getElementById('filterCodigoInterno');
        let filterTimeout;

        // Restaurar foco en el campo de búsqueda si hay búsqueda activa
        if (searchInput && searchInput.value && mainSearchContainer && !mainSearchContainer.hasAttribute('hidden')) {
            searchInput.focus();
            // Colocar cursor al final del texto
            const length = searchInput.value.length;
            searchInput.setSelectionRange(length, length);
        }

        // Restaurar foco en los campos de filtro si tienen valor
        const filterFields = [{
                element: filterTipoConvenio,
                name: 'filterTipoConvenio'
            },
            {
                element: filterMunicipalidad,
                name: 'filterMunicipalidad'
            },
            {
                element: filterSector,
                name: 'filterSector'
            },
            {
                element: filterEstado,
                name: 'filterEstado'
            },
            {
                element: filterCodigoInterno,
                name: 'filterCodigoInterno'
            }
        ];

        // Verificar si algún filtro de texto tiene foco guardado en sessionStorage
        const lastFocusedFilter = sessionStorage.getItem('lastFocusedFilter');
        if (lastFocusedFilter) {
            const filterField = filterFields.find(f => f.name === lastFocusedFilter);
            if (filterField && filterField.element && filterField.element.value) {
                setTimeout(() => {
                    filterField.element.focus();
                    const length = filterField.element.value.length;
                    filterField.element.setSelectionRange(length, length);
                }, 100);
            }
            sessionStorage.removeItem('lastFocusedFilter');
        }

        // Guardar qué campo tenía el foco antes de aplicar filtros
        filterFields.forEach(filter => {
            if (filter.element && filter.element.type === 'text') {
                filter.element.addEventListener('focus', function() {
                    sessionStorage.setItem('lastFocusedFilter', filter.name);
                });
            }
        });

        toggleFiltersBtn.addEventListener('click', function() {
            const isVisible = filterRow.style.display !== 'none';
            if (isVisible) {
                window.location.href = '<?= $this->Url->build(['action' => 'index', '?' => ['per_page' => $perPage]]) ?>';
            } else {
                filterRow.style.display = '';
                mainSearchContainer.setAttribute('hidden', '');
                toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';
                if (filterTipoConvenio) filterTipoConvenio.focus();
            }
        });

        function applyFilters() {
            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            if (filterTipoConvenio.value) url.searchParams.set('filter_tipo_convenio', filterTipoConvenio.value);
            else url.searchParams.delete('filter_tipo_convenio');
            if (filterMunicipalidad.value) url.searchParams.set('filter_municipalidad', filterMunicipalidad.value);
            else url.searchParams.delete('filter_municipalidad');
            if (filterSector.value) url.searchParams.set('filter_sector', filterSector.value);
            else url.searchParams.delete('filter_sector');
            if (filterFechaFirma.value) url.searchParams.set('filter_fecha_firma', filterFechaFirma.value);
            else url.searchParams.delete('filter_fecha_firma');
            if (filterEstado.value) url.searchParams.set('filter_estado', filterEstado.value);
            else url.searchParams.delete('filter_estado');
            if (filterCodigoInterno.value) url.searchParams.set('filter_codigo_interno', filterCodigoInterno.value);
            else url.searchParams.delete('filter_codigo_interno');
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }

        window.clearFilter = function(inputId) {
            const input = document.getElementById(inputId);
            input.value = '';
            applyFilters();
        };

        [filterTipoConvenio, filterMunicipalidad, filterSector, filterFechaFirma, filterEstado, filterCodigoInterno].forEach(input => {
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
    function openEditModal(convenio) {
        const form = document.getElementById('editConvenioForm');
        form.setAttribute('action', "<?= $this->Url->build(['controller' => 'Convenios', 'action' => 'edit']) ?>/" + convenio.id_convenio);
        document.getElementById('edit-id').value = convenio.id_convenio;

        // Municipalidad
        $('#edit-municipalidad').val(convenio.id_municipalidad || '').trigger('change');

        // Tipo Convenio
        $('#edit-tipo-convenio').val(convenio.tipo_convenio || '').trigger('change');

        // Sector
        document.getElementById('edit-sector').value = convenio.id_sector || '';
        $('#edit-sector').trigger('change');

        // Dirección de Línea
        document.getElementById('edit-direccion-linea').value = convenio.id_direccion_linea || '';
        $('#edit-direccion-linea').trigger('change');

        // Monto
        document.getElementById('edit-monto').value = convenio.monto || '';

        // Fecha de Firma
        let fechaFirmaValue = '';
        if (convenio.fecha_firma) {
            if (typeof convenio.fecha_firma === 'string') {
                fechaFirmaValue = convenio.fecha_firma.split(' ')[0];
            } else if (convenio.fecha_firma.date) {
                fechaFirmaValue = convenio.fecha_firma.date.split(' ')[0];
            }
        }


        document.getElementById('edit-fecha-firma').value = fechaFirmaValue;

        // Estado
        document.getElementById('edit-estado-convenio').value = convenio.id_estado_convenio || '';
        $('#edit-estado-convenio').trigger('change');

        // Código Interno
        document.getElementById('edit-codigo-interno').value = convenio.codigo_interno || '';

        // Código Convenio
        document.getElementById('edit-codigo-convenio').value = convenio.codigo_convenio || '';

        // Código IDEA/CUI
        document.getElementById('edit-codigo-idea-cui').value = convenio.codigo_idea_cui || '';

        // Beneficiarios
        document.getElementById('edit-beneficiarios').value = convenio.beneficiarios || '';

        // Descripción IDEA/CUI
        document.getElementById('edit-descripcion-idea-cui').value = convenio.descripcion_idea_cui || '';

        // Descripción
        document.getElementById('edit-descripcion').value = convenio.descripcion || '';

        try {
            new bootstrap.Modal(document.getElementById('editConvenioModal')).show();
        } catch (e) {
            console.error(e);
        }
    }

    // View modal opener
    function openViewModal(convenio) {
        // Municipalidad
        document.getElementById('view-municipalidad').textContent = convenio.municipalidade?.nombre || 'N/A';

        // Tipo Convenio
        document.getElementById('view-tipo-convenio').textContent = convenio.tipo_convenio || 'N/A';

        // Sector
        document.getElementById('view-sector').textContent = convenio.sectore?.descripcion || 'N/A';

        // Dirección de Línea
        document.getElementById('view-direccion-linea').textContent = convenio.direcciones_linea?.descripcion || 'N/A';

        // Monto
        const montoFormatted = convenio.monto ? 'S/. ' + parseFloat(convenio.monto).toLocaleString('es-PE', {
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        }) : 'N/A';
        document.getElementById('view-monto').textContent = montoFormatted;

        // Fecha de Firma
        let fechaFirmaText = 'N/A';
        if (convenio.fecha_firma) {
            fechaFirmaText = formatDate(convenio.fecha_firma);
        }
        document.getElementById('view-fecha-firma').textContent = fechaFirmaText;

        // Estado
        document.getElementById('view-estado').textContent = convenio.estados_convenio?.descripcion || 'N/A';

        // Código Interno
        document.getElementById('view-codigo-interno').textContent = convenio.codigo_interno || 'N/A';

        // Código Convenio
        document.getElementById('view-codigo-convenio').textContent = convenio.codigo_convenio || 'N/A';

        // Código IDEA/CUI
        document.getElementById('view-codigo-idea-cui').textContent = convenio.codigo_idea_cui || 'N/A';

        // Beneficiarios
        document.getElementById('view-beneficiarios').textContent = convenio.beneficiarios || 'N/A';

        // Descripción IDEA/CUI
        document.getElementById('view-descripcion-idea-cui').textContent = convenio.descripcion_idea_cui || 'N/A';

        // Descripción
        document.getElementById('view-descripcion').textContent = convenio.descripcion || 'Sin descripción';

        // Mostrar modal
        try {
            new bootstrap.Modal(document.getElementById('viewConvenioModal')).show();
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