<?php
/**
 * @var \App\View\AppView $this
 */
$this->assign('title', $title ?? 'Dashboard Lista de Entidades');
?>

<div class="dashboard-lista">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <div>
            <h2 style="margin: 0; color: #2c3e50; font-size: 24px; font-weight: 500;">Dashboard Lista de Entidades</h2>
        </div>
        <div style="display: flex; gap: 1rem;">
            <span style="color: #3498db; cursor: pointer; font-size: 14px;">
                <i class="fa-solid fa-circle-info"></i> 0 entidades
            </span>
            <button style="background: #e74c3c; color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; cursor: pointer; font-size: 14px;">
                <i class="fa-solid fa-file-pdf"></i> Imprimir PDF
            </button>
            <button style="background: #27ae60; color: white; border: none; padding: 0.6rem 1.2rem; border-radius: 4px; cursor: pointer; font-size: 14px;">
                <i class="fa-solid fa-file-excel"></i> Exportar Excel
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
        <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid #e0e0e0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.5rem;">Total Entidades</div>
                    <div style="font-size: 28px; font-weight: 600; color: #2c3e50;">0</div>
                </div>
                <div style="width: 40px; height: 40px; background: #ecf0f1; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-eye" style="color: #3498db; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid #e0e0e0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.5rem;">Total Primer Acercamiento</div>
                    <div style="font-size: 28px; font-weight: 600; color: #2c3e50;">0</div>
                </div>
                <div style="width: 40px; height: 40px; background: #d5f4e6; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-eye" style="color: #27ae60; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid #e0e0e0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.5rem;">Total Seguimientos</div>
                    <div style="font-size: 28px; font-weight: 600; color: #2c3e50;">0/0</div>
                    <div style="font-size: 11px; color: #95a5a6; margin-top: 0.25rem;">Municipalidades con al menos un seguimiento / Total de seguimientos</div>
                </div>
                <div style="width: 40px; height: 40px; background: #e8daef; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-eye" style="color: #9b59b6; font-size: 18px;"></i>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid #e0e0e0; box-shadow: 0 1px 3px rgba(0,0,0,0.08);">
            <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                <div>
                    <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.5rem;">Total Convenios</div>
                    <div style="font-size: 28px; font-weight: 600; color: #2c3e50;">0</div>
                </div>
                <div style="width: 40px; height: 40px; background: #fff3cd; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                    <i class="fa-solid fa-eye" style="color: #f39c12; font-size: 18px;"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div style="background: white; padding: 1.5rem; border-radius: 8px; border: 1px solid #e0e0e0; margin-bottom: 1.5rem;">
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; align-items: end;">
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-size: 13px; color: #555;">
                    <i class="fa-solid fa-filter"></i> Todos los departamentos
                </label>
                <select style="width: 100%; padding: 0.6rem; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    <option>Todos los departamentos</option>
                </select>
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-size: 13px; color: #555;">
                    <i class="fa-solid fa-filter"></i> Todas las provincias
                </label>
                <select style="width: 100%; padding: 0.6rem; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
                    <option>Todas las provincias</option>
                </select>
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-size: 13px; color: #555;">
                    <i class="fa-solid fa-calendar"></i> Fecha desde
                </label>
                <input type="date" style="width: 100%; padding: 0.6rem; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
            </div>
            <div>
                <label style="display: block; margin-bottom: 0.5rem; font-size: 13px; color: #555;">
                    a
                </label>
                <input type="date" style="width: 100%; padding: 0.6rem; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
            </div>
        </div>
        <div style="margin-top: 1rem; font-size: 12px; color: #7f8c8d;">
            Última actualización: <?= date('d/m/Y, H:i:s') ?> PM
        </div>
    </div>

    <!-- Search -->
    <div style="margin-bottom: 1.5rem;">
        <input type="text" placeholder="🔍 Buscar entidad..." style="width: 100%; padding: 0.8rem 1rem; border: 1px solid #ddd; border-radius: 4px; font-size: 14px;">
    </div>

    <!-- Empty State -->
    <div style="background: white; padding: 3rem; border-radius: 8px; border: 1px solid #e0e0e0; text-align: center;">
        <p style="color: #95a5a6; font-size: 16px; margin: 0;">No hay entidades con interacciones registradas.</p>
    </div>
</div>
