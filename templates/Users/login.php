<?php
/**
 * Login template
 * @var \App\View\AppView $this
 */

// Use a clean layout without CakePHP default styles
$this->setLayout('login');
$this->assign('title', 'Iniciar Sesión');

?>
<div class="login-bg d-flex justify-content-center align-items-center">
    <div class="card login-card shadow">
        <div class="card-body px-4 py-5 text-center">
            <div class="icon-wrap mx-auto mb-3">
                <div class="icon-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-lock-fill icon-lock"></i>
                </div>
            </div>
            <h3 class="mb-4">Iniciar Sesión</h3>

            <?= $this->Flash->render() ?>
            <?= $this->Form->create(null, ['url' => ['action' => 'login']]) ?>
            <div class="mb-3 text-start">
                <?= $this->Form->control('username', [
                    // Keep an accessible label but hide it visually so placeholders aren't duplicated
                    'label' => ['text' => 'Nombre de Usuario *', 'class' => 'visually-hidden'],
                    'class' => 'form-control',
                    'placeholder' => 'Nombre de Usuario *',
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
            </div>
            <div class="mb-3 text-start">
                <?= $this->Form->control('password', [
                    // Keep an accessible label but hide it visually so placeholders aren't duplicated
                    'label' => ['text' => 'Contraseña *', 'class' => 'visually-hidden'],
                    'type' => 'password',
                    'class' => 'form-control',
                    'placeholder' => 'Contraseña *',
                    'templates' => ['inputContainer' => '{{content}}']
                ]) ?>
            </div>

            <div class="d-grid mb-2">
                <button class="btn btn-primary btn-block">INICIAR SESIÓN</button>
            </div>
            <?= $this->Form->end() ?>

            <div class="text-center mt-3">
                <?= $this->Html->link('¿No tienes una cuenta? Regístrate', ['action' => 'register'], [
                    'class' => 'text-muted small'
                ]) ?>
            </div>
        </div>
    </div>
</div>

        <script>
        document.addEventListener('DOMContentLoaded', function(){
            const msgs = document.querySelectorAll('.login-card .message');
            msgs.forEach(function(m, i){
                setTimeout(function(){ m.classList.add('show'); }, 50 + i*80);
                // Do not auto-dismiss error messages, they require user attention
                if (m.classList.contains('error')) return;
                // Auto dismiss after 4s, then collapse and remove node after transition
                setTimeout(function(){
                    m.classList.remove('show');
                    m.classList.add('hiding');
                    // remove node after transition (300ms safe margin)
                    setTimeout(function(){ m.remove(); }, 520);
                }, 4050 + i*200);
            });
            // Close button handler
            document.querySelectorAll('.login-card .message .message-close').forEach(function(btn){
                btn.addEventListener('click', function(){
                    const el = btn.closest('.message');
                    if (!el) return;
                    el.classList.remove('show');
                    el.classList.add('hiding');
                    setTimeout(function(){ el.remove(); }, 520);
                });
            });
        });
        </script>
