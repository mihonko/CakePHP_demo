<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * Shops Controller
 *
 * @property \App\Model\Table\ShopsTable $Shops
 * @method \App\Model\Entity\Shop[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ShopsController extends AdminController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $shops = $this->paginate($this->Shops);

        $this->set(compact('shops'));
    }

    /**
     * View method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $login_user = $this->Auth->user();
        // 店舗権限
        if ( $login_user['role'] === 'shop' ) {
            $id = $login_user['id'];
            // ログインユーザーの店舗情報取得
            $shop = $this->Shops->find('all', [
                'conditions' => ['user_id' => $id]
            ])->first();
            // 未登録なら登録画面へ
            if ( empty($shop) ) {
                return $this->redirect(['action' => 'add']);
            }
        } else {
        // 本部権限
            $shop = $this->Shops->get($id, [
                'contain' => [],
            ]);
        }

        $this->set(compact('shop'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $shop = $this->Shops->newEmptyEntity();
        if ($this->request->is('post')) {
            $shop = $this->Shops->patchEntity($shop, $this->request->getData());

            // 画像
            $shop_image = $this->request->getData('shop_image');
            if ( !empty($shop_image) ) {
                $shop_image_name = uniqid().'.'. pathinfo( $shop_image->getClientFilename(), PATHINFO_EXTENSION);
                // データベース保存用にファイル名をセット
                $shop->shop_image = $shop_image_name;
                // /webroot/upload/ファイル名 にアップロード
                $path = WWW_ROOT . 'upload' . DS . $shop_image_name;
                $shop_image->moveTo($path);
            }

            $login_user = $this->Auth->user();
            $shop['user_id'] = $login_user['id'];
            if ($this->Shops->save($shop)) {
                $this->Flash->success(__('店舗情報を保存しました。'));

                // 店舗権限
                if ( $login_user['role'] === 'shop' ) {
                    return $this->redirect(['action' => 'view']);
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('店舗情報を保存できませんでした。'));
        }
        $this->set(compact('shop'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $shop = $this->Shops->get($id, [
            'contain' => [],
        ]);

        $login_user = $this->Auth->user();
        // 店舗権限
        if ( $login_user['role'] === 'shop' ) {
            // アクセス可能なお知らせか
            if ($shop->id != $login_user['id']) {
                $this->Flash->error(__('閲覧権限がありません。'));
                return $this->redirect(['action' => 'view']);
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $shop = $this->Shops->patchEntity($shop, $this->request->getData());

            // 画像
            $shop_image = $this->request->getData('shop_image');
            $file_name = $shop_image->getClientFilename();
            if ( !empty($file_name) ) {
                $shop_image_name = uniqid().'.'. pathinfo( $file_name, PATHINFO_EXTENSION);
                // データベース保存用にファイル名をセット
                $shop->shop_image = $shop_image_name;
                // /webroot/upload/ファイル名 にアップロード
                $path = WWW_ROOT . 'upload' . DS . $shop_image_name;
                $shop_image->moveTo($path);
            } else {
                $shop->shop_image = $shop->shop_image;
            }

            if ($this->Shops->save($shop)) {
                $this->Flash->success(__('店舗情報を保存しました。'));

                $login_user = $this->Auth->user();
                // 店舗権限
                if ( $login_user['role'] === 'shop' ) {
                    return $this->redirect(['action' => 'view']);
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('店舗情報を保存できませんでした。'));
        }
        $this->set(compact('shop'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Shop id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $shop = $this->Shops->get($id);
        if ($this->Shops->delete($shop)) {
            $this->Flash->success(__('店舗情報を削除しました。'));
        } else {
            $this->Flash->error(__('店舗情報を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
