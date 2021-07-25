<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User $user
 */
?>
<?php $this->assign('title', 'ユーザー情報 詳細'); ?>
<?php $this->Html->css('admin', ['block' => true]); ?>

<div class="column-responsive column-80">
<?= $this->Flash->render() ?>
    <div class="users view content">
        <h3>ユーザー情報 詳細</h3>
        <table>
            <tr>
                <th><?= __('ID') ?></th>
                <td><?= $this->Number->format($user->id) ?></td>
            </tr>
            <tr>
                <th><?= __('ユーザー名') ?></th>
                <td><?= h($user->username) ?></td>
            </tr>
            <?php if ($login_user['role'] === 'admin'): ?>
            <tr>
                <th><?= __('権限') ?></th>
                <td>
                  <?php if ( $user->role == 'admin' ): ?>
                    本部
                  <?php elseif ( $user->role == 'shop' ): ?>
                    店舗
                  <?php endif; ?>
                </td>
            </tr>
            <?php endif; ?>
            <tr>
                <th><?= __('登録日') ?></th>
                <td><?= h($user->created) ?></td>
            </tr>
            <tr>
                <th><?= __('更新日') ?></th>
                <td><?= h($user->modified) ?></td>
            </tr>
        </table>
        <div style="margin: 20px 0; display: flex; justify-content: space-between;">
            <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id], ['class' => 'button']) ?>
            <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id), 'class' => 'side-nav-item']) ?>
        </div>
    </div>
</div>
