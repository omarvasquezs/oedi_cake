<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Event\EventInterface;

class UsersController extends AppController
{
    public function beforeFilter(EventInterface $event)
    {
        parent::beforeFilter($event);
        // allow the login action so unauthenticated users can access it
        if (method_exists($this, 'Authentication')) {
            // noop if authentication plugin is not configured
        }
    }

    public function index()
    {
        $this->set('title', 'Usuarios');

        // Get items per page from query string, default to 10
        $perPage = $this->request->getQuery('per_page', 10);
        $perPage = in_array($perPage, [10, 20, 40, 50, 100]) ? $perPage : 10;

        // Get search query from query string
        $search = $this->request->getQuery('search', '');

        // Get advanced filters from query string
        $filterNombre = $this->request->getQuery('filter_nombre', '');
        $filterUsuario = $this->request->getQuery('filter_usuario', '');
        $filterEmail = $this->request->getQuery('filter_email', '');
        $filterRoles = $this->request->getQuery('filter_roles', '');

        // Load users from database with pagination
        $usersTable = $this->getTableLocator()->get('Users');
        $rolesTable = $this->getTableLocator()->get('Roles');
        $modelHasRolesTable = $this->getTableLocator()->get('ModelHasRoles');

        // Build query with search filter if provided
        $query = $usersTable->find();

        if (!empty($search)) {
            $query->where([
                'OR' => [
                    'Users.name LIKE' => '%' . $search . '%',
                    'Users.username LIKE' => '%' . $search . '%',
                    'Users.email LIKE' => '%' . $search . '%',
                ],
            ]);
        }

        // Apply advanced filters
        if (!empty($filterNombre)) {
            $query->where(['Users.name LIKE' => '%' . $filterNombre . '%']);
        }

        if (!empty($filterUsuario)) {
            $query->where(['Users.username LIKE' => '%' . $filterUsuario . '%']);
        }

        if (!empty($filterEmail)) {
            $query->where(['Users.email LIKE' => '%' . $filterEmail . '%']);
        }

        // Filter by roles BEFORE pagination
        if (!empty($filterRoles)) {
            $requestedRoles = explode(',', $filterRoles);

            // Get role IDs from role names
            $roleIds = $rolesTable->find()
                ->where(['name IN' => $requestedRoles])
                ->all()
                ->extract('id')
                ->toArray();

            if (!empty($roleIds)) {
                // Get user IDs that have at least one of the requested roles
                $userIdsWithRoles = $modelHasRolesTable->find()
                    ->where([
                        'role_id IN' => $roleIds,
                        'model_type' => 'App\Model\Entity\User',
                    ])
                    ->all()
                    ->extract('model_id')
                    ->toArray();

                if (!empty($userIdsWithRoles)) {
                    $query->where(['Users.id IN' => $userIdsWithRoles]);
                } else {
                    // No users with these roles, return empty result
                    $query->where(['1' => '0']);
                }
            }
        }

        // Configure pagination
        $this->paginate = [
            'limit' => $perPage,
            'order' => ['Users.name' => 'asc'],
        ];

        $users = $this->paginate($query);

        // Load all available roles for the modals
        $allRoles = $rolesTable->find('all')->toArray();

        // Load roles for each user from model_has_roles
        foreach ($users as $user) {
            $userRoles = $modelHasRolesTable->find()
                ->where(['model_id' => $user->id, 'model_type' => 'App\Model\Entity\User'])
                ->toArray();

            $roleNames = [];
            $roleIds = [];
            foreach ($userRoles as $userRole) {
                $role = $rolesTable->get($userRole->role_id);
                $roleNames[] = $role->name;
                $roleIds[] = $role->id;
            }

            $user->roles = $roleNames;
            $user->roleIds = $roleIds;
        }

        $this->set('users', $users);
        $this->set('allRoles', $allRoles);
        $this->set('perPage', $perPage);
        $this->set('search', $search);
        $this->set('filterNombre', $filterNombre);
        $this->set('filterUsuario', $filterUsuario);
        $this->set('filterEmail', $filterEmail);
        $this->set('filterRoles', $filterRoles);
    }

    public function profile()
    {
        // Prefer Authentication plugin identity when available; fallback to session
        $identity = $this->getRequest()->getAttribute('identity');
        if ($identity) {
            $userId = $identity->getIdentifier();
        } else {
            $sessionUser = $this->getRequest()->getSession()->read('Auth.User');
            if (!$sessionUser) {
                $this->Flash->error('No hay sesión activa. Por favor inicia sesión.');

                return $this->redirect(['action' => 'login']);
            }
            $userId = is_array($sessionUser) ? ($sessionUser['id'] ?? null) : ($sessionUser->id ?? null);
        }

        if (!$userId) {
            $this->Flash->error('No se pudo determinar el usuario autenticado.');

            return $this->redirect(['action' => 'login']);
        }

        // Load user from database with complete info
        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->get($userId);

        // Load user roles from model_has_roles
        $modelHasRolesTable = $this->getTableLocator()->get('ModelHasRoles');
        $rolesTable = $this->getTableLocator()->get('Roles');

        $userRoles = $modelHasRolesTable->find()
            ->where(['model_id' => $userId, 'model_type' => 'App\Model\Entity\User'])
            ->toArray();

        $roleNames = [];
        foreach ($userRoles as $userRole) {
            $role = $rolesTable->get($userRole->role_id);
            $roleNames[] = $role->name;
        }

        $user->roles = $roleNames;

        $this->set('user', $user);
        $this->set('title', 'Mi Perfil');
    }

    public function logout()
    {
        // Only allow POST for logout to mitigate CSRF via GET
        $this->request->allowMethod(['post']);

        $request = $this->getRequest();
        $response = $this->getResponse();

        // If the Authentication plugin is present, use the service to clear identity
        $service = $request->getAttribute('authentication');
        if ($service) {
            $result = $service->clearIdentity($request, $response);
            // update the response on the controller
            $this->setResponse($result['response']);
        } else {
            // Fallback: clear the manual session key
            $this->getRequest()->getSession()->delete('Auth.User');
        }

        $this->Flash->success('Has cerrado sesión.');

        return $this->redirect(['controller' => 'Users', 'action' => 'login']);
    }

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);

        // If the Authentication plugin is available, the middleware will set an
        // 'authenticationResult' request attribute. Use that if present.
        $authResult = $this->getRequest()->getAttribute('authenticationResult');
        if ($authResult !== null) {
            if ($this->request->is('post')) {
                if ($authResult->isValid()) {
                    $this->Flash->success('Has iniciado sesión correctamente.');

                    return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
                }

                $this->Flash->error('Credenciales inválidas.');
            }

            return;
        }

        // Fallback: manual authentication (for environments without the plugin)
        if ($this->request->is('post')) {
            $data = $this->request->getData();
            $emailOrUsername = $data['username'] ?? null;
            $password = $data['password'] ?? null;

            $usersTable = $this->getTableLocator()->get('Users');
            $user = $usersTable->find()
                ->where(['OR' => [['email' => $emailOrUsername], ['username' => $emailOrUsername]]])
                ->first();

            if ($user && password_verify($password, $user->password)) {
                // Simple session identity
                $session = $this->getRequest()->getSession();
                $session->write('Auth.User', [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'username' => $user->username,
                ]);

                // Debug: verificar que se guardó
                error_log('Session saved: ' . print_r($session->read('Auth.User'), true));

                $this->Flash->success('Has iniciado sesión correctamente.');
                // Redirect to dashboard after successful login
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
            }

            $this->Flash->error('Credenciales inválidas.');
        }
    }

    public function register()
    {
        $this->request->allowMethod(['get', 'post']);

        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->newEmptyEntity();

        if ($this->request->is('post')) {
            $data = $this->request->getData();

            // Verify passwords match
            if (isset($data['password']) && isset($data['password_confirmation'])) {
                if ($data['password'] !== $data['password_confirmation']) {
                    $this->Flash->error('Las contraseñas no coinciden.');
                    $this->set(compact('user'));

                    return;
                }
            }

            // Remove password_confirmation before patching entity
            unset($data['password_confirmation']);

            $user = $usersTable->patchEntity($user, $data);

            if ($usersTable->save($user)) {
                // Assign default "usuario" role to new user
                $rolesTable = $this->getTableLocator()->get('Roles');
                $modelHasRolesTable = $this->getTableLocator()->get('ModelHasRoles');

                // Find the "usuario" role
                $usuarioRole = $rolesTable->find()
                    ->where(['name' => 'usuario'])
                    ->first();

                if ($usuarioRole) {
                    // Create role assignment
                    $roleAssignment = $modelHasRolesTable->newEntity([
                        'role_id' => $usuarioRole->id,
                        'model_type' => 'App\Model\Entity\User',
                        'model_id' => $user->id,
                    ]);
                    $modelHasRolesTable->save($roleAssignment);
                }

                $this->Flash->success('Usuario registrado correctamente. Ahora puedes iniciar sesión.');

                return $this->redirect(['action' => 'login']);
            } else {
                // Get validation errors
                $errors = $user->getErrors();
                if (!empty($errors)) {
                    foreach ($errors as $field => $fieldErrors) {
                        foreach ($fieldErrors as $error) {
                            $this->Flash->error($error);
                        }
                    }
                } else {
                    $this->Flash->error('No se pudo registrar el usuario. Por favor, intente nuevamente.');
                }
            }
        }

        $this->set(compact('user'));
    }

    public function edit($id = null)
    {
        $this->request->allowMethod(['post']);

        $usersTable = $this->getTableLocator()->get('Users');

        // If $id is provided, it's an admin editing another user
        if ($id !== null) {
            $userEntity = $usersTable->get($id);
            $isAdminEdit = true;
        } else {
            // User editing their own profile
            $identity = $this->getRequest()->getAttribute('identity');
            $sessionUser = $this->getRequest()->getSession()->read('Auth.User');
            $user = $identity ?: $sessionUser;

            if (!$user) {
                $this->Flash->error('No se pudo identificar al usuario.');

                return $this->redirect(['action' => 'profile']);
            }

            $userId = is_array($user) ? $user['id'] : ($user->id ?? $user->get('id'));
            $userEntity = $usersTable->get($userId);
            $isAdminEdit = false;
        }

        $data = $this->request->getData();

        // Handle role assignments if provided (admin only)
        if ($isAdminEdit && isset($data['roles'])) {
            $roles = $data['roles'];
            unset($data['roles']); // Remove from user data
        }

        $userEntity = $usersTable->patchEntity($userEntity, $data);

        if ($usersTable->save($userEntity)) {
            // Update roles if this is an admin edit
            if ($isAdminEdit && isset($roles)) {
                $modelHasRolesTable = $this->getTableLocator()->get('ModelHasRoles');

                // Delete existing role assignments
                $modelHasRolesTable->deleteAll([
                    'model_id' => $userEntity->id,
                    'model_type' => 'App\Model\Entity\User',
                ]);

                // Insert new role assignments
                foreach ($roles as $roleId) {
                    $roleAssignment = $modelHasRolesTable->newEntity([
                        'role_id' => $roleId,
                        'model_type' => 'App\Model\Entity\User',
                        'model_id' => $userEntity->id,
                    ]);
                    $modelHasRolesTable->save($roleAssignment);
                }
            }

            // Update session if user is editing their own profile
            if (!$isAdminEdit) {
                $user = $this->getRequest()->getAttribute('identity') ?: $this->getRequest()->getSession()->read('Auth.User');
                if (is_array($user)) {
                    $this->getRequest()->getSession()->write('Auth.User', [
                        'id' => $userEntity->id,
                        'name' => $userEntity->name,
                        'username' => $userEntity->username,
                        'email' => $userEntity->email,
                    ]);
                }
            }

            $this->Flash->success('Usuario actualizado correctamente.');
        } else {
            $this->Flash->error('No se pudo actualizar el usuario. Por favor, intente nuevamente.');
        }

        return $this->redirect($isAdminEdit ? ['action' => 'index'] : ['action' => 'profile']);
    }

    public function changePassword()
    {
        $this->request->allowMethod(['post']);

        $identity = $this->getRequest()->getAttribute('identity');
        $sessionUser = $this->getRequest()->getSession()->read('Auth.User');
        $user = $identity ?: $sessionUser;

        if (!$user) {
            $this->Flash->error('No se pudo identificar al usuario.');

            return $this->redirect(['action' => 'profile']);
        }

        // Get user ID
        $userId = is_array($user) ? $user['id'] : ($user->id ?? $user->get('id'));

        $usersTable = $this->getTableLocator()->get('Users');
        $userEntity = $usersTable->get($userId);

        $data = $this->request->getData();
        $currentPassword = $data['current_password'] ?? '';
        $newPassword = $data['new_password'] ?? '';
        $confirmPassword = $data['confirm_password'] ?? '';

        // Verify current password
        if (!password_verify($currentPassword, $userEntity->password)) {
            $this->Flash->error('La contraseña actual es incorrecta.');

            return $this->redirect(['action' => 'profile']);
        }

        // Verify new passwords match
        if ($newPassword !== $confirmPassword) {
            $this->Flash->error('Las contraseñas nuevas no coinciden.');

            return $this->redirect(['action' => 'profile']);
        }

        // Verify new password is not empty
        if (empty($newPassword)) {
            $this->Flash->error('La nueva contraseña no puede estar vacía.');

            return $this->redirect(['action' => 'profile']);
        }

        // Update password
        $userEntity->password = $newPassword;

        if ($usersTable->save($userEntity)) {
            $this->Flash->success('Contraseña actualizada correctamente.');
        } else {
            $this->Flash->error('No se pudo actualizar la contraseña. Por favor, intente nuevamente.');
        }

        return $this->redirect(['action' => 'profile']);
    }

    public function add()
    {
        $this->request->allowMethod(['post']);

        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->newEmptyEntity();

        $data = $this->request->getData();

        // Handle role assignments if provided
        $roles = [];
        if (isset($data['roles'])) {
            $roles = $data['roles'];
            unset($data['roles']); // Remove from user data
        }

        // Verify passwords match
        if ($data['password'] !== $data['password_confirmation']) {
            $this->Flash->error('Las contraseñas no coinciden.');

            return $this->redirect(['action' => 'index']);
        }

        $user = $usersTable->patchEntity($user, $data);

        if ($usersTable->save($user)) {
            $modelHasRolesTable = $this->getTableLocator()->get('ModelHasRoles');
            $rolesTable = $this->getTableLocator()->get('Roles');

            // If no roles were selected, assign "usuario" role by default
            if (empty($roles)) {
                $usuarioRole = $rolesTable->find()
                    ->where(['name' => 'usuario'])
                    ->first();

                if ($usuarioRole) {
                    $roles = [$usuarioRole->id];
                }
            }

            // Assign roles
            if (!empty($roles)) {
                foreach ($roles as $roleId) {
                    $roleAssignment = $modelHasRolesTable->newEntity([
                        'role_id' => $roleId,
                        'model_type' => 'App\Model\Entity\User',
                        'model_id' => $user->id,
                    ]);
                    $modelHasRolesTable->save($roleAssignment);
                }
            }

            $this->Flash->success('Usuario creado correctamente.');
        } else {
            $this->Flash->error('No se pudo crear el usuario. Por favor, intente nuevamente.');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function adminChangePassword($id = null)
    {
        $this->request->allowMethod(['post']);

        if (!$id) {
            $this->Flash->error('ID de usuario no válido.');

            return $this->redirect(['action' => 'index']);
        }

        $usersTable = $this->getTableLocator()->get('Users');
        $userEntity = $usersTable->get($id);

        $data = $this->request->getData();
        $newPassword = $data['new_password'] ?? '';
        $confirmPassword = $data['confirm_new_password'] ?? '';

        // Verify new passwords match
        if ($newPassword !== $confirmPassword) {
            $this->Flash->error('Las contraseñas nuevas no coinciden.');

            return $this->redirect(['action' => 'index']);
        }

        // Verify new password is not empty
        if (empty($newPassword)) {
            $this->Flash->error('La nueva contraseña no puede estar vacía.');

            return $this->redirect(['action' => 'index']);
        }

        // Update password
        $userEntity->password = $newPassword;

        if ($usersTable->save($userEntity)) {
            $this->Flash->success('Contraseña del usuario actualizada correctamente.');
        } else {
            $this->Flash->error('No se pudo actualizar la contraseña. Por favor, intente nuevamente.');
        }

        return $this->redirect(['action' => 'index']);
    }

    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);

        if (!$id) {
            $this->Flash->error('ID de usuario no válido.');

            return $this->redirect(['action' => 'index']);
        }

        // Prevent users from deleting themselves
        $identity = $this->getRequest()->getAttribute('identity');
        $sessionUser = $this->getRequest()->getSession()->read('Auth.User');
        $currentUser = $identity ?: $sessionUser;
        $currentUserId = is_array($currentUser) ? $currentUser['id'] : ($currentUser->id ?? $currentUser->get('id'));

        if ($currentUserId == $id) {
            $this->Flash->error('No puedes eliminar tu propia cuenta.');

            return $this->redirect(['action' => 'index']);
        }

        $usersTable = $this->getTableLocator()->get('Users');
        $user = $usersTable->get($id);

        // Delete user's role assignments first
        $modelHasRolesTable = $this->getTableLocator()->get('ModelHasRoles');
        $modelHasRolesTable->deleteAll([
            'model_id' => $id,
            'model_type' => 'App\Model\Entity\User',
        ]);

        // Delete the user
        if ($usersTable->delete($user)) {
            $this->Flash->success('Usuario eliminado correctamente.');
        } else {
            $this->Flash->error('No se pudo eliminar el usuario. Por favor, intente nuevamente.');
        }

        return $this->redirect(['action' => 'index']);
    }
}
