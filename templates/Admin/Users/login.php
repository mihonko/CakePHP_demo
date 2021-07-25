<?php $this->assign('title', 'ログイン'); ?>

<div class="users form large-9 medium-8 columns content" style="width: 70%; margin: 0 auto;">
    <?= $this->Flash->render() ?>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('username', ['label'=>['text'=>'ユーザー名']]) ?>
        <?= $this->Form->control('password', ['label'=>['text'=>'パスワード']]) ?>
    </fieldset>
    <?= $this->Form->button(__('ログイン')) ?>
    <?= $this->Form->end() ?>
</div>
