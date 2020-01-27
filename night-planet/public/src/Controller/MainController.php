<?php
namespace App\Controller;

use Token\Util\Token;
use Cake\Mailer\MailerAwareTrait;
use Cake\ORM\TableRegistry;
use Cake\Event\Event;

/**
* Users Controller
*
* @property \App\Model\Table\UsersTable $Users
*
* @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
*/
class MainController extends AppController
{
    use MailerAwareTrait;

    public function initialize()
    {
        parent::initialize();
        $this->Users = TableRegistry::get('users');
        $this->Shops = TableRegistry::get('shops');
        $this->Coupons = TableRegistry::get('coupons');
        $this->Casts = TableRegistry::get('casts');
        $this->Jobs = TableRegistry::get('jobs');
        $this->Shop_infos = TableRegistry::get('shop_infos');
        $this->Diarys = TableRegistry::get('diarys');
        $this->MasterCodes = TableRegistry::get("master_codes");
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->viewBuilder()->layout('userDefault');
        // 常に現在エリアを取得
        $is_area = AREA['okinawa']['path'];
        $this->set(compact('is_area'));
        // SEO対策
        $title = str_replace("_service_name_", LT['000'], TITLE['TOP_TITLE']);
        $description = str_replace("_service_name_", LT['000'], META['TOP_DESCRIPTION']);
        $this->set(compact("title", "description"));
    }

    public function top()
    {
        //$this->redirect("http://localhost:8080/api-googles");
        $masterCodesFind = array('area','genre');
        $selectList = $this->Util->getSelectList($masterCodesFind, $this->MasterCodes, false);

        $shops_query = $this->Shops->find();
        $casts_query = $this->Casts->find();
        $shops = $shops_query->select(['count'=> $shops_query->func()->count('area'),'area'])
                    ->group('area')->toArray();
        $shops_cnt = 0;
        $area = array();
        // 全体店舗数、エリア毎の店舗数をセットする
        foreach (AREA as $key1 => $value) {
            // エリア店舗を０で初期化
            $value['count'] = 0;
            array_push($area, $value);
            foreach ($shops as $key2 => $shop) {
                if ($value['path']  == $shop->area) {
                    // 全体店舗数をセット
                    $shops_cnt += $shop->count;
                    // エリア店舗をセット
                    $area[array_key_last($area)]['count'] = $shop->count;
                    break;
                }
            }
        }
        $regin = [];
        foreach (REGION as $key => $value1) {
            $region_cnt = 0;
            foreach ($area as $key => $value2) {
                if ($value2['region'] == $value1['path']) {
                    $region_cnt += $value2['count'];
                }
            }
            $region[$value1['path']] = $region_cnt;
        }
        // 全体スタッフ数を取得
        $casts_cnt = $casts_query->count();
        $all_cnt = ['shops' => $shops_cnt, 'casts' => $casts_cnt];

        $ig_data = null; // Instagramデータ

        // ナイプラのインスタデータを取得する
        if (!empty(API['INSTAGRAM_USER_NAME'])) {
            $insta_user_name = API['INSTAGRAM_USER_NAME'];
            // インスタのキャッシュパス
            $cache_path = preg_replace(
                '/(\/\/)/',
                '/',
                WWW_ROOT.PATH_ROOT['NIGHT_PLANET_CACHE']
            );
            // インスタ情報を取得
            $tmp_ig_data = $this->Util->getInstagram($insta_user_name, null
                            , null, $cache_path);
            // データ取得に失敗した場合
            if (!$tmp_ig_data) {
                $this->log('【'.AREA[$shop->area]['label']
                    .GENRE[$shop->genre]['label'].$shop->name
                    .'】のインスタグラムのデータ取得に失敗しました。', 'error');
                $this->Flash->warning('インスタグラムのデータ取得に失敗しました。');
            }
            $ig_data = $tmp_ig_data->business_discovery;
            // インスタユーザーが存在しない場合
            if (!empty($tmp_ig_data->error)) {
                // エラーメッセージをセットする
                $insta_error = $tmp_ig_data->error->error_user_title;
                $this->set(compact('ig_error'));
            }
            $is_naipura = true;
        }

        $diarys = $this->Util->getNewDiarys(PROPERTY['NEW_INFO_MAX'], null, null);
        $notices = $this->Util->getNewNotices(PROPERTY['NEW_INFO_MAX']);
        $main_adsenses = $this->Util->getAdsense(PROPERTY['TOP_SLIDER_GALLERY_MAX'], 'main', null);
        $sub_adsenses = $this->Util->getAdsense(PROPERTY['SUB_SLIDER_GALLERY_MAX'], 'sub', null);
        //広告を配列にセット
        $adsenses = array('main_adsenses' => $main_adsenses, 'sub_adsenses' => $sub_adsenses);
        $this->set(compact('area', 'region', 'all_cnt', 'selectList', 'diarys', 'notices', 'ig_data','is_naipura', 'adsenses'));
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
