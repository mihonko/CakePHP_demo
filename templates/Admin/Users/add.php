<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', 'ユーザー情報 登録'); ?>
<?php $this->Html->css('admin', ['block' => true]); ?>

<div class="column-responsive column-80">
  <?= $this->Flash->render() ?>
    <div class="users form content">
        <?= $this->Form->create($user) ?>
        <fieldset>
            <h3>ユーザー情報 登録</h3>
            <table>
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
                  echo $this->Form->password('password');
                  if ($this->Form->isFieldError('password')) {
                      echo $this->Form->error('password');
                  }?>
                </td>
              </tr>
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
            </table>
        </fieldset>
        <?= $this->Form->button(__('送信')) ?>
        <?= $this->Form->end() ?>
    </div>
</div>
