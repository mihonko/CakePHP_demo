<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News $news
 */
?>
<?php $this->assign('title', 'お知らせ情報 詳細'); ?>
<?php $this->Html->css('admin', ['block' => true]); ?>

<div class="column-responsive column-80">
<?= $this->Flash->render() ?>
    <div class="shops view content">
        <h3>お知らせ情報 詳細</h3>
        <table>
            <tr>
                <th><?= __('ID') ?></th>
                <td><?= h($news->id) ?></td>
            </tr>
            <?php if ($login_user['role'] === 'admin'): ?>
            <tr>
                <th><?= __('店舗') ?></th>
                <td><?= h($shops[$news->shop_id]) ?></td>
            </tr>
            <?php endif; ?>
            <tr>
                <th><?= __('有効 / 無効') ?></th>
                <td>
                  <?php if ( $news->is_valid == 0 ): ?>
                    無効
                  <?php elseif ( $news->is_valid == 1 ): ?>
                    有効
                  <?php endif; ?>
                </td>
            </tr>
            <tr>
                <th><?= __('公開日') ?></th>
                <td><?= h($news->release_date) ?> ～ <?= $news->release_end_date ?></td>
            </tr>
            <tr>
                <th><?= __('タイトル') ?></th>
                <td><?= h($news->title) ?></td>
            </tr>
            <tr>
                <th><?= __('本文') ?></th>
                <td><?= nl2br($news->text) ?></td>
            </tr>
        </table>
        <div style="margin: 20px 0; display: flex; justify-content: space-between;">
            <?= $this->Html->link(__('編集'), ['action' => 'edit', $news->id], ['class' => 'button']) ?>
            <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $news->id], ['confirm' => __('Are you sure you want to delete # {0}?', $news->id), 'class' => 'side-nav-item']) ?>
        </div>
    </div>
</div>
