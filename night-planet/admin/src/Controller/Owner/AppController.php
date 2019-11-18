<?php
namespace App\Controller\Owner;

use Cake\ORM\TableRegistry;
use Cake\Event\Event;
use Cake\Core\Configure;

class AppController extends \App\Controller\AppController
{
    public $components = array('Util');

    public function initialize()
    {
        parent::initialize();
        $this->Owners = TableRegistry::get('owners');
        $this->Shops = TableRegistry::get('shops');
        $this->Coupons = TableRegistry::get('coupons');
        $this->Casts = TableRegistry::get('casts');
        $this->Jobs = TableRegistry::get('jobs');
        $this->Snss = TableRegistry::get('snss');
        $this->ServecePlans = TableRegistry::get('servece_plans');
        $this->Updates = TableRegistry::get('updates');
        $this->ShopInfos = TableRegistry::get("shop_infos");
        $this->WorkSchedules = TableRegistry::get("work_schedules");
        $this->CastSchedules = TableRegistry::get("cast_schedules");
        $this->MasterCodes = TableRegistry::get("master_codes");
        $this->loadComponent('Auth', [
            'authenticate' => [
                'Form' => [
                    'userModel' => 'Owners',
                    'fields' => ['username' => 'email','password' => 'password']
                ],
               'NodeLink/RememberMe.Cookie' => [
                   'userModel' => 'Owners',  // 'Form'認証と同じモデルを指定します
                   'fields' => ['token' => 'remember_token'],  // Remember-Me認証用のトークンを保存するカラムを指定します
               ],
            ],
            'storage' => ['className' => 'Session', 'key' => 'Auth.Owner'],

            'loginAction' => ['controller' => 'Owners','action' => 'login'],
            'unauthorizedRedirect' => ['controller' => 'Owners','action' => 'login'],
            'loginRedirect' => ['controller' => 'Owners','action' => 'index'],
            'logoutRedirect' => ['controller' => 'Owners','action' => 'login'],
            // コントローラーで isAuthorized を使用します
            'authorize' => ['Controller'],
                // 未認証の場合、直前のページに戻します
            'unauthorizedRedirectedRedirect' => $this->referer()
        ]);

    }

    public function isAuthorized($user)
    {
        $action = $this->request->getParam('action');

        // ログイン時に許可するオーナー画面アクション
        $ownerAccess = ['index','shopAdd','profile','passChange'];

        // ログイン時に許可する店舗編集画面アクション
        $shopAccess = ['index','shopEdit','saveTopImage','saveCatch','deleteCatch',
            'saveCoupon','deleteCoupon','switchCoupon','deleteCoupon','saveCast','switchCast',
            'deleteCast','saveTenpo','saveJob','saveSns','saveGallery','deleteGallery','notice','viewNotice',
            'saveNotice','updateNotice','deleteNotice','workSchedule','saveWorkSchedule'];

        //TODO: 権限によって店舗管理者のみとオーナー兼店舗管理者を分ける？
        // 今は、分けず各アクションは統合する
        $access = array_merge($ownerAccess,$shopAccess);
        if (in_array($action, $access)) {
            return true;
        }
        return false;
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow(['signup','verify','resetVerify','logout','passReset']);
        $this->Auth->config('authError', "もう一度ログインしてください。");
        parent::beforeRender($event); //親クラスのbeforeRendorを呼ぶ
    }

    /**
     * json返却用の設定
     *
     * @param array $validate
     * @return void
     */
    public function confReturnJson()
    {
        $this->viewBuilder()->autoLayout(false);
        $this->autoRender = false;
        $this->response->charset('UTF-8');
        $this->response->type('json');
    }

}
