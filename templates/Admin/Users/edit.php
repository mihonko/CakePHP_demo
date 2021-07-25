<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', 'ユーザー情報 編集'); ?>
<?php $this->Html->css('admin', ['block' => true]); ?>

<div class="column-responsive column-80">
  <?= $this->Flash->render() ?>
    <div class="users form content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <h3>ユーザー情報 編集</h3>
            <table>
              <?= $this->Form->hidden('id'); ?>
              <tr>
                <th>ユーザー名</th>
                <td>
                  <?php
                  echo $this->Form->text('username');
                  if ($this->Form->isFieldError('username')) {
                      echo $this->Form->error('username');
                  }?>
                </td>
              </tr>
              <tr>
                <th>パスワード</th>
                <td>
                  <?php
                  echo $this->Form->password('new_password', ['placeholder' => '変更したい場合は入力してください']);
                  if ($this->Form->isFieldError('new_password')) {
                      echo $this->Form->error('new_password');
                  }?>
                </td>
              </tr>
              <?php if ($login_user['role'] === 'admin'): ?>
              <tr>
                <th>権限</th>
                <td>
                  <?php
                  echo $this->Form->radio('role',     [
                      ['value' => 'admin', 'text' => '本部',],
                      ['value' => 'shop', 'text' => '店舗'],
                  ]);
                  if ($this->Form->isFieldError('role')) {
                      echo $this->Form->error('role');
                  }?>
                </td>
              </tr>
              <?php endif; ?>
            </table>
        </fieldset>
        <?= $this->Form->button(__('送信')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
