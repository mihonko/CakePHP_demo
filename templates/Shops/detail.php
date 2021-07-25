<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop[]|\Cake\Collection\CollectionInterface $shops
 */
?>
<?php $this->assign('title', h($shop->shopname)); ?>
<?php $this->Html->css('shop_detail', ['block' => true]); ?>

<div class="content">
    <div class="main-menu">
        <div class="main-item">
            <div class="main-container">
                <h2><?= h($shop->shopname) ?></h2>
                <div class="shop-container">
                  <div class="shop-image">
                    <?php if ($shop->shop_image): ?>
                      <img src="/upload/<?= $shop->shop_image ?>" alt="店舗画像">
                    <?php else: ?>
                      <img src="/img/no_image_w3h2.png" alt="NO IMAGE">
                    <?php endif; ?>
                  </div>
                  <table>
                          <th><?= __('住所') ?></th>
                          <td>
                            〒<?= h($shop->postcode) ?><br>
                            <?= h(Cake\Core\Configure::read('pref')[$shop->pref_id]) ?><?= h($shop->address) ?>
                          </td>
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
                      <caption>最終更新日：<?= date('Y/m/d', strtotime($shop->modified)) ?></caption>
                  </table>
                </div>
                <?php if ($shop->free_test): ?>
                  <div class="free_test">
                    <?= nl2br($shop->free_test) ?>
                  </div>
                <?php endif; ?>
            </div>
        </div>
        <?php if ($shop->news->count()): ?>
          <div class="main-item">
            <div class="main-container">
              <h2>店舗からのお知らせ</h2>
              <div class="news-container">
                <ul>
                  <?php foreach ($shop->news as $news): ?>
                    <a href="/news/detail/<?= h($news->id) ?>"><li><span><?= h($news->release_date) ?></span><?= h($news->title) ?></li></a>
                  <?php endforeach; ?>
                </ul>
              </div>
            </div>
          </div>
        <?php endif; ?>
    </div>
</div>
