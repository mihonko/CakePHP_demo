<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\User[]|\Cake\Collection\CollectionInterface $users
 */
?>
<?php $this->assign('title', 'ユーザー一覧'); ?>
<?php $this->Html->css('admin_index', ['block' => true]); ?>

<div class="column-responsive column-80">
<?= $this->Flash->render() ?>
    <div class="users index content">
        <?= $this->Html->link(__('ユーザー 新規追加'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <h3><?= __('ユーザー一覧') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                        <th><?= $this->Paginator->sort('username', 'ユーザー名') ?></th>
                        <th><?= $this->Paginator->sort('role', '権限') ?></th>
                        <th><?= $this->Paginator->sort('created', '登録日') ?></th>
                        <th><?= $this->Paginator->sort('modified', '更新日') ?></th>
                        <th class="actions"><?= __('アクション') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( count($users) > 0 ): ?>
                        <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?= $this->Number->format($user->id) ?></td>
                            <td><?= h($user->username) ?></td>
                            <td>
                              <?php if ( $user->role == 'admin' ): ?>
                                本部
                              <?php elseif ( $user->role == 'shop' ): ?>
                                店舗
                              <?php endif; ?>
                            </td>
                            <td><?= h($user->created) ?></td>
                            <td><?= h($user->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('詳細'), ['action' => 'view', $user->id]) ?>
                                <?= $this->Html->link(__('編集'), ['action' => 'edit', $user->id]) ?>
                                <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $user->id], ['confirm' => __('Are you sure you want to delete # {0}?', $user->id)]) ?>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                          <td colspan="6" style="text-align: center;">表示できる情報がありません</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="paginator">
            <ul class="pagination">
                <?= $this->Paginator->first('<< ' . __('最初へ')) ?>
                <?= $this->Paginator->prev('< ' . __('前へ')) ?>
                <?= $this->Paginator->numbers() ?>
                <?= $this->Paginator->next(__('次へ') . ' >') ?>
                <?= $this->Paginator->last(__('最後へ') . ' >>') ?>
            </ul>
            <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
        </div>
    </div>
</div>
