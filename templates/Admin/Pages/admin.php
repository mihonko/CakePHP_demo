<?php
/**
 * @var \App\View\AppView $this
 */
?>
<?php $this->assign('title', 'メニュー'); ?>

<div class="column-responsive column-80">
  <?= $this->Flash->render() ?>
    <div class="admin index content">
        <?php if ($login_user['role'] === 'admin'): ?>
            <?= $this->Html->link(__('ユーザー一覧'), '/admin/users', ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('ユーザー登録'), '/admin/users/add', ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('店舗一覧'), '/admin/shops', ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('店舗登録'), '/admin/shops/add', ['class' => 'side-nav-item']) ?>
        <?php else: ?>
            <?= $this->Html->link(__('ユーザー情報'), '/admin/users/view', ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('店舗情報'), '/admin/shops/view', ['class' => 'side-nav-item']) ?>
        <?php endif; ?>
        <?= $this->Html->link(__('お知らせ一覧'), '/admin/news', ['class' => 'side-nav-item']) ?>
        <?= $this->Html->link(__('お知らせ登録'), '/admin/news/add', ['class' => 'side-nav-item']) ?>
    </div>
</div>
