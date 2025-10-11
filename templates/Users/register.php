<div style="min-height: 100vh; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2rem;">
    <div style="background: white; border-radius: 16px; box-shadow: 0 20px 60px rgba(0,0,0,0.3); padding: 3rem; width: 100%; max-width: 450px;">
        <!-- Icon -->
        <div style="text-align: center; margin-bottom: 2rem;">
            <div style="background: #2196F3; width: 80px; height: 80px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                <i class="fa-solid fa-user-plus" style="font-size: 32px; color: white;"></i>
            </div>
            <h2 style="margin: 0; font-size: 1.75rem; color: #2c3e50; font-weight: 600;">Registro de Usuario</h2>
        </div>

        <!-- Form -->
        <?= $this->Form->create($user, [
            'id' => 'registerForm',
            'style' => 'display: flex; flex-direction: column; gap: 1.25rem;'
        ]) ?>

            <!-- Nombre Completo -->
            <div>
                <?= $this->Form->control('name', [
                    'label' => false,
                    'placeholder' => 'Nombre Completo *',
                    'class' => 'form-control',
                    'required' => true,
                    'style' => 'width: 100%; padding: 0.875rem 1rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; outline: none;',
                    'onFocus' => 'this.style.borderColor="#2196F3"',
                    'onBlur' => 'this.style.borderColor="#e0e0e0"'
                ]) ?>
            </div>

            <!-- Nombre de Usuario -->
            <div>
                <?= $this->Form->control('username', [
                    'label' => false,
                    'placeholder' => 'Nombre de Usuario *',
                    'class' => 'form-control',
                    'required' => true,
                    'style' => 'width: 100%; padding: 0.875rem 1rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; outline: none;',
                    'onFocus' => 'this.style.borderColor="#2196F3"',
                    'onBlur' => 'this.style.borderColor="#e0e0e0"',
                    'onInput' => 'this.value = this.value.replace(/\s/g, "")'
                ]) ?>
                <small style="color: #666; font-size: 12px; display: block; margin-top: 0.25rem;">
                    <i class="fa-solid fa-circle-info"></i> Sin espacios
                </small>
            </div>

            <!-- Correo Electrónico -->
            <div>
                <?= $this->Form->control('email', [
                    'type' => 'email',
                    'label' => false,
                    'placeholder' => 'Correo Electrónico *',
                    'class' => 'form-control',
                    'required' => true,
                    'style' => 'width: 100%; padding: 0.875rem 1rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; outline: none;',
                    'onFocus' => 'this.style.borderColor="#2196F3"',
                    'onBlur' => 'this.style.borderColor="#e0e0e0"'
                ]) ?>
            </div>

            <!-- Contraseña -->
            <div>
                <?= $this->Form->control('password', [
                    'type' => 'password',
                    'label' => false,
                    'placeholder' => 'Contraseña *',
                    'class' => 'form-control',
                    'required' => true,
                    'style' => 'width: 100%; padding: 0.875rem 1rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; outline: none;',
                    'onFocus' => 'this.style.borderColor="#2196F3"',
                    'onBlur' => 'this.style.borderColor="#e0e0e0"'
                ]) ?>
                <small style="color: #666; font-size: 12px; display: block; margin-top: 0.25rem;">
                    <i class="fa-solid fa-circle-info"></i> Mínimo 6 caracteres
                </small>
            </div>

            <!-- Confirmar Contraseña -->
            <div>
                <?= $this->Form->control('password_confirmation', [
                    'type' => 'password',
                    'label' => false,
                    'placeholder' => 'Confirmar Contraseña *',
                    'class' => 'form-control',
                    'required' => true,
                    'style' => 'width: 100%; padding: 0.875rem 1rem; border: 2px solid #e0e0e0; border-radius: 8px; font-size: 15px; transition: all 0.3s; outline: none;',
                    'onFocus' => 'this.style.borderColor="#2196F3"',
                    'onBlur' => 'this.style.borderColor="#e0e0e0"'
                ]) ?>
            </div>

            <!-- Submit Button -->
            <div style="margin-top: 0.5rem;">
                <?= $this->Form->button('REGISTRARSE', [
                    'type' => 'submit',
                    'class' => 'btn btn-primary',
                    'style' => 'width: 100%; padding: 0.875rem; background: #2196F3; color: white; border: none; border-radius: 8px; font-size: 16px; font-weight: 600; cursor: pointer; transition: all 0.3s; text-transform: uppercase; letter-spacing: 0.5px;',
                    'onMouseOver' => 'this.style.background="#1976D2"',
                    'onMouseOut' => 'this.style.background="#2196F3"'
                ]) ?>
            </div>

        <?= $this->Form->end() ?>

        <!-- Login Link -->
        <div style="text-align: center; margin-top: 1.5rem;">
            <p style="color: #666; font-size: 14px; margin: 0;">
                ¿Ya tienes cuenta? 
                <?= $this->Html->link('Inicia sesión', ['action' => 'login'], [
                    'style' => 'color: #2196F3; text-decoration: none; font-weight: 600; margin-left: 0.25rem;',
                    'onMouseOver' => 'this.style.textDecoration="underline"',
                    'onMouseOut' => 'this.style.textDecoration="none"'
                ]) ?>
            </p>
        </div>
    </div>
</div>

<style>
    /* Remove autofill yellow background */
    input:-webkit-autofill,
    input:-webkit-autofill:hover,
    input:-webkit-autofill:focus,
    input:-webkit-autofill:active {
        -webkit-box-shadow: 0 0 0 30px white inset !important;
        box-shadow: 0 0 0 30px white inset !important;
    }
    
    /* Remove error styling from CakePHP */
    .error {
        display: none !important;
    }
</style>
