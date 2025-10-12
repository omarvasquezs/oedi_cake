<?php

/**
 * @var \App\View\AppView $this
 */
$this->assign('title', $title ?? 'Usuarios');
?>

<style>
    /* Estilos para los modales de usuarios */
    #nuevoUsuarioModal .form-control,
    #editarUsuarioModal .form-control,
    #cambiarClaveModal .form-control {
        font-size: 15px !important;
    }

    #nuevoUsuarioModal .form-label,
    #editarUsuarioModal .form-label,
    #cambiarClaveModal .form-label {
        font-size: 15px !important;
    }

    #nuevoUsuarioModal .modal-title,
    #editarUsuarioModal .modal-title,
    #cambiarClaveModal .modal-title {
        font-size: 18px !important;
    }

    #nuevoUsuarioModal .modal-footer .btn,
    #editarUsuarioModal .modal-footer .btn,
    #cambiarClaveModal .modal-footer .btn {
        font-size: 15px !important;
    }

    #nuevoUsuarioModal select,
    #editarUsuarioModal select {
        font-size: 15px !important;
    }

    #nuevoUsuarioModal p,
    #editarUsuarioModal p,
    #cambiarClaveModal p {
        font-size: 13px !important;
    }

    /* Ocultar scrollbar vertical */
    #nuevoUsuarioModal .modal-body,
    #editarUsuarioModal .modal-body,
    #cambiarClaveModal .modal-body {
        overflow-y: auto;
        scrollbar-width: none;
        /* Firefox */
        -ms-overflow-style: none;
        /* IE and Edge */
    }

    #nuevoUsuarioModal .modal-body::-webkit-scrollbar,
    #editarUsuarioModal .modal-body::-webkit-scrollbar,
    #cambiarClaveModal .modal-body::-webkit-scrollbar {
        display: none;
        /* Chrome, Safari, Opera */
    }

    /* Mejorar el botón de cerrar */
    .modal-header .btn-close-custom {
        width: 2rem !important;
        height: 2rem !important;
        padding: 0 !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        transition: all 0.2s ease !important;
    }

    .modal-header .btn-close-custom:hover {
        background-color: #f3f4f6 !important;
        border-radius: 0.375rem !important;
    }

    .modal-header .btn-close-custom svg {
        width: 1.5rem !important;
        height: 1.5rem !important;
    }

    #clearSearch:hover {
        background-color: #f3f4f6 !important;
        color: #666 !important;
    }

    /* Filter clear buttons hover */
    th button[onclick^="clearFilter"]:hover {
        background-color: #f3f4f6 !important;
        color: #666 !important;
    }

    /* Utilities: inputs with icons inside */
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
        /* leave space for icon */
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

    /* ensure anchor clear links don't show visited/background styles */
    .input-with-icon .input-clear:visited {
        color: #999 !important;
        background: transparent !important;
    }

    .input-with-icon .input-clear:focus,
    .input-with-icon .input-clear:active {
        outline: none !important;
        box-shadow: none !important;
    }
</style>

<div class="users-index">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0; color: #2c3e50; font-size: 24px; font-weight: 500;">Usuarios</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#nuevoUsuarioModal" style="background: #3498db; color: white; border: none; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-plus"></i> Nuevo Usuario
        </button>
    </div>

    <!-- Search -->
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
        <div style="flex: 1;" id="mainSearchContainer" <?= (!empty($filterNombre) || !empty($filterUsuario) || !empty($filterEmail) || !empty($filterRoles)) ? 'hidden' : '' ?>>
            <form method="get" action="<?= $this->Url->build(['action' => 'index']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar usuarios..." class="search-input form-control" style="border: 1px solid #ddd; border-radius: 4px; font-size: 14px; background: white; color: #2c3e50;">
                <input type="hidden" name="per_page" value="<?= $perPage ?>">
                <?php if (!empty($search)): ?>
                    <a href="<?= $this->Url->build(['action' => 'index', '?' => ['per_page' => $perPage]]) ?>" id="clearSearch" class="input-clear" title="Limpiar búsqueda">
                        <i class="fa-solid fa-times" style="font-size: 14px;"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>
        <button id="toggleFilters" style="background: white; color: #666; border: 1px solid #ddd; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <?= (!empty($filterNombre) || !empty($filterUsuario) || !empty($filterEmail) || !empty($filterRoles)) ? '<i class="fa-solid fa-times"></i> CERRAR FILTROS' : '<i class="fa-solid fa-filter"></i> FILTROS' ?>
        </button>
    </div>

    <!-- Table -->
    <div style="background: white; border-radius: 8px; border: 1px solid #e0e0e0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #e0e0e0;">
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">
                        NOMBRE <i class="fa-solid fa-sort" style="font-size: 11px; margin-left: 0.25rem;"></i>
                    </th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">USUARIO</th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">EMAIL</th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">ROLES</th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">ACCIONES</th>
                </tr>
                <!-- Filter Row -->
                <tr id="filterRow" style="background: white; border-bottom: 2px solid #e0e0e0; display: <?= (!empty($filterNombre) || !empty($filterUsuario) || !empty($filterEmail) || !empty($filterRoles)) ? '' : 'none' ?>;">
                    <th style="padding: 0.5rem 1rem; position: relative; vertical-align: top;">
                        <div class="input-with-icon" style="position: relative;">
                            <input type="text" id="filterNombre" value="<?= h($filterNombre ?? '') ?>" placeholder="Filtrar Nombre" class="search-input" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; background: white; height: 36px;">
                            <?php if (!empty($filterNombre)): ?>
                            <button type="button" onclick="clearFilter('filterNombre')" class="input-clear" title="Limpiar">
                                <i class="fa-solid fa-times" style="font-size: 12px;"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding: 0.5rem 1rem; position: relative; vertical-align: top;">
                        <div class="input-with-icon" style="position: relative;">
                            <input type="text" id="filterUsuario" value="<?= h($filterUsuario ?? '') ?>" placeholder="Filtrar Usuario" class="search-input" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; background: white; height: 36px;">
                            <?php if (!empty($filterUsuario)): ?>
                            <button type="button" onclick="clearFilter('filterUsuario')" class="input-clear" title="Limpiar">
                                <i class="fa-solid fa-times" style="font-size: 12px;"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding: 0.5rem 1rem; position: relative; vertical-align: top;">
                        <div class="input-with-icon" style="position: relative;">
                            <input type="text" id="filterEmail" value="<?= h($filterEmail ?? '') ?>" placeholder="Filtrar Email" class="search-input" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 13px; background: white; height: 36px;">
                            <?php if (!empty($filterEmail)): ?>
                            <button type="button" onclick="clearFilter('filterEmail')" class="input-clear" title="Limpiar">
                                <i class="fa-solid fa-times" style="font-size: 12px;"></i>
                            </button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding: 0.5rem 1rem; position: relative; vertical-align: top;">
                        <div id="rolesFilterContainer" style="position: relative;">
                            <div id="selectedRolesTags" style="display: flex; flex-wrap: wrap; align-items: center; gap: 0.25rem; min-height: 36px; padding: 0.5rem; border: 1px solid #ddd; border-radius: 4px; background: white; cursor: text; position: relative;">
                                <span id="rolesPlaceholder" style="color: #999; font-size: 13px; position: absolute; left: 0.5rem; pointer-events: none;">Buscar roles...</span>
                            </div>
                            <input type="text" id="filterRolesInput" style="position: absolute; top: 50%; left: 0.5rem; transform: translateY(-50%); border: none; outline: none; background: transparent; font-size: 13px; width: calc(100% - 1rem); opacity: 0; pointer-events: none;">
                            <div id="rolesDropdown" style="position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #ddd; border-radius: 4px; max-height: 200px; overflow-y: auto; z-index: 1000; display: none; box-shadow: 0 4px 6px rgba(0,0,0,0.1); margin-top: 2px;"></div>
                        </div>
                    </th>
                    <th style="padding: 0.5rem 1rem;">
                        <!-- Espacio para mantener la estructura de la tabla -->
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($users)): ?>
                    <?php foreach ($users as $user): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 1rem; font-size: 14px; color: #2c3e50;"><?= h($user->name) ?></td>
                            <td style="padding: 1rem; font-size: 14px; color: #555;"><?= h($user->username) ?></td>
                            <td style="padding: 1rem; font-size: 14px; color: #555;"><?= h($user->email) ?></td>
                            <td style="padding: 1rem; font-size: 14px;">
                                <?php if (!empty($user->roles)): ?>
                                    <?php foreach ($user->roles as $roleName): ?>
                                        <span style="display: inline-block; padding: 0.25rem 0.75rem; background: #e3f2fd; color: #1976d2; border-radius: 12px; font-size: 12px; margin-right: 0.25rem;"><?= h($roleName) ?></span>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <span style="color: #95a5a6; font-size: 12px; font-style: italic;">Sin roles</span>
                                <?php endif; ?>
                            </td>
                            <td style="padding: 1rem; font-size: 14px;">
                                <button type="button" data-bs-toggle="modal" data-bs-target="#editarUsuarioModal" onclick="loadUserData(<?= h(json_encode($user)) ?>)" style="background: transparent; border: none; color: #3498db; cursor: pointer; padding: 0.25rem 0.5rem; margin: 0 0.25rem;" title="Editar">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </button>
                                <button type="button" data-bs-toggle="modal" data-bs-target="#cambiarClaveModal" onclick="loadUserForPassword(<?= $user->id ?>, '<?= h($user->name) ?>')" style="background: transparent; border: none; color: #f39c12; cursor: pointer; padding: 0.25rem 0.5rem; margin: 0 0.25rem;" title="Cambiar Contraseña">
                                    <i class="fa-solid fa-key"></i>
                                </button>
                                <button onclick="confirmDelete(<?= $user->id ?>, '<?= h($user->name) ?>')" style="background: transparent; border: none; color: #e74c3c; cursor: pointer; padding: 0.25rem 0.5rem; margin: 0 0.25rem;" title="Eliminar">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" style="padding: 2rem; text-align: center; color: #95a5a6; font-style: italic;">
                            <?php if (!empty($search)): ?>
                                No se encontraron usuarios que coincidan con "<?= h($search) ?>"
                            <?php else: ?>
                                No hay usuarios registrados en el sistema
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div style="display: grid; grid-template-columns: 1fr auto 1fr; align-items: center; margin-top: 1.5rem; padding: 0 0.5rem;">
        <!-- Items per page selector (left) -->
        <div style="display: flex; align-items: center; gap: 0.5rem;">
            <span style="color: #666; font-size: 14px; line-height: 1;">Mostrar:</span>
            <select id="perPageSelect" onchange="changePerPage(this.value)" style="padding: 0.5rem 2rem 0.5rem 0.75rem; border: 1px solid #ddd; border-radius: 4px; font-size: 14px; cursor: pointer; background: white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 16 16%27%3e%3cpath fill=%27none%27 stroke=%27%23343a40%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 5 6 6 6-6%27/%3e%3c/svg%3e') no-repeat right 0.5rem center/12px 12px; height: 36px; line-height: 1; margin-bottom: 0; appearance: none; -webkit-appearance: none; -moz-appearance: none; width: auto;">
                <option value="10" <?= $perPage == 10 ? 'selected' : '' ?>>10</option>
                <option value="20" <?= $perPage == 20 ? 'selected' : '' ?>>20</option>
                <option value="40" <?= $perPage == 40 ? 'selected' : '' ?>>40</option>
                <option value="50" <?= $perPage == 50 ? 'selected' : '' ?>>50</option>
                <option value="100" <?= $perPage == 100 ? 'selected' : '' ?>>100</option>
            </select>
            <span style="color: #666; font-size: 14px; line-height: 1;">registros</span>
        </div>

        <!-- Pagination buttons (center) -->
        <nav style="display: flex; gap: 0.25rem; justify-content: center;">
            <?php if ($this->Paginator->hasPrev()): ?>
                <a href="<?= $this->Paginator->generateUrl(['page' => 1, 'per_page' => $perPage]) ?>" style="padding: 0.5rem 0.75rem; border: 1px solid #ddd; background: white; color: #666; text-decoration: none; border-radius: 4px; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; min-width: 36px; transition: all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'">
                    <i class="fa-solid fa-angles-left"></i>
                </a>
                <a href="<?= $this->Paginator->generateUrl(['page' => $this->Paginator->counter('{{page}}') - 1, 'per_page' => $perPage]) ?>" style="padding: 0.5rem 0.75rem; border: 1px solid #ddd; background: white; color: #666; text-decoration: none; border-radius: 4px; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; min-width: 36px; transition: all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'">
                    <i class="fa-solid fa-angle-left"></i>
                </a>
            <?php endif; ?>

            <?php
            $currentPage = $this->Paginator->counter('{{page}}');
            $pageCount = $this->Paginator->counter('{{pages}}');

            // Show max 5 page numbers
            $start = max(1, $currentPage - 2);
            $end = min($pageCount, $start + 4);
            $start = max(1, $end - 4);

            for ($i = $start; $i <= $end; $i++):
                $isActive = $i == $currentPage;
            ?>
                <a href="<?= $this->Paginator->generateUrl(['page' => $i, 'per_page' => $perPage]) ?>" style="padding: 0.5rem 0.75rem; border: 1px solid <?= $isActive ? '#3498db' : '#ddd' ?>; background: <?= $isActive ? '#3498db' : 'white' ?>; color: <?= $isActive ? 'white' : '#666' ?>; text-decoration: none; border-radius: 4px; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; min-width: 36px; font-weight: <?= $isActive ? '600' : 'normal' ?>; transition: all 0.2s;" <?= !$isActive ? "onmouseover=\"this.style.background='#f5f5f5'\" onmouseout=\"this.style.background='white'\"" : '' ?>>
                    <?= $i ?>
                </a>
            <?php endfor; ?>

            <?php if ($this->Paginator->hasNext()): ?>
                <a href="<?= $this->Paginator->generateUrl(['page' => $this->Paginator->counter('{{page}}') + 1, 'per_page' => $perPage]) ?>" style="padding: 0.5rem 0.75rem; border: 1px solid #ddd; background: white; color: #666; text-decoration: none; border-radius: 4px; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; min-width: 36px; transition: all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'">
                    <i class="fa-solid fa-angle-right"></i>
                </a>
                <a href="<?= $this->Paginator->generateUrl(['page' => $pageCount, 'per_page' => $perPage]) ?>" style="padding: 0.5rem 0.75rem; border: 1px solid #ddd; background: white; color: #666; text-decoration: none; border-radius: 4px; font-size: 14px; display: inline-flex; align-items: center; justify-content: center; min-width: 36px; transition: all 0.2s;" onmouseover="this.style.background='#f5f5f5'" onmouseout="this.style.background='white'">
                    <i class="fa-solid fa-angles-right"></i>
                </a>
            <?php endif; ?>
        </nav>

        <!-- Pagination info (right) -->
        <div style="color: #666; font-size: 14px; text-align: right;">
            <?php
            $start = (($this->Paginator->counter('{{page}}') - 1) * $perPage) + 1;
            $end = min($this->Paginator->counter('{{page}}') * $perPage, $this->Paginator->counter('{{count}}'));
            $total = $this->Paginator->counter('{{count}}');
            ?>
            Mostrando <?= $start ?> a <?= $end ?> de <?= $total ?> registros
        </div>
    </div>
</div>

<!-- Modal: Nuevo Usuario -->
<div class="modal fade" id="nuevoUsuarioModal" tabindex="-1" aria-labelledby="nuevoUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 0.5rem; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);">
            <div class="modal-header" style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                <h5 class="modal-title" id="nuevoUsuarioModalLabel" style="font-size: 1.125rem; font-weight: 500; color: #111827;">Nuevo Usuario</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: #9ca3af; cursor: pointer;">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <?= $this->Form->create(null, ['url' => ['action' => 'add'], 'id' => 'nuevoUsuarioForm']) ?>
            <div class="modal-body" style="padding: 1rem 1.5rem; overflow-y: auto; max-height: calc(90vh - 180px);">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="newUserName" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Nombre</label>
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'newUserName',
                            'placeholder' => 'Ingrese el nombre',
                            'label' => false,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="newUserUsername" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Usuario</label>
                        <?= $this->Form->control('username', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'newUserUsername',
                            'placeholder' => 'Ingrese el nombre de usuario',
                            'label' => false,
                            'required' => true,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;',
                            'onInput' => 'this.value = this.value.replace(/\s/g, "")'
                        ]) ?>
                        <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">
                            <i class="fa-solid fa-circle-info"></i> Sin espacios
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="newUserEmail" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Email</label>
                        <?= $this->Form->control('email', [
                            'type' => 'email',
                            'class' => 'form-control',
                            'id' => 'newUserEmail',
                            'placeholder' => 'Ingrese el email',
                            'label' => false,
                            'required' => true,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="newUserRoles" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Roles</label>
                        <select multiple id="newUserRoles" name="roles[]" class="form-control" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; min-height: 6rem; font-size: 0.875rem;">
                            <?php foreach ($allRoles as $role): ?>
                                <option value="<?= $role->id ?>"><?= h($role->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Para seleccionar múltiples roles, mantenga presionada la tecla Ctrl (o Cmd en Mac) mientras hace clic.</p>
                    </div>
                    <div class="col-md-6">
                        <label for="newUserPassword" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Contraseña</label>
                        <?= $this->Form->control('password', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'id' => 'newUserPassword',
                            'placeholder' => 'Ingrese la contraseña',
                            'label' => false,
                            'required' => true,
                            'minlength' => 6,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                        <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">
                            <i class="fa-solid fa-circle-info"></i> Mínimo 6 caracteres
                        </p>
                    </div>
                    <div class="col-md-6">
                        <label for="newUserPasswordConfirmation" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Confirmar Contraseña</label>
                        <?= $this->Form->control('password_confirmation', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'id' => 'newUserPasswordConfirmation',
                            'placeholder' => 'Confirme la contraseña',
                            'label' => false,
                            'required' => true,
                            'minlength' => 6,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb; background: #f9fafb;">
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="padding: 0.5rem 1rem; background: #e5e7eb; color: #1f2937; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;">Cancelar</button>
                    <?= $this->Form->button('Guardar', [
                        'type' => 'submit',
                        'class' => 'btn',
                        'style' => 'padding: 0.5rem 1rem; background: #2563eb; color: white; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;'
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Modal: Editar Usuario -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="border-radius: 0.5rem; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);">
            <div class="modal-header" style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                <h5 class="modal-title" id="editarUsuarioModalLabel" style="font-size: 1.125rem; font-weight: 500; color: #111827;">Editar Usuario</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: #9ca3af; cursor: pointer;">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <?= $this->Form->create(null, ['url' => ['action' => 'edit', 1], 'id' => 'editarUsuarioForm']) ?>
            <div class="modal-body" style="padding: 1rem 1.5rem; overflow-y: auto; max-height: calc(90vh - 180px);">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="editUserName" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Nombre</label>
                        <?= $this->Form->control('name', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'editUserName',
                            'placeholder' => 'Ingrese el nombre',
                            'value' => 'Mario',
                            'label' => false,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="editUserUsername" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Usuario</label>
                        <?= $this->Form->control('username', [
                            'type' => 'text',
                            'class' => 'form-control',
                            'id' => 'editUserUsername',
                            'placeholder' => 'Ingrese el nombre de usuario',
                            'value' => 'mario',
                            'label' => false,
                            'oninput' => 'this.value = this.value.replace(/\s/g, "")',
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                        <small class="text-muted" style="font-size: 0.75rem; color: #6b7280;">Sin espacios</small>
                    </div>
                    <div class="col-md-6">
                        <label for="editUserEmail" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Email</label>
                        <?= $this->Form->control('email', [
                            'type' => 'email',
                            'class' => 'form-control',
                            'id' => 'editUserEmail',
                            'placeholder' => 'Ingrese el email',
                            'value' => 'mario@gmail.com',
                            'label' => false,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                    </div>
                    <div class="col-md-6">
                        <label for="editUserRoles" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Roles</label>
                        <select multiple id="editUserRoles" name="roles[]" class="form-control" style="width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; min-height: 6rem; font-size: 0.875rem;">
                            <?php foreach ($allRoles as $role): ?>
                                <option value="<?= $role->id ?>"><?= h($role->name) ?></option>
                            <?php endforeach; ?>
                        </select>
                        <p style="font-size: 0.75rem; color: #6b7280; margin-top: 0.25rem;">Para seleccionar múltiples roles, mantenga presionada la tecla Ctrl (o Cmd en Mac) mientras hace clic.</p>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb; background: #f9fafb;">
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="padding: 0.5rem 1rem; background: #e5e7eb; color: #1f2937; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;">Cancelar</button>
                    <?= $this->Form->button('Guardar', [
                        'type' => 'submit',
                        'class' => 'btn',
                        'style' => 'padding: 0.5rem 1rem; background: #2563eb; color: white; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;'
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Modal: Cambiar Contraseña -->
<div class="modal fade" id="cambiarClaveModal" tabindex="-1" aria-labelledby="cambiarClaveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 0.5rem; box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);">
            <div class="modal-header" style="padding: 1rem 1.5rem; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; justify-content: space-between;">
                <h5 class="modal-title" id="cambiarClaveModalLabel" style="font-size: 1.125rem; font-weight: 500; color: #111827;">Cambiar Contraseña</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Cerrar" style="background: none; border: none; color: #9ca3af; cursor: pointer;">
                    <svg stroke="currentColor" fill="none" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" xmlns="http://www.w3.org/2000/svg">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <?= $this->Form->create(null, ['url' => ['action' => 'adminChangePassword', 1], 'id' => 'cambiarClaveForm']) ?>
            <div class="modal-body" style="padding: 1rem 1.5rem; overflow-y: auto; max-height: calc(90vh - 180px);">
                <div style="display: flex; flex-direction: column; gap: 1rem;">
                    <p style="font-size: 0.875rem; color: #4b5563;">Cambiando contraseña para: <span style="font-weight: 500;">Mario</span></p>
                    <div>
                        <label for="adminNewPassword" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Nueva Contraseña</label>
                        <?= $this->Form->control('new_password', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'id' => 'adminNewPassword',
                            'placeholder' => 'Ingrese la nueva contraseña',
                            'label' => false,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                    </div>
                    <div>
                        <label for="adminConfirmNewPassword" class="form-label" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.25rem;">Confirmar Nueva Contraseña</label>
                        <?= $this->Form->control('confirm_new_password', [
                            'type' => 'password',
                            'class' => 'form-control',
                            'id' => 'adminConfirmNewPassword',
                            'placeholder' => 'Confirme la nueva contraseña',
                            'label' => false,
                            'style' => 'width: 100%; padding: 0.5rem 0.75rem; border: 1px solid #d1d5db; border-radius: 0.375rem; font-size: 0.875rem;'
                        ]) ?>
                    </div>
                </div>
            </div>
            <div class="modal-footer" style="padding: 1rem 1.5rem; border-top: 1px solid #e5e7eb; background: #f9fafb;">
                <div style="display: flex; justify-content: flex-end; gap: 0.75rem;">
                    <button type="button" class="btn" data-bs-dismiss="modal" style="padding: 0.5rem 1rem; background: #e5e7eb; color: #1f2937; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;">Cancelar</button>
                    <?= $this->Form->button('Guardar', [
                        'type' => 'submit',
                        'class' => 'btn',
                        'style' => 'padding: 0.5rem 1rem; background: #2563eb; color: white; border: none; border-radius: 0.375rem; font-weight: 500; cursor: pointer;'
                    ]) ?>
                </div>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<script>
    // Función para cargar datos del usuario en el modal de editar
    function loadUserData(user) {
        document.getElementById('editUserName').value = user.name || '';
        document.getElementById('editUserUsername').value = user.username || '';
        document.getElementById('editUserEmail').value = user.email || '';

        // Seleccionar los roles del usuario usando roleIds
        const rolesSelect = document.getElementById('editUserRoles');
        Array.from(rolesSelect.options).forEach(option => {
            option.selected = user.roleIds && user.roleIds.includes(parseInt(option.value));
        });

        // Actualizar la acción del formulario con el ID del usuario
        document.getElementById('editarUsuarioForm').action = '<?= $this->Url->build(['action' => 'edit']) ?>/' + user.id;
    }

    // Función para cargar datos de usuario en el modal de cambiar contraseña
    function loadUserForPassword(userId, userName) {
        // Actualizar el texto que muestra el nombre del usuario
        const userNameSpan = document.querySelector('#cambiarClaveModal p span');
        if (userNameSpan) {
            userNameSpan.textContent = userName;
        }

        // Actualizar la acción del formulario con el ID del usuario
        document.getElementById('cambiarClaveForm').action = '<?= $this->Url->build(['action' => 'adminChangePassword']) ?>/' + userId;

        // Limpiar los campos
        document.getElementById('adminNewPassword').value = '';
        document.getElementById('adminConfirmNewPassword').value = '';
    }

    // Función para confirmar eliminación
    function confirmDelete(userId, userName) {
        if (confirm('¿Está seguro de que desea eliminar al usuario "' + userName + '"?\n\nEsta acción no se puede deshacer.')) {
            // Crear formulario para enviar DELETE request
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = '<?= $this->Url->build(['action' => 'delete']) ?>/' + userId;

            // Añadir token CSRF
            const csrfToken = document.querySelector('input[name="_csrfToken"]');
            if (csrfToken) {
                const tokenInput = document.createElement('input');
                tokenInput.type = 'hidden';
                tokenInput.name = '_csrfToken';
                tokenInput.value = csrfToken.value;
                form.appendChild(tokenInput);
            }

            // Añadir método DELETE
            const methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    }

    // Real-time search functionality with backend query
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('searchInput');
        const searchForm = document.getElementById('searchForm');
        let searchTimeout;

        // Auto-focus on search input if user was searching
        if (sessionStorage.getItem('wasSearching') === 'true') {
            searchInput.focus();
            // Move cursor to end of text
            searchInput.setSelectionRange(searchInput.value.length, searchInput.value.length);
        }

        // Mark that user is searching when they interact with the input
        searchInput.addEventListener('focus', function() {
            sessionStorage.setItem('wasSearching', 'true');
        });

        searchInput.addEventListener('input', function() {
            // Clear previous timeout
            clearTimeout(searchTimeout);

            // Mark that user is actively searching
            sessionStorage.setItem('wasSearching', 'true');

            // Set new timeout to submit form after 500ms of no typing
            searchTimeout = setTimeout(function() {
                searchForm.submit();
            }, 500);
        });

        // Also submit on Enter key
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                clearTimeout(searchTimeout);
                searchForm.submit();
            }
        });

        // Clear the flag when clicking the clear button or navigating away
        const clearButton = document.getElementById('clearSearch');
        if (clearButton) {
            clearButton.addEventListener('click', function() {
                sessionStorage.removeItem('wasSearching');
            });
        }
    });

    // Advanced Filters functionality
    document.addEventListener('DOMContentLoaded', function() {
        const toggleFiltersBtn = document.getElementById('toggleFilters');
        const filterRow = document.getElementById('filterRow');
        const mainSearchContainer = document.getElementById('mainSearchContainer');
        const searchInput = document.getElementById('searchInput');

        // Filter inputs
        const filterNombre = document.getElementById('filterNombre');
        const filterUsuario = document.getElementById('filterUsuario');
        const filterEmail = document.getElementById('filterEmail');

        // Available roles from PHP
        const availableRoles = <?= json_encode(array_map(function ($role) {
                                    return $role->name;
                                }, $allRoles)) ?>;
        let selectedRoles = [];
        let filterTimeout;

        // Toggle filters visibility
        toggleFiltersBtn.addEventListener('click', function() {
            const isVisible = filterRow.style.display !== 'none';

            if (isVisible) {
                // Hide filters and redirect to clear all filters
                window.location.href = '<?= $this->Url->build(['action' => 'index', '?' => ['per_page' => $perPage]]) ?>';
            } else {
                // Show filters and hide main search
                filterRow.style.display = '';
                mainSearchContainer.style.display = 'none';
                toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';

                // Clear main search when showing filters
                searchInput.value = '';
            }
        });

        // Auto-apply filters function
        function applyFilters() {
            // Store which input had focus
            const activeElement = document.activeElement;
            const activeInputId = (activeElement && activeElement.tagName === 'INPUT') ? activeElement.id : null;

            if (activeInputId) {
                sessionStorage.setItem('activeFilterInput', activeInputId);
            }

            const url = new URL(window.location.href);
            url.searchParams.delete('search'); // Remove main search

            if (filterNombre.value) url.searchParams.set('filter_nombre', filterNombre.value);
            else url.searchParams.delete('filter_nombre');

            if (filterUsuario.value) url.searchParams.set('filter_usuario', filterUsuario.value);
            else url.searchParams.delete('filter_usuario');

            if (filterEmail.value) url.searchParams.set('filter_email', filterEmail.value);
            else url.searchParams.delete('filter_email');

            if (selectedRoles.length > 0) url.searchParams.set('filter_roles', selectedRoles.join(','));
            else url.searchParams.delete('filter_roles');

            url.searchParams.set('page', 1); // Reset to first page

            window.location.href = url.toString();
        }

        // Clear individual filter function
        window.clearFilter = function(inputId) {
            const input = document.getElementById(inputId);
            input.value = '';
            applyFilters();
        };

        // Add auto-filter on input change with debounce
        [filterNombre, filterUsuario, filterEmail].forEach(input => {
            input.addEventListener('input', function() {
                clearTimeout(filterTimeout);
                filterTimeout = setTimeout(() => {
                    applyFilters();
                }, 500);
            });
        });

        // Roles autocomplete functionality
        const rolesContainer = document.getElementById('selectedRolesTags');
        const rolesPlaceholder = document.getElementById('rolesPlaceholder');
        const rolesInput = document.getElementById('filterRolesInput');
        const rolesDropdown = document.getElementById('rolesDropdown');

        // Make the tags container clickable to focus the input
        rolesContainer.addEventListener('click', function(e) {
            // Don't trigger if clicking on a tag's X button
            if (e.target.classList.contains('fa-times')) return;

            rolesInput.style.opacity = '1';
            rolesInput.style.pointerEvents = 'auto';
            rolesInput.focus();
            showRolesDropdown();
        });

        rolesInput.addEventListener('focus', function() {
            showRolesDropdown();
        });

        rolesInput.addEventListener('input', function() {
            showRolesDropdown();
        });

        rolesInput.addEventListener('blur', function() {
            setTimeout(() => {
                rolesDropdown.style.display = 'none';
                rolesInput.style.opacity = '0';
                rolesInput.style.pointerEvents = 'none';
                rolesInput.value = '';
            }, 200);
        });

        function showRolesDropdown() {
            const searchTerm = rolesInput.value.toLowerCase();
            const filteredRoles = availableRoles.filter(role =>
                role.toLowerCase().includes(searchTerm) && !selectedRoles.includes(role)
            );

            if (filteredRoles.length === 0) {
                rolesDropdown.style.display = 'none';
                return;
            }

            rolesDropdown.innerHTML = filteredRoles.map(role =>
                `<div class="role-option" data-role="${role}" style="padding: 0.5rem 1rem; cursor: pointer; font-size: 13px; transition: background 0.2s;">
                    ${role}
                </div>`
            ).join('');

            rolesDropdown.style.display = 'block';

            // Add click handlers to options
            document.querySelectorAll('.role-option').forEach(option => {
                option.addEventListener('mouseenter', function() {
                    this.style.background = '#f0f0f0';
                });
                option.addEventListener('mouseleave', function() {
                    this.style.background = 'white';
                });
                option.addEventListener('click', function() {
                    addRoleTag(this.dataset.role);
                });
            });
        }

        function addRoleTag(role) {
            if (selectedRoles.includes(role)) return;

            selectedRoles.push(role);
            updateRolesTags();
            rolesInput.value = '';
            showRolesDropdown();

            // Apply filters immediately when a role is added
            applyFilters();
        }

        function removeRoleTag(role) {
            selectedRoles = selectedRoles.filter(r => r !== role);
            updateRolesTags();

            // Apply filters immediately when a role is removed
            applyFilters();
        }

        function updateRolesTags() {
            const tagsHtml = selectedRoles.map(role =>
                `<span class="role-tag" style="display: inline-flex; align-items: center; gap: 0.25rem; padding: 0.25rem 0.5rem; background: #e3f2fd; color: #1976d2; border-radius: 12px; font-size: 12px;">
                    ${role}
                    <i class="fa-solid fa-times" onclick="removeRoleTagByName('${role}')" style="cursor: pointer; font-size: 10px;"></i>
                </span>`
            ).join('');

            // Clear container and add tags
            const placeholder = rolesPlaceholder;
            rolesContainer.innerHTML = '';
            rolesContainer.appendChild(placeholder);

            if (selectedRoles.length === 0) {
                placeholder.style.display = 'block';
            } else {
                placeholder.style.display = 'none';
                rolesContainer.insertAdjacentHTML('beforeend', tagsHtml);
            }
        }

        // Make removeRoleTag available globally
        window.removeRoleTagByName = function(role) {
            removeRoleTag(role);
        };

        // Initialize with existing filter values if any
        const existingRolesFilter = '<?= $filterRoles ?? '' ?>';
        if (existingRolesFilter) {
            selectedRoles = existingRolesFilter.split(',').filter(r => r.trim() !== '');
        }
        updateRolesTags();

        // Show filters if any filter is active
        const hasActiveFilters = existingRolesFilter || '<?= $filterNombre ?? '' ?>' || '<?= $filterUsuario ?? '' ?>' || '<?= $filterEmail ?? '' ?>';
        if (hasActiveFilters) {
            mainSearchContainer.style.display = 'none';
            toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';
        }

        // Restore focus to the input that was active before page reload
        const activeFilterInput = sessionStorage.getItem('activeFilterInput');
        if (activeFilterInput && hasActiveFilters) {
            const inputToFocus = document.getElementById(activeFilterInput);
            if (inputToFocus) {
                setTimeout(() => {
                    inputToFocus.focus();
                    inputToFocus.setSelectionRange(inputToFocus.value.length, inputToFocus.value.length);
                }, 100);
                // Clear the stored value after using it
                sessionStorage.removeItem('activeFilterInput');
            }
        }
    });

    // Validación de contraseñas en formulario de nuevo usuario
    document.getElementById('nuevoUsuarioForm')?.addEventListener('submit', function(e) {
        const password = document.getElementById('newUserPassword').value;
        const passwordConfirmation = document.getElementById('newUserPasswordConfirmation').value;

        if (password !== passwordConfirmation) {
            e.preventDefault();
            alert('Las contraseñas no coinciden. Por favor, verifique e intente nuevamente.');
            return false;
        }

        if (password.length < 6) {
            e.preventDefault();
            alert('La contraseña debe tener al menos 6 caracteres.');
            return false;
        }

        const username = document.getElementById('newUserUsername').value;
        if (/\s/.test(username)) {
            e.preventDefault();
            alert('El nombre de usuario no puede contener espacios.');
            return false;
        }

        return true;
    });

    // Change items per page
    function changePerPage(perPage) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        url.searchParams.set('page', 1); // Reset to first page
        window.location.href = url.toString();
    }
</script>