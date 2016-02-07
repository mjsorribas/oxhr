<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link http://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 *
 * Prokect Design Base: http://webapplayers.com/inspinia_admin-v2.4/index.html
 */
class AppController extends Controller
{

    const SES_BACK_URL                  = 'BACK_URL';

    const COUNTER_SELECT_TRF_BACK_URK   = 'COUNTER_SELECT_TRF_BACK_URK';

    const COOKIE_UID = 'cuid';

    const COOKIE_EXPIRATION_TIME = '+1 month';

    /**
     * Site Meta Data
     */
    public $page_title = "Onix-Systems";


    public $bread_crumbs = [];

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Auth', [
            'loginAction' => [
                'controller' => 'Users',
                'action' => 'login',
            ],
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login',
                'home'
            ],
            'authenticate' => [
                'Form' => [
                    'fields' => ['username' => 'username', 'password' => 'password']
                ]
            ]
        ]);
        $this->loadComponent('Cookie',[
            //'secure'    => true,
            'expires'   => '+1 months',
        ]);
    }

    /**
     * @param Event $event
     * @return null
     */
    public function beforeFilter(Event $event)
    {
        $this->Auth->deny();
//        $this->Auth->allow(['index', 'view', 'display']);

    }

    /**
     * Before render callback.
     *
     * @param \Cake\Event\Event $event The beforeRender event.
     * @return void
     */
    public function beforeRender(Event $event)
    {
        if (!array_key_exists('_serialize', $this->viewVars) &&
            in_array($this->response->type(), ['application/json', 'application/xml']))
        {
            $this->set('_serialize', true);
        }

        $this->set('authUser', $this->Auth->user());
        $this->set('page_title', $this->page_title);
        $this->set('bread_crumbs', $this->bread_crumbs);
    }
}
