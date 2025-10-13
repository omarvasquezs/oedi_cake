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
        padding-left: 2.75rem;
        /* leave space for icon */
    }

    .search-input {
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

    .input-with-icon .input-clear:visited {
        color: #999 !important;
        background: transparent !important;
    }

    .input-with-icon .input-clear:focus,
    .input-with-icon .input-clear:active {
        outline: none !important;
        box-shadow: none !important;
    }

    /* Table stretch like Users page */
    .entidades-index {
        display: flex;
        flex-direction: column;
        min-height: 100vh;
    }

    .entidades-index .table-wrapper {
        flex: 1 1 auto;
        min-height: 40vh;
    }

    .pagination-section {
        margin-top: auto;
    }

    /* Modal specific typography overrides for Entidades */
    #nuevaEntidadModal .modal-content .form-control,
    #nuevaEntidadModal .modal-content .form-select,
    #editarEntidadModal .modal-content .form-control,
    #editarEntidadModal .modal-content .form-select {
        font-size: 16px;
    }

    #nuevaEntidadModal .modal-content .modal-footer .btn,
    #nuevaEntidadModal .modal-content .btn,
    #editarEntidadModal .modal-content .modal-footer .btn,
    #editarEntidadModal .modal-content .btn {
        font-size: 16px;
    }

    /* Labels slightly smaller than inputs */
    #nuevaEntidadModal .modal-content label,
    #nuevaEntidadModal .modal-content .form-label {
        font-size: 14px;
    }

    /* --- ESTILOS DE ACCIONES (CON CORRECCIÓN DE MARGEN) --- */
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
        /* <-- ESTA ES LA LÍNEA QUE SE AÑADIÓ */
    }

    .action-icon:hover {
        background-color: #f8f9fa;
    }

    .action-icon i {
        font-size: 15px;
        line-height: 1;
    }

    /* Colores específicos de los íconos de la imagen de referencia */
    .icon-view {
        color: #80868b;
    }

    .icon-edit {
        color: #4285F4;
    }

    .icon-delete {
        color: #DB4437;
    }

    /* Asegura que los botones <button> se vean bien */
    button.action-icon {
        cursor: pointer;
        box-shadow: none !important;
        outline: none !important;
    }

    /* View modal styling: black X and spacing to match image 2 */
    #verEntidadModal .btn-close-dark {
        background: #ffffff;
        /* white background so a black X is visible */
        color: #111317;
        /* icon color */
        width: 44px;
        height: 44px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 1px solid rgba(0, 0, 0, 0.08);
        margin-left: 8px;
    }

    #verEntidadModal .btn-close-dark i {
        color: #111317;
    }

    /* Normalize label/value rows so they align across columns */
    #verEntidadModal dt,
    #verEntidadModal dd {
        margin: 0;
        padding: 0.75rem 0;
        /* consistent vertical spacing (increased) */
        font-size: 16px;
        line-height: 1.4;
    }

    #verEntidadModal dt {
        font-weight: 600;
        color: #5b6167;
        padding-right: 0.75rem;
        text-align: left;
    }

    #verEntidadModal dd {
        color: #2c3e50;
        text-align: left;
    }

    /* Remove left padding that Bootstrap's grid may add inside dl columns */
    #verEntidadModal .container-fluid .row .col-md-6 dl.row dt.col-5,
    #verEntidadModal .container-fluid .row .col-md-6 dl.row dd.col-7 {
        padding-left: 0;
    }

    #verEntidadModal .modal-header {
        padding: 1rem 1.25rem;
    }

    #verEntidadModal .modal-body {
        padding-top: 0.5rem;
        padding-left: 1.25rem;
        padding-right: 1.25rem;
        font-size: 16px;
    }

    /* Footer Close button larger font */
    #verEntidadModal .modal-footer .btn {
        font-size: 16px;
        padding: 0.5rem 0.9rem;
    }
</style>

<div class="entidades-index">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
        <h2 style="margin: 0; color: #2c3e50; font-size: 24px; font-weight: 500;">Entidades</h2>
        <button id="openNuevaEntidad" type="button" data-bs-toggle="modal" data-bs-target="#nuevaEntidadModal" style="background: #3498db; color: white; border: none; padding: 0.7rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 0.5rem;">
            <i class="fa-solid fa-plus"></i> Nueva Entidad
        </button>
    </div>

    <div class="modal fade" id="nuevaEntidadModal" tabindex="-1" aria-labelledby="modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal-title">Nueva Entidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <?= $this->Form->create($newMunicipalidad ?? null, ['url' => ['action' => 'addMunicipalidad']]) ?>
                <div class="modal-body">
                    <div class="px-2 py-2">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('nombre', ['label' => 'Nombre', 'class' => 'form-control', 'placeholder' => 'Ingrese nombre'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('region', ['label' => 'Región', 'class' => 'form-control', 'placeholder' => 'Ingrese región'])
                                ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('departamento', ['type' => 'select', 'options' => ['' => 'Seleccione Departamento', 'Amazonas' => 'Amazonas', 'Ancash' => 'Ancash', 'Apurimac' => 'Apurimac', 'Arequipa' => 'Arequipa', 'Ayacucho' => 'Ayacucho', 'Cajamarca' => 'Cajamarca', 'Callao' => 'Callao', 'Cusco' => 'Cusco', 'Huancavelica' => 'Huancavelica', 'Huanuco' => 'Huanuco', 'Ica' => 'Ica', 'Junin' => 'Junin', 'La Libertad' => 'La Libertad', 'Lambayeque' => 'Lambayeque', 'Lima' => 'Lima', 'Lima Región' => 'Lima Región', 'Loreto' => 'Loreto', 'Madre De Dios' => 'Madre De Dios', 'Moquegua' => 'Moquegua', 'Pasco' => 'Pasco', 'Piura' => 'Piura', 'Puno' => 'Puno', 'San Martin' => 'San Martin', 'Tacna' => 'Tacna', 'Tumbes' => 'Tumbes', 'Ucayali' => 'Ucayali'], 'class' => 'form-select'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('provincia', ['label' => 'Provincia', 'class' => 'form-control', 'placeholder' => 'Ingrese provincia'])
                                ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('distrito', ['label' => 'Distrito', 'class' => 'form-control', 'placeholder' => 'Ingrese distrito'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('ubigeo', ['label' => 'Ubigeo', 'class' => 'form-control', 'placeholder' => 'Ingrese ubigeo', 'maxlength' => 10, 'pattern' => '\d+', 'inputmode' => 'numeric', 'type' => 'number'])
                                ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('nivel', ['type' => 'select', 'options' => ['' => 'Seleccione Nivel', 'Gobierno Local' => 'Gobierno Local', 'Gobierno Regional' => 'Gobierno Regional', 'Gobierno Provincial' => 'Gobierno Provincial', 'Asociación' => 'Asociación', 'Otro' => 'Otro'], 'class' => 'form-select'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('region_natural', ['type' => 'select', 'options' => ['' => 'Seleccione Subnivel', 'Regional' => 'Regional', 'Provincial' => 'Provincial', 'Distrital' => 'Distrital', 'Local' => 'Local', 'Mancomunidad' => 'Mancomunidad', 'Otros' => 'Otros'], 'class' => 'form-select'])
                                ?>
                            </div>

                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('RUC', ['label' => 'RUC', 'class' => 'form-control', 'placeholder' => 'Ingrese ruc', 'maxlength' => 11, 'pattern' => '\d+', 'inputmode' => 'numeric', 'type' => 'number'])
                                ?>
                            </div>

                            <div class="col-md-6 mb-3"></div>

                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('X', ['label' => 'Coordenada X', 'type' => 'number', 'step' => '0.000001', 'class' => 'form-control', 'placeholder' => 'Ingrese coordenada x'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('Y', ['label' => 'Coordenada Y', 'type' => 'number', 'step' => '0.000001', 'class' => 'form-control', 'placeholder' => 'Ingrese coordenada y'])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <?= $this->Form->button(__('Guardar'), ['class' => 'btn btn-primary'])
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>


    <div style="display: flex; gap: 1rem; margin-bottom: 1.5rem;">
        <div style="flex: 1;" id="mainSearchContainer">
            <form method="get" action="<?= $this->Url->build(['controller' => 'Entidades', 'action' => 'index']) ?>" id="searchForm" class="input-with-icon">
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

    <div class="modal fade" id="editarEntidadModal" tabindex="-1" aria-labelledby="editar-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editar-modal-title">Editar Entidad</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>

                <?= $this->Form->create($editMunicipalidad ?? null, ['url' => ['action' => 'editMunicipalidad']]) ?>
                <div class="modal-body">
                    <div class="px-2 py-2">
                        <div class="row">
                            <?= $this->Form->hidden('id_municipalidad') ?>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('nombre', ['label' => 'Nombre', 'class' => 'form-control'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('region', ['label' => 'Región', 'class' => 'form-control'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('departamento', [
                                    'type' => 'select',
                                    'options' => ['' => 'Seleccione Departamento', 'Amazonas' => 'Amazonas', 'Ancash' => 'Ancash', 'Apurimac' => 'Apurimac', 'Arequipa' => 'Arequipa', 'Ayacucho' => 'Ayacucho', 'Cajamarca' => 'Cajamarca', 'Callao' => 'Callao', 'Cusco' => 'Cusco', 'Huancavelica' => 'Huancavelica', 'Huanuco' => 'Huanuco', 'Ica' => 'Ica', 'Junin' => 'Junin', 'La Libertad' => 'La Libertad', 'Lambayeque' => 'Lambayeque', 'Lima' => 'Lima', 'Lima Región' => 'Lima Región', 'Loreto' => 'Loreto', 'Madre De Dios' => 'Madre De Dios', 'Moquegua' => 'Moquegua', 'Pasco' => 'Pasco', 'Piura' => 'Piura', 'Puno' => 'Puno', 'San Martin' => 'San Martin', 'Tacna' => 'Tacna', 'Tumbes' => 'Tumbes', 'Ucayali' => 'Ucayali'],
                                    'class' => 'form-select'
                                ])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('provincia', ['class' => 'form-control'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('distrito', ['class' => 'form-control'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('ubigeo', ['class' => 'form-control', 'type' => 'number'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('nivel', ['type' => 'select', 'options' => ['' => 'Seleccione Nivel', 'Gobierno Local' => 'Gobierno Local', 'Gobierno Regional' => 'Gobierno Regional', 'Gobierno Provincial' => 'Gobierno Provincial', 'Asociación' => 'Asociación', 'Otro' => 'Otro'], 'class' => 'form-select'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('region_natural', ['type' => 'select', 'options' => ['' => 'Seleccione Subnivel', 'Regional' => 'Regional', 'Provincial' => 'Provincial', 'Distrital' => 'Distrital', 'Local' => 'Local', 'Mancomunidad' => 'Mancomunidad', 'Otros' => 'Otros'], 'class' => 'form-select'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('RUC', ['class' => 'form-control', 'type' => 'number'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3"></div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('X', ['type' => 'number', 'step' => '0.000001', 'class' => 'form-control'])
                                ?>
                            </div>
                            <div class="col-md-6 mb-3">
                                <?= $this->Form->control('Y', ['type' => 'number', 'step' => '0.000001', 'class' => 'form-control'])
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <?= $this->Form->button(__('Actualizar'), ['class' => 'btn btn-primary'])
                    ?>
                </div>
                <?= $this->Form->end() ?>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="verEntidadModal" tabindex="-1" aria-labelledby="ver-modal-title" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="ver-modal-title">Detalles de la Entidad</h5>
                    <button type="button" class="btn-close-dark" data-bs-dismiss="modal" aria-label="Cerrar">
                        <i class="fa-solid fa-xmark" style="font-size:14px;"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="view-entidad-details" class="container-fluid">
                        <!-- Details will be populated by JavaScript -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

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
                <?php if (!empty($municipalidades) && count($municipalidades) > 0): ?>
                    <?php foreach ($municipalidades as $m): ?>
                        <tr style="border-bottom: 1px solid #f0f0f0;">
                            <td style="padding: 1rem; font-size: 14px; color: #2c3e50;"><?= h($m->nombre) ?></td>
                            <td style="padding: 1rem; font-size: 14px; color: #555;"><?= h($m->departamento) ?></td>
                            <td style="padding: 1rem; font-size: 14px; color: #555;"><?= h($m->provincia) ?></td>
                            <td style="padding: 1rem; font-size: 14px; color: #555;"><?= h($m->distrito) ?></td>
                            <td style="padding: 1rem; font-size: 14px; color: #555;"><?= h($m->nivel) ?></td>

                            <td style="padding: 1rem; vertical-align: middle;">
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <button type="button" class="action-icon" title="Ver" data-row='<?= json_encode([
                                                                                                        'id' => $m->id_municipalidad,
                                                                                                        'ubigeo' => $m->ubigeo,
                                                                                                        'nombre' => $m->nombre,
                                                                                                        'departamento' => $m->departamento,
                                                                                                        'provincia' => $m->provincia,
                                                                                                        'distrito' => $m->distrito,
                                                                                                        'region' => $m->region,
                                                                                                        'nivel' => $m->nivel,
                                                                                                        'region_natural' => $m->region_natural,
                                                                                                        'X' => $m->X,
                                                                                                        'Y' => $m->Y,
                                                                                                        'RUC' => $m->RUC
                                                                                                    ]) ?>' onclick="openViewModal(this)">
                                        <i class="fa-solid fa-eye icon-view"></i>
                                    </button>

                                    <button type="button" class="action-icon" title="Editar" data-id="<?= $m->id_municipalidad ?>" data-row='<?= json_encode([
                                                                                                                                                    'id' => $m->id_municipalidad,
                                                                                                                                                    'ubigeo' => $m->ubigeo,
                                                                                                                                                    'nombre' => $m->nombre,
                                                                                                                                                    'departamento' => $m->departamento,
                                                                                                                                                    'provincia' => $m->provincia,
                                                                                                                                                    'distrito' => $m->distrito,
                                                                                                                                                    'region' => $m->region,
                                                                                                                                                    'nivel' => $m->nivel,
                                                                                                                                                    'region_natural' => $m->region_natural,
                                                                                                                                                    'X' => $m->X,
                                                                                                                                                    'Y' => $m->Y,
                                                                                                                                                    'RUC' => $m->RUC
                                                                                                                                                ]) ?>' onclick="openEditModal(this)">
                                        <i class="fa-solid fa-pen-to-square icon-edit"></i>
                                    </button>

                                    <?= $this->Form->postLink(
                                        '<i class="fa-solid fa-trash icon-delete"></i>', // El ícono es el contenido del enlace
                                        ['action' => 'deleteMunicipalidad', $m->id_municipalidad], // URL
                                        [
                                            'confirm' => '¿Está seguro de que desea eliminar esta entidad?',
                                            'class' => 'action-icon', // Nuestra nueva clase CSS
                                            'title' => 'Eliminar',
                                            'escape' => false // Permite que se renderice la etiqueta <i>
                                        ]
                                    ) ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="padding: 3rem; text-align: center; color: #95a5a6; font-size: 14px;">No hay entidades disponibles</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="pagination-section" style="display:grid; grid-template-columns:1fr auto 1fr; align-items:center; margin-top:1.5rem; padding:0 0.5rem;">
    </div>
</div>

<?php $this->start('script'); ?>
<script>
    window.openViewModal = function(btn) {
        if (!btn) return;
        var data = btn.getAttribute('data-row');
        if (!data) return;
        try {
            var obj = JSON.parse(data);
        } catch (e) {
            console.error('Failed to parse row data for view modal', e);
            return;
        }

        var modalEl = document.getElementById('verEntidadModal');
        if (!modalEl) return;

        var detailsContainer = modalEl.querySelector('#view-entidad-details');
        if (!detailsContainer) return;

        // Two-column layout: left and right columns of label/value pairs
        detailsContainer.innerHTML = `
            <div class="row">
                <div class="col-md-6">
                    <dl class="row mb-0">
                        <dt class="col-5 py-4">Nombre</dt>
                        <dd class="col-7 py-4">${obj.nombre || 'N/A'}</dd>

                        <dt class="col-5 py-4">Región</dt>
                        <dd class="col-7 py-4">${obj.region || 'N/A'}</dd>

                        <dt class="col-5 py-4">Subnivel</dt>
                        <dd class="col-7 py-4">${obj.region_natural || 'N/A'}</dd>

                        <dt class="col-5 py-4">Departamento</dt>
                        <dd class="col-7 py-4">${obj.departamento || 'N/A'}</dd>
                    </dl>
                </div>
                <div class="col-md-6">
                    <dl class="row mb-0">
                        <dt class="col-5 py-4">Provincia</dt>
                        <dd class="col-7 py-4">${obj.provincia || 'N/A'}</dd>

                        <dt class="col-5 py-4">Distrito</dt>
                        <dd class="col-7 py-4">${obj.distrito || 'N/A'}</dd>

                        <dt class="col-5 py-4">Ubigeo</dt>
                        <dd class="col-7 py-4">${obj.ubigeo || 'N/A'}</dd>

                        <dt class="col-5 py-4">Nivel</dt>
                        <dd class="col-7 py-4">${obj.nivel || 'N/A'}</dd>

                        <dt class="col-5 py-4">RUC</dt>
                        <dd class="col-7 py-4">${obj.RUC || 'N/A'}</dd>
                    </dl>
                </div>
            </div>
            <hr />
            <div class="row mt-2">
                <div class="col-12">
                    <dl class="row mb-0">
                        <dt class="col-3">Coordenadas</dt>
                        <dd class="col-9">X: ${obj.X || 'N/A'} — Y: ${obj.Y || 'N/A'}</dd>
                    </dl>
                </div>
            </div>
        `;

        try {
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        } catch (e) {
            console.error('Bootstrap modal show failed', e);
        }
    };

    // Expose a global function to populate and open the Edit modal when an Edit button is clicked.
    window.openEditModal = function(btn) {
        if (!btn) return;
        var data = btn.getAttribute('data-row');
        if (!data) return;
        try {
            var obj = JSON.parse(data);
        } catch (e) {
            console.error('Failed to parse row data for edit modal', e);
            return;
        }

        var modalEl = document.getElementById('editarEntidadModal');
        if (!modalEl) return;

        // Helper to set form input/select values by name inside the modal
        function setField(name, value) {
            var field = modalEl.querySelector('[name="' + name + '"]');
            if (!field) return;
            // For select elements ensure option exists; otherwise set blank
            field.value = (value === null || typeof value === 'undefined') ? '' : value;
            // Trigger input event so any listeners update
            try {
                field.dispatchEvent(new Event('input', {
                    bubbles: true
                }));
            } catch (e) {
                /* noop */
            }
        }

        setField('id_municipalidad', obj.id || obj.id_municipalidad || btn.getAttribute('data-id'));
        setField('ubigeo', obj.ubigeo || '');
        setField('nombre', obj.nombre || '');
        setField('departamento', obj.departamento || '');
        setField('provincia', obj.provincia || '');
        setField('distrito', obj.distrito || '');
        setField('region', obj.region || '');
        setField('nivel', obj.nivel || '');
        setField('region_natural', obj.region_natural || '');
        setField('X', obj.X || '');
        setField('Y', obj.Y || '');
        setField('RUC', obj.RUC || '');

        // Show modal using Bootstrap's modal API
        try {
            var modal = new bootstrap.Modal(modalEl);
            modal.show();
        } catch (e) {
            console.error('Bootstrap modal show failed', e);
        }
    };

    document.addEventListener('DOMContentLoaded', function() {
        // If server requested reopening the New modal (validation errors), show it using Bootstrap modal API
        <?php if (!empty($openNuevaEntidadModal)): ?>
            var myModal = new bootstrap.Modal(document.getElementById('nuevaEntidadModal'));
            myModal.show();
        <?php endif; ?>

        // If server requested reopening the Edit modal (validation errors), show it using Bootstrap modal API
        <?php if (!empty($openEditarEntidadModal)): ?>
            var editModal = new bootstrap.Modal(document.getElementById('editarEntidadModal'));
            editModal.show();
        <?php endif; ?>
    });
</script>
<?= $this->Html->script('intranet.js') ?>
<?php $this->end(); ?>