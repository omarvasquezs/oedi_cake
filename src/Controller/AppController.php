<?php

declare(strict_types=1);

/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */

namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\EventInterface;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/5/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('FormProtection');`
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();

        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/5/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');
    }

    /**
     * Common beforeFilter to set layouts conditionally.
     * If the request is Users::login, use the dedicated 'login' layout.
     */
    public function beforeFilter(
        EventInterface $event,
    ): void {
        parent::beforeFilter($event);

        $controller = $this->getRequest()->getParam('controller');
        $action = $this->getRequest()->getParam('action');

        // If the request is Users::login or Users::register, use the clean login layout and allow access
        if ($controller === 'Users' && ($action === 'login' || $action === 'register')) {
            $this->viewBuilder()->setLayout('login');
            return;
        }

        // For all other pages, select the intranet layout and enforce authentication
        $this->viewBuilder()->setLayout('intranet');

        // Accept either the Authentication plugin identity or our manual session key
        $identity = $this->getRequest()->getAttribute('identity');
        $sessionUser = $this->getRequest()->getSession()->read('Auth.User');

        if (!$identity && !$sessionUser) {
            // Redirect unauthenticated users to login
            $event->setResult($this->redirect(['controller' => 'Users', 'action' => 'login']));
            $event->stopPropagation();
        } else {
            // Pass user role info to all views
            $this->set('isSuperAdmin', $this->hasRole('super-admin'));
        }
    }

    /**
     * Check if the current user has a specific role.
     *
     * @param string $roleName The role name to check
     * @return bool
     */
    protected function hasRole(string $roleName): bool
    {
        $sessionUser = $this->getRequest()->getSession()->read('Auth.User');
        if (!is_array($sessionUser) || empty($sessionUser['id'])) {
            return false;
        }

        $userId = (int)$sessionUser['id'];
        $modelHasRolesTable = $this->getTableLocator()->get('ModelHasRoles');
        $rolesTable = $this->getTableLocator()->get('Roles');

        // Get user's roles
        $userRoles = $modelHasRolesTable->find()
            ->where([
                'model_id' => $userId,
                'model_type' => 'App\Model\Entity\User',
            ])
            ->all();

        foreach ($userRoles as $userRole) {
            $role = $rolesTable->find()
                ->where(['id' => $userRole->role_id])
                ->first();

            if ($role && $role->name === $roleName) {
                return true;
            }
        }

        return false;
    }
}
