<?php
/**
 * Intranet layout used for dashboard and authenticated pages
 * @var \App\View\AppView $this
 */

$identity = $this->getRequest()->getAttribute('identity');
$sessionUser = $this->getRequest()->getSession()->read('Auth.User');
$displayName = '';
if ($identity) {
    $displayName = $identity->get('name') ?? $identity->get('username') ?? 'Usuario';
} elseif (!empty($sessionUser)) {
    $displayName = $sessionUser['name'] ?? $sessionUser['username'] ?? 'Usuario';
}
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $this->fetch('title') ?> - OEDI</title>
    <?= $this->Html->meta('icon') ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <?= $this->Html->css(['normalize.min', 'milligram.min', 'fonts', 'intranet']) ?>
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body class="intranet-body">
    <!-- Layout grid: sidebar + main area -->
    <div class="layout-container">
        <aside class="sidebar" id="sidebar">
            <?= $this->element('sidebar') ?>
        </aside>
        <div class="content-wrapper">
            <!-- Top navigation bar (only in content area) -->
            <nav class="top-bar">
                <div class="top-bar-left">
                    <button class="menu-toggle" id="menuToggle" aria-label="Toggle menu">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                </div>
                <div class="top-bar-right">
                    <div class="user-menu" id="userMenu">
                        <span class="user-icon">👤</span>
                        <span class="user-name"><?= h($displayName) ?></span>
                        <button class="user-dropdown-toggle" aria-label="User menu">▼</button>
                        <div class="user-dropdown" id="userDropdown">
                            <a href="<?= $this->Url->build(['controller' => 'Users', 'action' => 'profile']) ?>" class="dropdown-item">Mi Perfil</a>
                            <a href="<?= $this->Url->build(['controller' => 'Settings', 'action' => 'index']) ?>" class="dropdown-item">Configuración</a>
                            <div class="dropdown-divider"></div>
                            <?= $this->Form->postLink('Cerrar Sesión', ['controller' => 'Users', 'action' => 'logout'], ['class' => 'dropdown-item logout']) ?>
                        </div>
                    </div>
                </div>
            </nav>
            <main class="main-content">
                <?= $this->Flash->render() ?>
                <?= $this->fetch('content') ?>
            </main>
        </div>
    </div>

    <script>
    // Toggle sidebar collapse
    document.getElementById('menuToggle')?.addEventListener('click', function(){
        document.getElementById('sidebar')?.classList.toggle('collapsed');
        document.querySelector('.layout-container')?.classList.toggle('sidebar-collapsed');
    });
    
    // Toggle user dropdown
    const userMenu = document.getElementById('userMenu');
    const userDropdown = document.getElementById('userDropdown');
    
    userMenu?.addEventListener('click', function(e){
        e.stopPropagation();
        userDropdown?.classList.toggle('show');
    });
    
    // Close dropdown when clicking outside
    document.addEventListener('click', function(){
        userDropdown?.classList.remove('show');
    });
    
    // Accordion behavior for main submenus (only one open at a time)
    const mainMatrizDetails = document.querySelector('.sidebar-nav > details');
    if (mainMatrizDetails) {
        const subMenuDetails = mainMatrizDetails.querySelectorAll(':scope > ul > li > details');
        
        subMenuDetails.forEach(detail => {
            detail.addEventListener('toggle', function() {
                if (this.open) {
                    subMenuDetails.forEach(otherDetail => {
                        if (otherDetail !== this && otherDetail.open) {
                            otherDetail.open = false;
                        }
                    });
                }
            });
        });
    }
    
    // Accordion behavior for Configuración submenus
    const allMainDetails = document.querySelectorAll('.sidebar-nav > details');
    allMainDetails.forEach(mainDetail => {
        const subMenuDetails = mainDetail.querySelectorAll(':scope > ul > li > details');
        
        subMenuDetails.forEach(detail => {
            detail.addEventListener('toggle', function() {
                if (this.open) {
                    subMenuDetails.forEach(otherDetail => {
                        if (otherDetail !== this && otherDetail.open) {
                            otherDetail.open = false;
                        }
                    });
                }
            });
        });
    });
    </script>
</body>
</html>
