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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <div id="flash-messages-container">
                    <?= $this->Flash->render() ?>
                </div>
                <?= $this->fetch('content') ?>
            </main>
        </div>
    </div>

    <style>
        /* Flash Messages Styling */
        #flash-messages-container {
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 9999;
            max-width: 400px;
        }

        .message {
            padding: 1rem 1.25rem;
            margin-bottom: 0.75rem;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            animation: slideInRight 0.3s ease-out;
            position: relative;
        }

        @keyframes slideInRight {
            from {
                transform: translateX(100%);
                opacity: 0;
            }
            to {
                transform: translateX(0);
                opacity: 1;
            }
        }

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }
            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        .message.hiding {
            animation: slideOutRight 0.3s ease-out forwards;
        }

        .message.success {
            background: #10b981;
            color: white;
            border-left: 4px solid #059669;
        }

        .message.error {
            background: #ef4444;
            color: white;
            border-left: 4px solid #dc2626;
        }

        .message.info {
            background: #3b82f6;
            color: white;
            border-left: 4px solid #2563eb;
        }

        .message.warning {
            background: #f59e0b;
            color: white;
            border-left: 4px solid #d97706;
        }

        .message-content {
            flex: 1;
            font-size: 14px;
            font-weight: 500;
        }

        .message-close {
            background: transparent;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0;
            margin-left: 1rem;
            line-height: 1;
            opacity: 0.8;
            transition: opacity 0.2s;
        }

        .message-close:hover {
            opacity: 1;
        }
    </style>

    <script>
        // Auto-dismiss flash messages after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const messages = document.querySelectorAll('.message');
            messages.forEach(function(msg) {
                // Add close button
                const closeBtn = document.createElement('button');
                closeBtn.className = 'message-close';
                closeBtn.innerHTML = '&times;';
                closeBtn.setAttribute('aria-label', 'Close');
                closeBtn.onclick = function() {
                    msg.classList.add('hiding');
                    setTimeout(() => msg.remove(), 300);
                };
                
                const content = msg.textContent;
                msg.innerHTML = '<span class="message-content">' + content + '</span>';
                msg.appendChild(closeBtn);

                // Auto dismiss after 5 seconds
                setTimeout(function() {
                    if (msg.parentElement) {
                        msg.classList.add('hiding');
                        setTimeout(() => msg.remove(), 300);
                    }
                }, 5000);
            });
        });

        // Toggle sidebar collapse
        document.getElementById('menuToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar')?.classList.toggle('collapsed');
            document.querySelector('.layout-container')?.classList.toggle('sidebar-collapsed');
        });

        // Toggle user dropdown
        const userMenu = document.getElementById('userMenu');
        const userDropdown = document.getElementById('userDropdown');

        userMenu?.addEventListener('click', function(e) {
            e.stopPropagation();
            userDropdown?.classList.toggle('show');
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function() {
            userDropdown?.classList.remove('show');
        });

        // Accordion behavior for main sections (Matriz and Configuración)
        // When one main section opens, close the other
        const mainSections = document.querySelectorAll('.sidebar-nav > details');
        mainSections.forEach(section => {
            section.addEventListener('toggle', function() {
                if (this.open) {
                    mainSections.forEach(otherSection => {
                        if (otherSection !== this && otherSection.open) {
                            otherSection.open = false;
                        }
                    });
                }
            });
        });

        // Accordion behavior for submenus within Matriz
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

        // Accordion behavior for submenus within Configuración
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>