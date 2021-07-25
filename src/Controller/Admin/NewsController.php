<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * News Controller
 *
 * @property \App\Model\Table\NewsTable $News
 * @method \App\Model\Entity\News[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class NewsController extends AdminController
{
    /**
     * Initialization hook method.
     *
     * @return void
     */
    public function initialize(): void
    {
        parent::initialize();
        $this->loadModel('Shops');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $login_user = $this->Auth->user();
        // 店舗権限
        if ( $login_user['role'] === 'shop' ) {
            $id = $login_user['id'];
            $shop = $this->Shops->find()->where(['user_id' => $id])->first();
            $shop_id = $shop->id;
            $query = $this->News->find()->where(['shop_id' => $shop_id]);
        } else {
        // 本部権限
            $query = $this->News;

            $shops_data = $this->Shops->find()->select(['id', 'shopname'])->all();
            foreach ($shops_data as $value) {
                $shops[$value['id']] = $value['shopname'];
            }
            $this->set('shops', $shops);
        }

        $news = $this->paginate($query);

        $this->set(compact('news'));
    }

    /**
     * View method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $news = $this->News->get($id, [
            'contain' => [],
        ]);

        $login_user = $this->Auth->user();
        // 店舗権限
        if ( $login_user['role'] === 'shop' ) {
            // アクセス可能なお知らせか
            $shop = $this->Shops->find()->where(['user_id' => $login_user['id']])->first();
            if ($news->shop_id != $shop->id) {
                $this->Flash->error(__('閲覧権限がありません。'));
                return $this->redirect(['action' => 'index']);
            }
        } else {
        // 本部権限
            $shops_data = $this->Shops->find()->select(['id', 'shopname'])->all();
            foreach ($shops_data as $value) {
                $shops[$value['id']] = $value['shopname'];
            }
            $this->set('shops', $shops);
        }

        $this->set(compact('news'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $news = $this->News->newEmptyEntity();

        $shops_data = $this->Shops->find()->select(['id', 'shopname'])->all();
        foreach ($shops_data as $value) {
            $shops[$value['id']] = $value['shopname'];
        }
        $this->set('shops', $shops);

        if ($this->request->is('post')) {
            $news = $this->News->patchEntity($news, $this->request->getData());
            $news->release_date = $this->request->getData('release_date');
            $news->release_end_date = $this->request->getData('release_end_date');

            $login_user = $this->Auth->user();
            // 店舗権限
            if ( $login_user['role'] === 'shop' ) {
                $shop = $this->Shops->find()->where(['user_id' => $login_user['id']])->first();
                $shop_id = $shop->id;
            } else {
            // 本部権限
                $shop_id = 1;
            }
            $news['shop_id'] = $shop_id;
            if ($this->News->save($news)) {
                $this->Flash->success(__('お知らせ情報を保存しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('お知らせ情報を保存できませんでした。'));
        }
        $this->set(compact('news'));
    }

    /**
     * Edit method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $news = $this->News->get($id, [
            'contain' => [],
        ]);

        $login_user = $this->Auth->user();
        // 店舗権限
        if ( $login_user['role'] === 'shop' ) {
            // アクセス可能なお知らせか
            $shop = $this->Shops->find()->where(['user_id' => $login_user['id']])->first();
            if ($news->shop_id != $shop->id) {
                $this->Flash->error(__('閲覧権限がありません。'));
                return $this->redirect(['action' => 'index']);
            }
        }

        $shops_data = $this->Shops->find()->select(['id', 'shopname'])->all();
        foreach ($shops_data as $value) {
            $shops[$value['id']] = $value['shopname'];
        }
        $this->set('shops', $shops);

        if ($this->request->is(['patch', 'post', 'put'])) {
            $news = $this->News->patchEntity($news, $this->request->getData());
            $news->release_date = $this->request->getData('release_date');
            $news->release_end_date = $this->request->getData('release_end_date');

            if ($this->News->save($news)) {
                $this->Flash->success(__('お知らせ情報を保存しました。'));
                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('お知らせ情報を保存できませんでした。'));
        }
        $this->set(compact('news'));
    }

    /**
     * Delete method
     *
     * @param string|null $id News id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $news = $this->News->get($id);
        if ($this->News->delete($news)) {
            $this->Flash->success(__('お知らせ情報を削除しました。'));
        } else {
            $this->Flash->error(__('お知らせ情報を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
