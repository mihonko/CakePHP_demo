<?php
declare(strict_types=1);

namespace App\Controller;

use DateTime;
use Cake\Core\Configure;

/**
 * Shop Controller
 *
 * @property \App\Model\Table\ShopsTable $Shops
 * @method \App\Model\Entity\Shop[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShopsController extends AppController
{
    public $paginate = [
        'limit' => 15,
        'order' => [
            'created' => 'DESC'
        ]
    ];

    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('Paginator');
        $this->loadModel('News');
    }

    /**
     * list method 店舗一覧
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function list()
    {
        $shops = $this->paginate($this->Shops);

        $this->set(compact('shops'));
    }

    /**
     * perf method 店舗一覧（都道府県絞り込み）
     *
     * @param string|null $id perf id.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function perf($id = null)
    {
      $query = $this->Shops->find()->where(['pref_id' => $id]);
      $this->set('shops', $this->paginate($query));

      $this->set('pref_name', Configure::read('pref')[$id]);

      $this->render('/Shops/list');
    }

    /**
     * search method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function search()
    {
        // セッションオブジェクトの取得
        $session = $this->request->getSession();

        // 検索時はセッションに保存、検索後のページングではセッションから取得
        if ($this->request->is('post')) {
            $address = $this->request->getData('address');
            $freeword = $this->request->getData('freeword');
            // セッションデータの書き込み
            $session->write([
                'search.address' => $address,
                'search.freeword' => $freeword
            ]);
        } else {
            $address = $session->read('search.address');
            $freeword = $session->read('search.freeword');
        }
        // 地名
        if ( $address ) {
            $query = $this->Shops->find()->where(['address like ' => '%'.$address.'%']);
        }
        // フリーワード
        if ( $freeword ) {
            $query = $this->Shops->find()->where(['OR' => ['shopname like ' => '%'.$freeword.'%',
                                                           'business_hours like ' => '%'.$freeword.'%',
                                                           'regular_holiday like ' => '%'.$freeword.'%',
                                                           'free_test like ' => '%'.$freeword.'%']
                                                  ]);
        }
        $this->set('shops', $this->paginate($query));

        $this->render('/Shops/list');
    }

    /**
     * detail method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function detail($id = null)
    {
        $shop = $this->Shops->get($id, [
            'contain' => '',
        ]);

        $time = new DateTime();

        $shop['news'] = $this->News->find()->where([
                            'shop_id' => $id,
                            'is_valid' => 1,
                            'release_date IS NOT' => '0000-00-00',
                            'release_date <=' => $time->format('Y-m-d'),
                            'OR' => [['release_end_date IS' => NULL], ['release_end_date >=' => $time->format('Y-m-d')]]
                        ])->order(['release_date' => 'DESC']);

        $this->set(compact('shop'));
    }
}
