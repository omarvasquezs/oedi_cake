<?php

/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Contacto[]|\Cake\Collection\CollectionInterface $contactos
 * @var \Cake\Collection\CollectionInterface $municipalidades
 */
?>

<style>
    .contactos-index {
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height) - 4rem);
    }

    .contactos-index .table-wrapper {
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
        -webkit-appearance: none !important;
        appearance: none !important;
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
        background-color: #ffffff;
        text-decoration: none !important;
        transition: background-color 0.2s ease;
        padding: 0;
        margin: 0;
    }

    .action-icon:hover {
        background-color: #f8f9fa;
    }

    .icon-view {
        color: #80868b;
    }

    .icon-edit {
        color: #4285F4;
    }

    .icon-delete {
        color: #DB4437;
    }

    /* Modal typography */
    #addModal .modal-content .form-control,
    #addModal .modal-content .form-select,
    #editModal .modal-content .form-control,
    #editModal .modal-content .form-select {
        font-size: 16px;
    }

    #addModal .modal-content .btn,
    #editModal .modal-content .btn {
        font-size: 16px;
    }
</style>

<div class="contactos-index">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <h2 style="margin:0;color:#2c3e50;font-size:24px;font-weight:500;">Contactos</h2>
        <button id="openAddContacto" type="button" data-bs-toggle="modal" data-bs-target="#addModal" style="background:#3498db;color:white;border:none;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <i class="fa-solid fa-plus"></i> Nuevo Contacto
        </button>
    </div>

    <!-- Search and Filters -->
    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;">
        <div style="flex:1;" id="mainSearchContainer" <?= (!empty($filterNombre) || !empty($filterCargo) || !empty($filterTelefono) || !empty($filterEmail) || !empty($filterMunicipalidad)) ? 'hidden' : '' ?>>
            <form method="get" action="<?= $this->Url->build(['controller' => 'Contactos', 'action' => 'index']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar contactos..." class="search-input form-control" style="border:1px solid #ddd;border-radius:4px;font-size:14px;background:white;color:#2c3e50;">
                <input type="hidden" name="per_page" value="<?= $perPage ?>">
                <?php if (!empty($search)): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Contactos', 'action' => 'index', '?' => ['per_page' => $perPage]]) ?>" id="clearSearch" class="input-clear" title="Limpiar búsqueda">
                        <i class="fa-solid fa-times"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>
        <button id="toggleFilters" style="background:white;color:#666;border:1px solid #ddd;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <?= (!empty($filterNombre) || !empty($filterCargo) || !empty($filterTelefono) || !empty($filterEmail) || !empty($filterMunicipalidad)) ? '<i class="fa-solid fa-times"></i> CERRAR FILTROS' : '<i class="fa-solid fa-filter"></i> Filtros' ?>
        </button>
    </div>

    <div class="table-wrapper" style="background:white;border-radius:8px;border:1px solid #e0e0e0;overflow:hidden;">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8f9fa;border-bottom:2px solid #e0e0e0;">
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">NOMBRE</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">CARGO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">TELÉFONO</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">EMAIL</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">MUNICIPALIDAD</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ACCIONES</th>
                </tr>
                <tr id="filterRow" style="background:white;border-bottom:2px solid #e0e0e0; display: <?= (!empty($filterNombre) || !empty($filterCargo) || !empty($filterTelefono) || !empty($filterEmail) || !empty($filterMunicipalidad)) ? '' : 'none' ?>;">
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterNombre" value="<?= h($filterNombre ?? '') ?>" placeholder="Filtrar nombre..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterNombre)): ?>
                                <button type="button" onclick="clearFilter('filterNombre')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterCargo" value="<?= h($filterCargo ?? '') ?>" placeholder="Filtrar cargo..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterCargo)): ?>
                                <button type="button" onclick="clearFilter('filterCargo')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterTelefono" value="<?= h($filterTelefono ?? '') ?>" placeholder="Filtrar teléfono..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterTelefono)): ?>
                                <button type="button" onclick="clearFilter('filterTelefono')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterEmail" value="<?= h($filterEmail ?? '') ?>" placeholder="Filtrar email..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterEmail)): ?>
                                <button type="button" onclick="clearFilter('filterEmail')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterMunicipalidad" value="<?= h($filterMunicipalidad ?? '') ?>" placeholder="Filtrar municipalidad..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterMunicipalidad)): ?>
                                <button type="button" onclick="clearFilter('filterMunicipalidad')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($contactos) && count($contactos) > 0): ?>
                    <?php foreach ($contactos as $c): ?>
                        <tr style="border-bottom:1px solid #f0f0f0;">
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($c->nombre_completo) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#555;"><?= h($c->cargo) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#555;"><?= h($c->telefono) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#555;"><?= h($c->email) ?></td>
                            <td style="padding:1rem;font-size:14px;color:#555;"><?= $c->municipalidade ? h($c->municipalidade->nombre) : '' ?></td>
                            <td style="padding:1rem;vertical-align:middle;">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <button type="button" class="action-icon" title="Ver" onclick='openViewModal(<?= json_encode($c) ?>)'><i class="fa-solid fa-eye icon-view"></i></button>
                                    <button type="button" class="action-icon" title="Editar" onclick='openEditModal(<?= json_encode($c) ?>)'><i class="fa-solid fa-pen-to-square icon-edit"></i></button>
                                    <?= $this->Form->postLink('<i class="fa-solid fa-trash icon-delete"></i>', ['action' => 'delete', $c->id_contacto], ['confirm' => "¿Está seguro de que desea eliminar este contacto?", 'class' => 'action-icon', 'escape' => false, 'title' => 'Eliminar']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding:3rem;text-align:center;color:#95a5a6;font-size:14px;">No hay contactos disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
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

            <?php
            $currentPage = $this->Paginator->counter('{{page}}');
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

        <div style="color:#666;font-size:14px;text-align:right;">
            <?php $start = (($this->Paginator->counter('{{page}}') - 1) * $perPage) + 1;
            $end = min($this->Paginator->counter('{{page}}') * $perPage, $this->Paginator->counter('{{count}}'));
            $total = $this->Paginator->counter('{{count}}'); ?>
            Mostrando <?= $start ?> a <?= $end ?> de <?= $total ?> registros
        </div>
    </div>
</div>

<!-- Add Modal (Bootstrap 5) -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['controller' => 'Contactos', 'action' => 'add']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Crear Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3"><?= $this->Form->control('nombre_completo', ['class' => 'form-control', 'label' => 'Nombre Completo']) ?></div>
                <div class="mb-3"><?= $this->Form->control('cargo', ['class' => 'form-control', 'label' => 'Cargo']) ?></div>
                <div class="mb-3"><?= $this->Form->control('telefono', ['class' => 'form-control', 'label' => 'Teléfono']) ?></div>
                <div class="mb-3"><?= $this->Form->control('email', ['class' => 'form-control', 'label' => 'Email']) ?></div>
                <div class="mb-3"><?= $this->Form->control('id_municipalidad', ['options' => $municipalidades, 'class' => 'form-select', 'label' => 'Municipalidad']) ?></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- View Modal -->
<div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel">Ver Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>ID:</strong> <span id="view-id"></span></p>
                <p><strong>Nombre:</strong> <span id="view-nombre"></span></p>
                <p><strong>Cargo:</strong> <span id="view-cargo"></span></p>
                <p><strong>Teléfono:</strong> <span id="view-telefono"></span></p>
                <p><strong>Email:</strong> <span id="view-email"></span></p>
                <p><strong>Municipalidad:</strong> <span id="view-municipalidad"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'editForm', 'url' => ['controller' => 'Contactos', 'action' => 'edit']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Contacto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->Form->hidden('id_contacto', ['id' => 'edit-id']) ?>
                <div class="mb-3"><?= $this->Form->control('nombre_completo', ['id' => 'edit-nombre', 'class' => 'form-control', 'label' => 'Nombre Completo']) ?></div>
                <div class="mb-3"><?= $this->Form->control('cargo', ['id' => 'edit-cargo', 'class' => 'form-control', 'label' => 'Cargo']) ?></div>
                <div class="mb-3"><?= $this->Form->control('telefono', ['id' => 'edit-telefono', 'class' => 'form-control', 'label' => 'Teléfono']) ?></div>
                <div class="mb-3"><?= $this->Form->control('email', ['id' => 'edit-email', 'class' => 'form-control', 'label' => 'Email']) ?></div>
                <div class="mb-3"><?= $this->Form->control('id_municipalidad', ['id' => 'edit-municipalidad', 'options' => $municipalidades, 'class' => 'form-select', 'label' => 'Municipalidad']) ?></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <?= $this->Form->button(__('Guardar Cambios'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    // Bootstrap 5 modal openers
    function showBsModal(id) {
        try {
            new bootstrap.Modal(document.getElementById(id)).show();
        } catch (e) {
            console.error('Modal error', e);
        }
    }

    function openViewModal(contacto) {
        document.getElementById('view-id').innerText = contacto.id_contacto;
        document.getElementById('view-nombre').innerText = contacto.nombre_completo || '';
        document.getElementById('view-cargo').innerText = contacto.cargo || '';
        document.getElementById('view-telefono').innerText = contacto.telefono || '';
        document.getElementById('view-email').innerText = contacto.email || '';
        document.getElementById('view-municipalidad').innerText = contacto.municipalidade ? (contacto.municipalidade.nombre || '') : '';
        showBsModal('viewModal');
    }

    function openEditModal(contacto) {
        let editForm = document.getElementById('editForm');
        let action = "<?= $this->Url->build(['controller' => 'Contactos', 'action' => 'edit']) ?>/" + contacto.id_contacto;
        editForm.setAttribute('action', action);

        document.getElementById('edit-id').value = contacto.id_contacto;
        document.getElementById('edit-nombre').value = contacto.nombre_completo || '';
        document.getElementById('edit-cargo').value = contacto.cargo || '';
        document.getElementById('edit-telefono').value = contacto.telefono || '';
        document.getElementById('edit-email').value = contacto.email || '';
        document.getElementById('edit-municipalidad').value = contacto.id_municipalidad || '';
        showBsModal('editModal');
    }

    // Real-time search (debounced)
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

    // Filters
    document.addEventListener('DOMContentLoaded', function() {
        const toggleFiltersBtn = document.getElementById('toggleFilters');
        const filterRow = document.getElementById('filterRow');
        const mainSearchContainer = document.getElementById('mainSearchContainer');

        const filterNombre = document.getElementById('filterNombre');
        const filterCargo = document.getElementById('filterCargo');
        const filterTelefono = document.getElementById('filterTelefono');
        const filterEmail = document.getElementById('filterEmail');
        const filterMunicipalidad = document.getElementById('filterMunicipalidad');

        let filterTimeout;

        toggleFiltersBtn.addEventListener('click', function() {
            const isVisible = filterRow.style.display !== 'none';
            if (isVisible) {
                window.location.href = '<?= $this->Url->build(['action' => 'index', '?' => ['per_page' => $perPage]]) ?>';
            } else {
                filterRow.style.display = '';
                mainSearchContainer.setAttribute('hidden', '');
                toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';
                if (filterNombre) filterNombre.focus();
            }
        });

        function applyFilters() {
            const url = new URL(window.location.href);
            url.searchParams.delete('search');

            if (filterNombre.value) url.searchParams.set('filter_nombre', filterNombre.value);
            else url.searchParams.delete('filter_nombre');
            if (filterCargo.value) url.searchParams.set('filter_cargo', filterCargo.value);
            else url.searchParams.delete('filter_cargo');
            if (filterTelefono.value) url.searchParams.set('filter_telefono', filterTelefono.value);
            else url.searchParams.delete('filter_telefono');
            if (filterEmail.value) url.searchParams.set('filter_email', filterEmail.value);
            else url.searchParams.delete('filter_email');
            if (filterMunicipalidad.value) url.searchParams.set('filter_municipalidad', filterMunicipalidad.value);
            else url.searchParams.delete('filter_municipalidad');

            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }

        window.clearFilter = function(inputId) {
            const input = document.getElementById(inputId);
            input.value = '';
            applyFilters();
        };

        [filterNombre, filterCargo, filterTelefono, filterEmail, filterMunicipalidad].forEach(input => {
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

    function changePerPage(perPage) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }
</script>
<?php $this->end(); ?>