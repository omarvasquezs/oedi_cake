<?php
/**
 * Simple sidebar element for the intranet layout.
 * Shows user name, a small accordion and a logout POST link.
 * @var \App\View\AppView $this
 */

$identity = $this->getRequest()->getAttribute('identity');
$sessionUser = $this->getRequest()->getSession()->read('Auth.User');
$displayName = '';
if ($identity) {
    $displayName = $identity->get('name') ?? $identity->get('username') ?? '';
} elseif (!empty($sessionUser)) {
    $displayName = $sessionUser['name'] ?? $sessionUser['username'] ?? '';
}

// Get current controller and action for active state
$currentController = $this->request->getParam('controller');
$currentAction = $this->request->getParam('action');
?>
<div class="sidebar-inner">
    <div class="sidebar-brand mb-4">
        <strong>OEDI</strong>
    </div>

    <div class="sidebar-divider"></div>

    <nav class="sidebar-nav">
        <details <?= (in_array($currentController, ['Dashboard', 'Entidades', 'Contactos', 'TiposReunion', 'Estados', 'Sectores', 'DireccionesLinea', 'EstadosConvenio', 'PrimerAcercamiento', 'Seguimiento', 'Convenios'])) ? 'open' : '' ?>>
            <summary><i class="fa-solid fa-table-list"></i> Matriz</summary>
            <ul>
                <li>
                    <details <?= ($currentController === 'Dashboard') ? 'open' : '' ?>>
                        <summary><i class="fa-solid fa-chart-pie"></i> Dashboard</summary>
                        <ul>
                            <li><?= $this->Html->link('Vista General', ['controller' => 'Dashboard', 'action' => 'index'], ['class' => ($currentController === 'Dashboard' && $currentAction === 'index') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Por Lista', ['controller' => 'Dashboard', 'action' => 'lista'], ['class' => ($currentController === 'Dashboard' && $currentAction === 'lista') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Calendario de Compromisos', ['controller' => 'Dashboard', 'action' => 'calendarioCompromisos'], ['class' => ($currentController === 'Dashboard' && $currentAction === 'calendarioCompromisos') ? 'active' : '']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details <?= (in_array($currentController, ['Entidades', 'Contactos', 'TiposReunion', 'Estados', 'Sectores', 'DireccionesLinea', 'EstadosConvenio'])) ? 'open' : '' ?>>
                        <summary><i class="fa-solid fa-cubes"></i> Items</summary>
                        <ul>
                            <li><?= $this->Html->link('Entidades', ['controller' => 'Entidades', 'action' => 'index'], ['class' => ($currentController === 'Entidades') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Contactos', ['controller' => 'Contactos', 'action' => 'index'], ['class' => ($currentController === 'Contactos') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Tipos de Reunión', ['controller' => 'TiposReunion', 'action' => 'index'], ['class' => ($currentController === 'TiposReunion') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Estados', ['controller' => 'Estados', 'action' => 'index'], ['class' => ($currentController === 'Estados') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Sectores', ['controller' => 'Sectores', 'action' => 'index'], ['class' => ($currentController === 'Sectores') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Direcciones de Línea', ['controller' => 'DireccionesLinea', 'action' => 'index'], ['class' => ($currentController === 'DireccionesLinea') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Estados de Convenio', ['controller' => 'EstadosConvenio', 'action' => 'index'], ['class' => ($currentController === 'EstadosConvenio') ? 'active' : '']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details <?= ($currentController === 'PrimerAcercamiento') ? 'open' : '' ?>>
                        <summary><i class="fa-solid fa-calendar-days"></i> Primer Acercamiento</summary>
                        <ul>
                            <li><?= $this->Html->link('Lista de Primer Acercamiento', ['controller' => 'PrimerAcercamiento', 'action' => 'index'], ['class' => ($currentController === 'PrimerAcercamiento') ? 'active' : '']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details <?= ($currentController === 'Seguimiento') ? 'open' : '' ?>>
                        <summary><i class="fa-solid fa-person-running"></i> Seguimiento</summary>
                        <ul>
                            <li><?= $this->Html->link('Estado de Seguimiento', ['controller' => 'Seguimiento', 'action' => 'estado'], ['class' => ($currentController === 'Seguimiento') ? 'active' : '']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details <?= ($currentController === 'Convenios') ? 'open' : '' ?>>
                        <summary><i class="fa-solid fa-handshake"></i> Convenios</summary>
                        <ul>
                            <li><?= $this->Html->link('Convenios', ['controller' => 'Convenios', 'action' => 'index'], ['class' => ($currentController === 'Convenios' && $currentAction === 'index') ? 'active' : '']) ?></li>
                            <li><?= $this->Html->link('Convenio de Seguimiento', ['controller' => 'Convenios', 'action' => 'seguimiento'], ['class' => ($currentController === 'Convenios' && $currentAction === 'seguimiento') ? 'active' : '']) ?></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </details>

        <details <?= (in_array($currentController, ['Users', 'Settings'])) ? 'open' : '' ?>>
            <summary><i class="fa-solid fa-gear"></i> Configuración</summary>
            <ul>
                <?php if (isset($isSuperAdmin) && $isSuperAdmin): ?>
                <li>
                    <details <?= ($currentController === 'Users' && $currentAction === 'index') ? 'open' : '' ?>>
                        <summary><i class="fa-solid fa-users"></i> Usuarios</summary>
                        <ul>
                            <li><?= $this->Html->link('Gestión de Usuarios', ['controller' => 'Users', 'action' => 'index'], ['class' => ($currentController === 'Users' && $currentAction === 'index') ? 'active' : '']) ?></li>
                        </ul>
                    </details>
                </li>
                <?php endif; ?>
                <li>
                    <details <?= ($currentController === 'Users' && $currentAction === 'profile') ? 'open' : '' ?>>
                        <summary><i class="fa-solid fa-user"></i> Perfil</summary>
                        <ul>
                            <li><?= $this->Html->link('Mi Perfil', ['controller' => 'Users', 'action' => 'profile'], ['class' => ($currentController === 'Users' && $currentAction === 'profile') ? 'active' : '']) ?></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </details>
    </nav>
</div>
