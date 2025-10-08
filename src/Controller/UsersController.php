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

    public function login()
    {
        $this->request->allowMethod(['get', 'post']);

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
                $this->getRequest()->getSession()->write('Auth.User', [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
                $this->Flash->success('Has iniciado sesión correctamente.');
                return $this->redirect(['controller' => 'Pages', 'action' => 'display', 'home']);
            }

            $this->Flash->error('Credenciales inválidas.');
        }
    }
}
