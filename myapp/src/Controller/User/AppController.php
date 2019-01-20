<?php
namespace App\Controller\User;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;

class AppController extends \App\Controller\AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->Users = TableRegistry::get('Users');

        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Users',
                    'fields' => ['username' => 'email','password' => 'password']
                ]
            ],
            'storage' => ['className' => 'Session', 'key' => 'Auth.User'],

            'loginAction' => ['controller' => 'Users','action' => 'login'],
            'unauthorizedRedirect' => ['controller' => 'Users','action' => 'login'],
            'loginRedirect' => ['controller' => 'Users','action' => 'index'],
            'logoutRedirect' => ['controller' => 'Users','action' => 'login'],
            // コントローラーで isAuthorized を使用します
            'authorize' => ['Controller'],
                // 未認証の場合、直前のページに戻します
            'unauthorizedRedirectedRedirect' => $this->referer()
        ]);

    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');
        // ログイン時に許可するアクション
        if (in_array($action, ['index', 'view', 'edit','add','delete'])) {
            return true;
        }
        return false;
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['logout']);
    }

}