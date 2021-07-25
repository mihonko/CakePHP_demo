<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Shop[]|\Cake\Collection\CollectionInterface $shops
 */
$title = isset($pref_name) ? $pref_name.'の店舗一覧' : '店舗一覧';
?>
<?php $this->assign('title', $title); ?>
<?php $this->Html->css('shop_list', ['block' => true]); ?>

<div class="content">
    <div class="main-menu">
        <div class="main-item">
            <div class="main-container">
                <h2><?= $title ?></h2>
                <?php if ( count($shops) > 0 ): ?>
                    <div class="shop-item">
                      <?php foreach ($shops as $shop): ?>
                          <a class="shop-container" href="/shop/detail/<?= $shop->id ?>">
                              <?php if ($shop->shop_image): ?>
                                  <img class="shop-image" src="/upload/<?= $shop->shop_image ?>" alt="店舗画像">
                              <?php else: ?>
                                  <img class="shop-image" src="/img/no_image_w3h2.png" alt="NO IMAGE">
                              <?php endif; ?>
                              <p class="shopname"><?= h($shop->shopname) ?></p>
                              <div class="shop-address">
                                <p>〒<?= h($shop->postcode) ?></p>
                                <p><?= h(Cake\Core\Configure::read('pref')[$shop->pref_id]) ?><?= h($shop->address) ?></p>
                              </div>
                              <p class="shop-tel">Tel：<?= h($shop->tel) ?></p>
                              <!-- <button type="button" name="button">詳細へ</button> -->
                          </a>
                      <?php endforeach; ?>
                    </div>
                    <div class="paginator">
                        <ul class="pagination">
                            <?= $this->Paginator->prev('< ' . __('前へ')) ?>
                            <?= $this->Paginator->numbers() ?>
                            <?= $this->Paginator->next(__('次へ') . ' >') ?>
                        </ul>
                    </div>
                <?php else: ?>
                    <div class="no-item">
                      <p>表示できる情報がありません</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
