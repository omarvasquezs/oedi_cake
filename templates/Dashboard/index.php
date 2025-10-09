<?php
/**
 * Dashboard index
 * @var \App\View\AppView $this
 */

$this->assign('title', 'Dashboard');
?>
<div class="dashboard">
    <h2>Dashboard por Departamentos</h2>
    <p class="muted">Última actualización: <?= date('j \d\e F, Y, H:i') ?></p>

    <div class="panels">
        <div class="panel">Total de Municipalidades<br><strong>0</strong></div>
        <div class="panel">Municipalidades Contactadas<br><strong>0</strong></div>
        <div class="panel">Porcentaje de Avance<br><strong>0.00%</strong></div>
    </div>

    <div class="widgets">
        <div class="widget map">[Mapa placeholder]</div>
        <div class="widget chart">[Gráfico placeholder]</div>
    </div>
</div>
