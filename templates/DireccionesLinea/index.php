<?php

/**
 * @var \App\View\AppView $this
 * @var \Cake\Collection\CollectionInterface $direcciones
 */
$this->assign('title', $title ?? 'Direcciones de Línea');
?>

<style>
    .direcciones-index {
        display: flex;
        flex-direction: column;
        height: calc(100vh - var(--topbar-height) - 4rem);
    }

    .direcciones-index .table-wrapper {
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

    #addDireccionModal .modal-content .form-control,
    #addDireccionModal .modal-content .btn,
    #editDireccionModal .modal-content .form-control,
    #editDireccionModal .modal-content .btn {
        font-size: 16px;
    }

    #addDireccionModal textarea,
    #editDireccionModal textarea {
        min-height: 120px;
    }
</style>

<div class="direcciones-index">
    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:2rem;">
        <h2 style="margin:0;color:#2c3e50;font-size:24px;font-weight:500;">Direcciones de Línea</h2>
        <button type="button" data-bs-toggle="modal" data-bs-target="#addDireccionModal" style="background:#3498db;color:white;border:none;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <i class="fa-solid fa-plus"></i> Nueva Dirección
        </button>
    </div>

    <div style="display:flex;gap:1rem;margin-bottom:1.5rem;">
        <div style="flex:1;" id="mainSearchContainer" <?= !empty($filterDescripcion) ? 'hidden' : '' ?>>
            <form method="get" action="<?= $this->Url->build(['controller' => 'DireccionesLinea', 'action' => 'index']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar direcciones..." class="search-input form-control" style="border:1px solid #ddd;border-radius:4px;font-size:14px;background:white;color:#2c3e50;">
                <input type="hidden" name="per_page" value="<?= $perPage ?>">
                <?php if (!empty($search)) : ?>
                    <a href="<?= $this->Url->build(['controller' => 'DireccionesLinea', 'action' => 'index', '?' => ['per_page' => $perPage]]) ?>" class="input-clear" title="Limpiar búsqueda"><i class="fa-solid fa-times"></i></a>
                <?php endif; ?>
            </form>
        </div>
        <button id="toggleFilters" style="background:white;color:#666;border:1px solid #ddd;padding:0.7rem 1.5rem;border-radius:4px;cursor:pointer;font-size:14px;display:flex;align-items:center;gap:0.5rem;">
            <?= !empty($filterDescripcion) ? '<i class="fa-solid fa-times"></i> CERRAR FILTROS' : '<i class="fa-solid fa-filter"></i> Filtros' ?>
        </button>
    </div>

    <div class="table-wrapper" style="background:white;border-radius:8px;border:1px solid #e0e0e0;overflow-y:auto;min-height:0;max-height:calc(100vh - 300px);">
        <table style="width:100%;border-collapse:collapse;">
            <thead>
                <tr style="background:#f8f9fa;border-bottom:2px solid #e0e0e0;">
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">DESCRIPCIÓN</th>
                    <th style="padding:1rem;text-align:left;font-size:13px;color:#666;font-weight:600;text-transform:uppercase;">ACCIONES</th>
                </tr>
                <tr id="filterRow" style="background:white;border-bottom:2px solid #e0e0e0; display: <?= !empty($filterDescripcion) ? '' : 'none' ?>;">
                    <th style="padding:0.5rem 1rem;">
                        <div class="input-with-icon">
                            <span class="input-icon"><i class="fa-solid fa-search" style="font-size:12px;"></i></span>
                            <input type="text" id="filterDescripcion" value="<?= h($filterDescripcion ?? '') ?>" placeholder="Filtrar descripción..." class="search-input form-control" style="padding:0.5rem 0.5rem 0.5rem 2rem;font-size:13px;border:1px solid #ddd;border-radius:4px;">
                            <?php if (!empty($filterDescripcion)) : ?>
                                <button type="button" onclick="clearFilter('filterDescripcion')" class="input-clear" style="cursor:pointer;"><i class="fa-solid fa-times"></i></button>
                            <?php endif; ?>
                        </div>
                    </th>
                    <th style="padding:0.5rem 1rem;"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($direcciones) && count($direcciones) > 0) : ?>
                    <?php foreach ($direcciones as $d) : ?>
                        <tr style="border-bottom:1px solid #f0f0f0;">
                            <td style="padding:1rem;font-size:14px;color:#2c3e50;"><?= h($d->descripcion) ?></td>
                            <td style="padding:1rem;vertical-align:middle;">
                                <div style="display:flex;align-items:center;gap:0.75rem;">
                                    <button type="button" class="action-icon" title="Editar" onclick='openEditModal(<?= json_encode($d) ?>)'><i class="fa-solid fa-pen-to-square icon-edit"></i></button>
                                    <?= $this->Form->postLink('<i class="fa-solid fa-trash icon-delete"></i>', ['action' => 'delete', $d->id_direccion_linea], ['confirm' => '¿Está seguro de eliminar esta dirección?', 'class' => 'action-icon', 'escape' => false, 'title' => 'Eliminar']) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="2" style="padding:3rem;text-align:center;color:#95a5a6;font-size:14px;">No hay direcciones disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="pagination-section" style="display:grid;grid-template-columns:1fr auto 1fr;align-items:center;margin-top:1.5rem;padding:0 0.5rem;">
        <div style="display:flex;align-items:center;gap:0.5rem;">
            <span style="color:#666;font-size:14px;line-height:1;">Mostrar:</span>
            <select id="perPageSelect" onchange="changePerPage(this.value)" style="padding:0.5rem 2rem 0.5rem 0.75rem;border:1px solid #ddd;border-radius:4px;font-size:14px;cursor:pointer;background:white url('data:image/svg+xml;charset=UTF-8,%3csvg xmlns=%27http://www.w3.org/2000/svg%27 viewBox=%270 0 16 16%27%3e%3cpath fill=%27none%27 stroke=%27%23343a40%27 stroke-linecap=%27round%27 stroke-linejoin=%27round%27 stroke-width=%272%27 d=%27m2 5 6 6 6-6%27/%3e%3c/svg%3e') no-repeat right 0.5rem center/12px 12px;height:36px;line-height:1;margin-bottom:0;width:auto;">
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

<div class="modal fade" id="addDireccionModal" tabindex="-1" aria-labelledby="addDireccionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $this->Form->create(null, ['url' => ['controller' => 'DireccionesLinea', 'action' => 'add']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="addDireccionLabel">Nueva Dirección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->Form->control('descripcion', ['type' => 'textarea', 'class' => 'form-control', 'label' => 'Descripción', 'placeholder' => 'Ingrese la descripción']) ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<div class="modal fade" id="editDireccionModal" tabindex="-1" aria-labelledby="editDireccionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <?= $this->Form->create(null, ['id' => 'editDireccionForm', 'url' => ['controller' => 'DireccionesLinea', 'action' => 'edit']]) ?>
            <div class="modal-header">
                <h5 class="modal-title" id="editDireccionLabel">Editar Dirección</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?= $this->Form->hidden('id_direccion_linea', ['id' => 'edit-id']) ?>
                <?= $this->Form->control('descripcion', ['type' => 'textarea', 'id' => 'edit-descripcion', 'class' => 'form-control', 'label' => 'Descripción']) ?>
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
        const filterDescripcion = document.getElementById('filterDescripcion');
        let filterTimeout;
        toggleFiltersBtn.addEventListener('click', function() {
            const isVisible = filterRow.style.display !== 'none';
            if (isVisible) {
                window.location.href = '<?= $this->Url->build(['action' => 'index', '?' => ['per_page' => $perPage]]) ?>';
            } else {
                filterRow.style.display = '';
                mainSearchContainer.setAttribute('hidden', '');
                toggleFiltersBtn.innerHTML = '<i class="fa-solid fa-times"></i> CERRAR FILTROS';
                if (filterDescripcion) filterDescripcion.focus();
            }
        });

        function applyFilters() {
            const url = new URL(window.location.href);
            url.searchParams.delete('search');
            if (filterDescripcion.value) url.searchParams.set('filter_descripcion', filterDescripcion.value);
            else url.searchParams.delete('filter_descripcion');
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }
        window.clearFilter = function(inputId) {
            const input = document.getElementById(inputId);
            input.value = '';
            applyFilters();
        };
        [filterDescripcion].forEach(input => {
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

    function openEditModal(dir) {
        const form = document.getElementById('editDireccionForm');
        form.setAttribute('action', "<?= $this->Url->build(['controller' => 'DireccionesLinea', 'action' => 'edit']) ?>/" + dir.id_direccion_linea);
        document.getElementById('edit-id').value = dir.id_direccion_linea;
        document.getElementById('edit-descripcion').value = dir.descripcion || '';
        try {
            new bootstrap.Modal(document.getElementById('editDireccionModal')).show();
        } catch (e) {
            console.error(e);
        }
    }

    function changePerPage(perPage) {
        const url = new URL(window.location.href);
        url.searchParams.set('per_page', perPage);
        url.searchParams.set('page', 1);
        window.location.href = url.toString();
    }
</script>
<?php $this->end(); ?>