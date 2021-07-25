<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop $shop
 */
?>
<?php $this->assign('title', '店舗情報 詳細'); ?>
<?php $this->Html->css('admin', ['block' => true]); ?>

<div class="column-responsive column-80">
<?= $this->Flash->render() ?>
    <div class="shops view content">
        <h3>店舗情報 詳細</h3>
        <table>
            <tr>
                <th><?= __('ID') ?></th>
                <td><?= h($shop->id) ?></td>
            </tr>
            <tr>
                <th><?= __('店舗名') ?></th>
                <td><?= h($shop->shopname) ?></td>
            </tr>
            <tr>
                <th><?= __('郵便番号') ?></th>
                <td><?= h($shop->postcode) ?></td>
            </tr>
            <tr>
                <th><?= __('都道府県') ?></th>
                <td><?= h(Cake\Core\Configure::read('pref')[$shop->pref_id]) ?></td>
            </tr>
            <tr>
                <th><?= __('住所（市区町村以下）') ?></th>
                <td><?= h($shop->address) ?></td>
            </tr>
            <tr>
                <th><?= __('電話番号') ?></th>
                <td><?= h($shop->tel) ?></td>
            </tr>
            <tr>
                <th><?= __('営業時間') ?></th>
                <td><?= nl2br($shop->business_hours) ?></td>
            </tr>
            <tr>
                <th><?= __('定休日') ?></th>
                <td><?= nl2br($shop->regular_holiday) ?></td>
            </tr>
            <tr>
                <th><?= __('フリーテキスト') ?></th>
                <td><?= nl2br($shop->free_test) ?></td>
            </tr>
            <tr>
                <th><?= __('登録日') ?></th>
                <td><?= h($shop->created) ?></td>
            </tr>
            <tr>
                <th><?= __('更新日') ?></th>
                <td><?= h($shop->modified) ?></td>
            </tr>
            <tr>
                <th><?= __('店舗画像') ?></th>
                <td>
                  <?php if ($shop->shop_image): ?>
                    <img src="/upload/<?= $shop->shop_image ?>" alt="店舗画像" style="max-height: 200px;">
                  <?php endif; ?>
                </td>
            </tr>
        </table>
        <div style="margin: 20px 0; display: flex; justify-content: space-between;">
            <?= $this->Html->link(__('編集'), ['action' => 'edit', $shop->id], ['class' => 'button']) ?>
            <?= $this->Form->postLink(__('削除'), ['action' => 'delete', $shop->id], ['confirm' => __('Are you sure you want to delete # {0}?', $shop->id), 'class' => 'side-nav-item']) ?>
        </div>
    </div>
</div>
