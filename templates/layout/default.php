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

$siteTitle = ' | CakeCakeCake';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
      <?= $this->fetch('title') ?>
      <?= $siteTitle ?>
    </title>
    <?= $this->Html->meta('icon') ?>

    <link href="https://fonts.googleapis.com/css?family=Raleway:400,700" rel="stylesheet">

    <?= $this->Html->css(['destyle', 'base']) ?>


    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
</head>
<body>
    <header>
        <div class="logo">
            <a href="/">CakeCakeCake</a>
        </div>
        <nav>
          <ul>
            <a href="/shop/list"><li>店舗一覧</li></a>
            <a href="/news/list"><li>店舗からの新着情報</li></a>
          </ul>
        </nav>
    </header>
    <?= $this->fetch('content') ?>
    <footer>
        <div class="footer-text">
            <p><small>&copy; 2021 CakeCakeCake</small></p>
        </div>
    </footer>
</body>
</html>
