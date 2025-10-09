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
?>
<div class="sidebar-inner">
    <div class="sidebar-brand mb-4">
        <strong>OEDI</strong>
    </div>

    <div class="sidebar-divider"></div>

    <nav class="sidebar-nav">
        <details open>
            <summary><i class="fa-solid fa-table-list"></i> Matriz</summary>
            <ul>
                <li>
                    <details>
                        <summary><i class="fa-solid fa-chart-pie"></i> Dashboard</summary>
                        <ul>
                            <li><?= $this->Html->link('Vista General', ['controller' => 'Dashboard', 'action' => 'general']) ?></li>
                            <li><?= $this->Html->link('Por Lista', ['controller' => 'Dashboard', 'action' => 'lista']) ?></li>
                            <li><?= $this->Html->link('Calendario de Compromisos', ['controller' => 'Dashboard', 'action' => 'calendario']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><i class="fa-solid fa-cubes"></i> Items</summary>
                        <ul>
                            <li><?= $this->Html->link('Entidades', ['controller' => 'Entidades', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Contactos', ['controller' => 'Contactos', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Tipos de Reunión', ['controller' => 'TiposReunion', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Estados', ['controller' => 'Estados', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Sectores', ['controller' => 'Sectores', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Direcciones de Línea', ['controller' => 'DireccionesLinea', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Estados de Convenio', ['controller' => 'EstadosConvenio', 'action' => 'index']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><i class="fa-solid fa-calendar-days"></i> Primer Acercamiento</summary>
                        <ul>
                            <li><?= $this->Html->link('Lista de Primer Acercamiento', ['controller' => 'PrimerAcercamiento', 'action' => 'index']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><i class="fa-solid fa-person-running"></i> Seguimiento</summary>
                        <ul>
                            <li><?= $this->Html->link('Estado de Seguimiento', ['controller' => 'Seguimiento', 'action' => 'estado']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><i class="fa-solid fa-handshake"></i> Convenios</summary>
                        <ul>
                            <li><?= $this->Html->link('Convenios', ['controller' => 'Convenios', 'action' => 'index']) ?></li>
                            <li><?= $this->Html->link('Convenio de Seguimiento', ['controller' => 'Convenios', 'action' => 'seguimiento']) ?></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </details>

        <details>
            <summary><i class="fa-solid fa-gear"></i> Configuración</summary>
            <ul>
                <li>
                    <details>
                        <summary><i class="fa-solid fa-users"></i> Usuarios</summary>
                        <ul>
                            <li><?= $this->Html->link('Gestión de Usuarios', ['controller' => 'Users', 'action' => 'index']) ?></li>
                        </ul>
                    </details>
                </li>
                <li>
                    <details>
                        <summary><i class="fa-solid fa-user"></i> Perfil</summary>
                        <ul>
                            <li><?= $this->Html->link('Mi Perfil', ['controller' => 'Users', 'action' => 'profile']) ?></li>
                        </ul>
                    </details>
                </li>
            </ul>
        </details>
    </nav>
</div>
