<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$adminTitle = ' | 管理画面';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $this->fetch('title') ?>
        <?= $adminTitle ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <?= $this->Html->css(['normalize.min', 'milligram.min', 'cake']) ?>

    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" integrity="sha512-uto9mlQzrs59VwILcLiRYeLKPPbS/bT71da/OEBYEwcdNUk8jYIy+D176RYoop1Da+f9mvkYrmj5MCLZWEtQuA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


    <?= $this->fetch('script') ?>
</head>
<body>
    <nav class="top-nav">
        <div class="top-nav-title">
            <!-- <a href="<?= $this->Url->build('/admin/') ?>"><span>Cake</span>PHP</a> -->
            <a href="<?= $this->Url->build('/admin') ?>"><span>管理画面</span></a>
        </div>
        <div class="top-nav-links">
            <!-- ログイン時のみログアウトボタン表示 -->
            <?php if (isset($login_user) &&  strpos($_SERVER['REQUEST_URI'], 'login') === false): ?>
                <a href="/admin/users/logout">ログアウト</a>
            <?php endif; ?>
        </div>
    </nav>
    <main class="main">
        <div class="container">
            <div class="row">
                <?php if (isset($login_user) && strpos($_SERVER['REQUEST_URI'], 'login') === false): ?>
                    <aside class="column">
                        <div class="side-nav">
                            <?php if ($login_user['role'] === 'admin'): ?>
                                <?= $this->Html->link(__('ユーザー一覧'), '/admin/users', ['class' => 'side-nav-item']) ?>
                                <?= $this->Html->link(__('店舗一覧'), '/admin/shops', ['class' => 'side-nav-item']) ?>
                            <?php else: ?>
                                <?= $this->Html->link(__('ユーザー情報'), '/admin/users/view', ['class' => 'side-nav-item']) ?>
                                <?= $this->Html->link(__('店舗情報'), '/admin/shops/view', ['class' => 'side-nav-item']) ?>
                            <?php endif; ?>
                            <?= $this->Html->link(__('お知らせ一覧'), '/admin/news', ['class' => 'side-nav-item']) ?>
                        </div>
                    </aside>
                <?php endif; ?>
                <?= $this->fetch('content') ?>
            </div>
        </div>
    </main>
    <footer>
    </footer>
</body>
</html>
