<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', $title ?? 'Entidades');
?>

<style>
    /* Utilities: inputs with icons inside (copied from Users layout) */
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
        padding-left: 2.75rem; /* leave space for icon */
    }

    .search-input { margin-bottom: 0; }

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

    .input-with-icon .input-clear:hover { background-color: #f3f4f6; color: #666; }

    .input-with-icon .input-clear:visited { color: #999 !important; background: transparent !important; }

    .input-with-icon .input-clear:focus, .input-with-icon .input-clear:active { outline: none !important; box-shadow: none !important; }

    /* Table stretch like Users page */
    .entidades-index { display:flex; flex-direction:column; min-height:100vh; }
    .entidades-index .table-wrapper { flex:1 1 auto; min-height:40vh; }
    .pagination-section { margin-top: auto; }
</style>

<div class="entidades-index">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0; color: #2c3e50; font-size: 24px; font-weight: 500;">Entidades</h2>
        <button style="background: #3498db; color: white; border: none; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-plus"></i> Nueva Entidad
        </button>
    </div>

    <!-- Search and Filters -->
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
        <div style="flex: 1;" id="mainSearchContainer">
            <form method="get" action="<?= $this->Url->build(['controller' =>'Entidades','action' => 'index']) ?>" id="searchForm" class="input-with-icon">
                <span class="input-icon"><i class="fa-solid fa-search"></i></span>
                <input type="text" name="search" id="searchInput" value="<?= h($search ?? '') ?>" placeholder="Buscar entidades..." class="search-input form-control" style="border:1px solid #ddd; border-radius:4px; font-size:14px; background: white; color: #2c3e50;">
                <?php if (!empty($search)): ?>
                    <a href="<?= $this->Url->build(['controller' => 'Entidades', 'action' => 'index']) ?>" id="clearSearch" class="input-clear" title="Limpiar búsqueda">
                        <i class="fa-solid fa-times"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>
        <button style="background: white; color: #666; border: 1px solid #ddd; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-filter"></i> Filtros
        </button>
    </div>

    <!-- Table -->
    <div class="table-wrapper" style="background: white; border-radius: 8px; border: 1px solid #e0e0e0; overflow: hidden;">
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background: #f8f9fa; border-bottom: 2px solid #e0e0e0;">
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">
                        NOMBRE <i class="fa-solid fa-sort" style="font-size: 11px; margin-left: 0.25rem;"></i>
                    </th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">DEPARTAMENTO</th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">PROVINCIA</th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">DISTRITO</th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">NIVEL</th>
                    <th style="padding: 1rem; text-align: left; font-size: 13px; color: #666; font-weight: 600; text-transform: uppercase;">ACCIONES</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="6" style="padding: 3rem; text-align: center; color: #95a5a6; font-size: 14px;">
                        No hay entidades disponibles
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="pagination-section" style="display:grid; grid-template-columns:1fr auto 1fr; align-items:center; margin-top:1.5rem; padding:0 0.5rem;">
        <!-- pagination placeholder (if using Paginator helper, render here) -->
    </div>
</div>
