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
namespace App\Controller\Admin;

use Cake\Controller\Controller;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/4/en/controllers.html#the-app-controller
 */
class AdminController extends Controller
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

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        /*
         * Enable the following component for recommended CakePHP form protection settings.
         * see https://book.cakephp.org/4/en/controllers/components/form-protection.html
         */
        //$this->loadComponent('FormProtection');

        // Authコンポーネント
        $this->loadComponent('Auth', [
            // ログイン後にリダイレクトを行うページ
            'loginRedirect' => [
                'controller' => 'Pages',
                'action' => 'admin'
            ],
            // ログアウト後にリダイレクトを行うページ
            'logoutRedirect' => [
                'controller' => 'Users',
                'action' => 'login'
            ],
            // 認証ハンドラー
            'authenticate' => [
                // 「Form」の部分は「Basic」および「Digest」の設定が可能
                'Form' => [
                  'userModel' => 'Users',
                  'fields' => [
                    'username' => 'username',
                    'password' => 'password'
                  ]
                ]
            ],
            // 認可ハンドラー
            'authorize'=> 'Controller',
            // メッセージ
            'authError' => '閲覧権限がありません。',
            'flash' => [
                'element' => 'error'
            ]
        ]);

        // 認証処理の例外になるページを指定（login・addは、ログインをしなくても呼び出せる）
        $this->Auth->allow(['login']);

        // ログインしているユーザーの情報を取得して呼び出せるように
        $login_user = $this->Auth->user();
        $this->set('login_user', $login_user);
    }

    // ControllerAuthorize の利用
    public function isAuthorized($user = null)
    {
        // admin ユーザーだけが index にアクセス可能（お知らせ情報 以外）
        if ($this->request->getParam('action') === 'index' && $this->request->getParam('controller') !== 'News') {
            return (bool)($user['role'] === 'admin');
        }

        // // デフォルトは拒否
        // return false;
        // 一旦許可
        return true;
    }
}
