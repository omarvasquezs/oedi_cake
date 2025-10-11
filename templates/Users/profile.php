<?php
/**
 * @var \App\View\AppView $this
 * @var array|object $user
 */
$this->assign('title', $title ?? 'Mi Perfil');

// Extract user data
$userName = '';
$userUsername = '';
$userEmail = '';

if (is_array($user)) {
    $userName = $user['name'] ?? '';
    $userUsername = $user['username'] ?? '';
    $userEmail = $user['email'] ?? '';
} elseif (is_object($user)) {
    $userName = $user->name ?? $user->get('name') ?? '';
    $userUsername = $user->username ?? $user->get('username') ?? '';
    $userEmail = $user->email ?? $user->get('email') ?? '';
}
?>

<style>
/* Estilos para los modales */
#editarPerfilModal .form-control,
#cambiarContrasenaModal .form-control {
    font-size: 15px !important;
    padding: 0.6rem 0.75rem !important;
}

#editarPerfilModal .form-label,
#cambiarContrasenaModal .form-label {
    font-size: 14px !important;
}

#editarPerfilModal .modal-title,
#cambiarContrasenaModal .modal-title {
    font-size: 18px !important;
}

#editarPerfilModal .modal-footer .btn,
#cambiarContrasenaModal .modal-footer .btn {
    font-size: 15px !important;
    padding: 0.6rem 1.5rem !important;
}
</style>

<div class="profile-view" style="max-width: 1200px; margin: 0 auto;">
    <div style="display: flex; gap: 2rem;">
        <!-- Profile Card -->
        <div style="flex: 0 0 400px; background: white; border-radius: 8px; border: 1px solid #e0e0e0; padding: 2rem; text-align: center;">
            <h2 style="margin: 0 0 2rem 0; color: #2c3e50; font-size: 24px; font-weight: 500;">Mi Perfil</h2>
            
            <!-- Avatar -->
            <div style="width: 120px; height: 120px; background: #ecf0f1; border-radius: 50%; margin: 0 auto 2rem auto; display: flex; align-items: center; justify-content: center;">
                <i class="fa-solid fa-user" style="font-size: 48px; color: #95a5a6;"></i>
            </div>

            <!-- Action Buttons -->
            <button type="button" data-bs-toggle="modal" data-bs-target="#editarPerfilModal" style="width: 100%; background: #3498db; color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; margin-bottom: 1rem; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <i class="fa-solid fa-pen"></i> Editar Perfil
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#cambiarContrasenaModal" style="width: 100%; background: #f39c12; color: white; border: none; padding: 0.8rem 1.5rem; border-radius: 4px; cursor: pointer; font-size: 14px; display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                <i class="fa-solid fa-key"></i> Cambiar Contraseña
            </button>
        </div>

        <!-- Profile Info -->
        <div style="flex: 1; background: white; border-radius: 8px; border: 1px solid #e0e0e0; padding: 2rem;">
            <!-- Personal Information -->
            <div style="margin-bottom: 2.5rem;">
                <h3 style="margin: 0 0 1.5rem 0; color: #2c3e50; font-size: 18px; font-weight: 500;">Información Personal</h3>
                
                <div style="display: grid; gap: 1.5rem;">
                    <div>
                        <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.5rem; font-weight: 500;">Nombre</div>
                        <div style="color: #2c3e50; font-size: 15px;"><?= h($userName ?: 'No especificado') ?></div>
                    </div>
                    
                    <div>
                        <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.5rem; font-weight: 500;">Nombre de Usuario</div>
                        <div style="color: #2c3e50; font-size: 15px;"><?= h($userUsername ?: 'No especificado') ?></div>
                    </div>
                    
                    <div>
                        <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.5rem; font-weight: 500;">Email</div>
                        <div style="color: #2c3e50; font-size: 15px;"><?= h($userEmail ?: 'No especificado') ?></div>
                    </div>
                </div>
            </div>

            <!-- Roles and Permissions -->
            <div>
                <h3 style="margin: 0 0 1.5rem 0; color: #2c3e50; font-size: 18px; font-weight: 500;">Roles y Permisos</h3>
                
                <div style="margin-bottom: 1.5rem;">
                    <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.75rem; font-weight: 500;">Roles</div>
                    <div style="display: flex; gap: 0.5rem; flex-wrap: wrap;">
                        <?php if (!empty($user->roles)): ?>
                            <?php foreach ($user->roles as $roleName): ?>
                                <span style="display: inline-block; padding: 0.4rem 1rem; background: #e3f2fd; color: #1976d2; border-radius: 16px; font-size: 13px;"><?= h($roleName) ?></span>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <span style="color: #95a5a6; font-size: 14px; font-style: italic;">No tiene roles asignados</span>
                        <?php endif; ?>
                    </div>
                </div>
                
                <div>
                    <div style="color: #7f8c8d; font-size: 13px; margin-bottom: 0.75rem; font-weight: 500;">Permisos</div>
                    <div style="color: #95a5a6; font-size: 14px; font-style: italic;">No hay permisos específicos asignados</div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal: Editar Perfil -->
<div class="modal fade" id="editarPerfilModal" tabindex="-1" aria-labelledby="editarPerfilModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #e0e0e0;">
                <h5 class="modal-title" id="editarPerfilModalLabel" style="color: #2c3e50; font-weight: 500;">Editar Perfil</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= $this->Form->create(null, ['url' => ['action' => 'edit'], 'id' => 'editProfileForm']) ?>
            <div class="modal-body" style="padding: 1.5rem;">
                <div class="mb-3">
                    <label for="profileName" class="form-label" style="color: #2c3e50; font-weight: 500; margin-bottom: 0.5rem;">Nombre</label>
                    <?= $this->Form->control('name', [
                        'type' => 'text',
                        'value' => $userName,
                        'class' => 'form-control',
                        'id' => 'profileName',
                        'label' => false,
                        'required' => true
                    ]) ?>
                </div>
                <div class="mb-3">
                    <label for="profileUsername" class="form-label" style="color: #2c3e50; font-weight: 500; margin-bottom: 0.5rem;">Nombre de Usuario</label>
                    <?= $this->Form->control('username', [
                        'type' => 'text',
                        'value' => $userUsername,
                        'class' => 'form-control',
                        'id' => 'profileUsername',
                        'label' => false,
                        'required' => true,
                        'oninput' => 'this.value = this.value.replace(/\s/g, "")'
                    ]) ?>
                    <small class="text-muted" style="font-size: 0.75rem; color: #6b7280;">Sin espacios</small>
                </div>
                <div class="mb-3">
                    <label for="profileEmail" class="form-label" style="color: #2c3e50; font-weight: 500; margin-bottom: 0.5rem;">Email</label>
                    <?= $this->Form->control('email', [
                        'type' => 'email',
                        'value' => $userEmail,
                        'class' => 'form-control',
                        'id' => 'profileEmail',
                        'label' => false,
                        'required' => true
                    ]) ?>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e0e0e0; padding: 1rem 1.5rem;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding: 0.5rem 1.5rem;">Cancelar</button>
                <?= $this->Form->button('Guardar', [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'style' => 'background: #3498db; border: none; padding: 0.5rem 1.5rem;'
                ]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>

<!-- Modal: Cambiar Contraseña -->
<div class="modal fade" id="cambiarContrasenaModal" tabindex="-1" aria-labelledby="cambiarContrasenaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header" style="border-bottom: 1px solid #e0e0e0;">
                <h5 class="modal-title" id="cambiarContrasenaModalLabel" style="color: #2c3e50; font-weight: 500;">Cambiar Contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <?= $this->Form->create(null, ['url' => ['action' => 'changePassword'], 'id' => 'changePasswordForm']) ?>
            <div class="modal-body" style="padding: 1.5rem;">
                <div class="mb-3">
                    <label for="currentPassword" class="form-label" style="color: #2c3e50; font-weight: 500; margin-bottom: 0.5rem;">Contraseña Actual</label>
                    <?= $this->Form->control('current_password', [
                        'type' => 'password',
                        'class' => 'form-control',
                        'id' => 'currentPassword',
                        'placeholder' => 'Ingrese su contraseña actual',
                        'label' => false,
                        'required' => true
                    ]) ?>
                </div>
                <div class="mb-3">
                    <label for="newPassword" class="form-label" style="color: #2c3e50; font-weight: 500; margin-bottom: 0.5rem;">Nueva Contraseña</label>
                    <?= $this->Form->control('new_password', [
                        'type' => 'password',
                        'class' => 'form-control',
                        'id' => 'newPassword',
                        'placeholder' => 'Ingrese la nueva contraseña',
                        'label' => false,
                        'required' => true
                    ]) ?>
                </div>
                <div class="mb-3">
                    <label for="confirmPassword" class="form-label" style="color: #2c3e50; font-weight: 500; margin-bottom: 0.5rem;">Confirmar Nueva Contraseña</label>
                    <?= $this->Form->control('confirm_password', [
                        'type' => 'password',
                        'class' => 'form-control',
                        'id' => 'confirmPassword',
                        'placeholder' => 'Confirme la nueva contraseña',
                        'label' => false,
                        'required' => true
                    ]) ?>
                </div>
            </div>
            <div class="modal-footer" style="border-top: 1px solid #e0e0e0; padding: 1rem 1.5rem;">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="padding: 0.5rem 1.5rem;">Cancelar</button>
                <?= $this->Form->button('Guardar', [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'style' => 'background: #3498db; border: none; padding: 0.5rem 1.5rem;'
                ]) ?>
            </div>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
