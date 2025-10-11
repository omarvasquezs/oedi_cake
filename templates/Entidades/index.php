<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', $title ?? 'Entidades');
?>

<div class="entidades-index">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0; color: #2c3e50; font-size: 24px; font-weight: 500;">Entidades</h2>
        <button style="background: #3498db; color: white; border: none; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-plus"></i> Nueva Entidad
        </button>
    </div>

    <!-- Search and Filters -->
    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
        <div style="flex: 1; position: relative;">
            <input type="text" placeholder="Buscar entidades..." style="width: 100%; padding: 0.7rem 1rem 0.7rem 2.5rem; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
            <i class="fa-solid fa-search" style="position: absolute; left: 1rem; top: 50%; transform: translateY(-50%); color: #999;"></i>
        </div>
        <button style="background: white; color: #666; border: 1px solid #ddd; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-eye"></i>
        </button>
        <button style="background: white; color: #666; border: 1px solid #ddd; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-filter"></i> Filtros
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
</div>
