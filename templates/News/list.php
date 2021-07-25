<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News[]|\Cake\Collection\CollectionInterface $news
 */
?>
<?php $this->assign('title', '店舗からの新着情報'); ?>
<?php $this->Html->css('shop_list', ['block' => true]); ?>

<div class="content">
    <div class="main-menu">
        <div class="main-item">
            <div class="main-container">
                <h2>店舗からの新着情報</h2>
                <div class="news-container">
                  <ul>
                    <?php foreach ($news as $news): ?>
                      <a href="/news/detail/<?= h($news->id) ?>"><li><span><?= h($news->release_date) ?></span><?= h($news->shop->shopname) ?> <?= h($news->title) ?></li></a>
                    <?php endforeach; ?>
                  </ul>
                  <div class="paginator">
                      <ul class="pagination">
                          <?= $this->Paginator->prev('< ' . __('前へ')) ?>
                          <?= $this->Paginator->numbers() ?>
                          <?= $this->Paginator->next(__('次へ') . ' >') ?>
                      </ul>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>
