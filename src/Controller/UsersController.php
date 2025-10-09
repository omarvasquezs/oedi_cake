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
                $this->getRequest()->getSession()->write('Auth.User', [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                ]);
                $this->Flash->success('Has iniciado sesión correctamente.');
                // Redirect to dashboard after successful login
                return $this->redirect(['controller' => 'Dashboard', 'action' => 'index']);
            }

            $this->Flash->error('Credenciales inválidas.');
        }
    }
}
