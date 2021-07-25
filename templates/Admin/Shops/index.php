<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop[]|\Cake\Collection\CollectionInterface $shops
 */
?>
<?php $this->assign('title', '店舗一覧'); ?>
<?php $this->Html->css('admin_index', ['block' => true]); ?>

<div class="column-responsive column-80">
<?= $this->Flash->render() ?>
    <div class="shops index content">
        <?= $this->Html->link(__('店舗 新規追加'), ['action' => 'add'], ['class' => 'button float-right']) ?>
        <h3><?= __('店舗一覧') ?></h3>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th><?= $this->Paginator->sort('id', 'ID') ?></th>
                        <th><?= $this->Paginator->sort('shopname', '店舗名') ?></th>
                        <th><?= $this->Paginator->sort('pref_id', '都道府県') ?></th>
                        <th><?= $this->Paginator->sort('created', '登録日') ?></th>
                        <th><?= $this->Paginator->sort('modified', '更新日') ?></th>
                        <th class="actions"><?= __('アクション') ?></th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ( count($shops) > 0 ): ?>
                        <?php foreach ($shops as $shop): ?>
                        <tr>
                            <td><?= $this->Number->format($shop->id) ?></td>
                            <td><?= h($shop->shopname) ?></td>
                            <td><?= $shop->pref_id > 0 ? h(Cake\Core\Configure::read('pref')[$shop->pref_id]) : '' ?></td>
                            <td><?= h($shop->created) ?></td>
                            <td><?= h($shop->modified) ?></td>
                            <td class="actions">
                                <?= $this->Html->link(__('詳細'), ['action' => 'view', $shop->id]) ?>
                                <?= $this->Html->link(__('編集'), ['action' => 'edit', $shop->id]) ?>
                                <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shop->id)]) ?>
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
