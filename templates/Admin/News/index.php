<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News[]|\Cake\Collection\CollectionInterface $news
 */
?>
<?php $this->assign('title', 'お知らせ一覧'); ?>
<?php $this->Html->css('admin_index', ['block' => true]); ?>

<div class="column-responsive column-80">
<?= $this->Flash->render() ?>
    <div class="shops index content">
        <?= $this->Html->link(__('お知らせ 新規追加'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <h3><?= __('お知らせ一覧') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                        <?php if ($login_user['role'] === 'admin'): ?>
                          <th><?= $this->Paginator->sort('shop_id', '店舗') ?></th>
                        <?php endif; ?>
                        <th><?= $this->Paginator->sort('title', 'タイトル') ?></th>
                        <th><?= $this->Paginator->sort('created', '登録日') ?></th>
                        <th><?= $this->Paginator->sort('modified', '更新日') ?></th>
                        <th class="actions"><?= __('アクション') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( count($news) > 0 ): ?>
                        <?php foreach ($news as $news): ?>
                        <tr>
                            <td><?= $this->Number->format($news->id) ?></td>
                            <?php if ($login_user['role'] === 'admin'): ?>
                              <td><?= h($shops[$news->shop_id]) ?></td>
                            <?php endif; ?>
                            <td><?= h($news->title) ?></td>
                            <td><?= h($news->created) ?></td>
                            <td><?= h($news->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('詳細'), ['action' => 'view', $news->id]) ?>
                                <?= $this->Html->link(__('編集'), ['action' => 'edit', $news->id]) ?>
                                <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id)]) ?>
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
