<?php
declare(strict_types=1);

namespace App\Controller\Admin;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AdminController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $users = $this->paginate($this->Users);

        $this->set(compact('users'));
    }

    /**
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $login_user = $this->Auth->user();
        // ユーザー権限
        if ( $login_user['role'] === 'shop' ) {
            $id = $login_user['id'];
        }
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $this->set(compact('user'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $user = $this->Users->newEmptyEntity();
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザー情報を保存しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('ユーザー情報を保存できませんでした。'));
        }
        $this->set(compact('user'));
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => [],
        ]);

        $login_user = $this->Auth->user();
        // 店舗権限
        if ( $login_user['role'] === 'shop' ) {
            // アクセス可能なお知らせか
            if ($user->id != $login_user['id']) {
                $this->Flash->error(__('閲覧権限がありません。'));
                return $this->redirect(['action' => 'view']);
            }
        }

        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());

            // パスワード
            $new_password = $this->request->getData('new_password');
            if ( !empty($new_password) ) {
                $user->password = $new_password;
            }

            if ($this->Users->save($user)) {
                $this->Flash->success(__('ユーザー情報を保存しました。'));

                $login_user = $this->Auth->user();
                // ユーザー権限
                if ( $login_user['role'] === 'shop' ) {
                    return $this->redirect(['action' => 'view']);
                }

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('ユーザー情報を保存できませんでした。'));
        }
        $this->set(compact('user'));
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('ユーザー情報を削除しました。'));
        } else {
            $this->Flash->error(__('ユーザー情報を削除できませんでした。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    # 上記までは『bin/cake bake all users』で作成される。認証のために、以下のメソッドを追加

    public function login()
    {
        if ($this->request->is('post')) {
            $user = $this->Auth->identify();
            if ($user) {
                $this->Auth->setUser($user);
                return $this->redirect($this->Auth->redirectUrl());
            }
            $this->Flash->error(__('ユーザー名またはパスワードが無効です。再試行してください。'));
        }
    }
    public function logout()
    {
        return $this->redirect($this->Auth->logout());
    }
}
