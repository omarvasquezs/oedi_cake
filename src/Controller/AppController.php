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
        \Cake\Event\EventInterface $event
    ) {
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

        // Identity detection: Authentication middleware attaches 'identity', fallback to session
        $identity = $this->getRequest()->getAttribute('identity');
        $sessionUser = $this->getRequest()->getSession()->read('Auth.User');

        if (!$identity && !$sessionUser) {
            // Redirect unauthenticated users to login
            return $this->redirect(['controller' => 'Users', 'action' => 'login']);
        }
    }
}
