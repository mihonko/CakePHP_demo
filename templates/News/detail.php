<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\News[]|\Cake\Collection\CollectionInterface $news
 */
?>
<?php $this->assign('title', h($news->title).' | '.h($news->shop->shopname)); ?>
<?php $this->Html->css('news_detail', ['block' => true]); ?>

<div class="content">
    <div class="main-menu">
          <div class="main-item">
            <div class="main-container">
              <h2><?= h($news->shop->shopname) ?> からのお知らせ</h2>
              <div class="news-container">
                <article class="">
                  <div class="title-area">
                    <h3><?= h($news->title) ?></h3>
                    <span><?= h($news->release_date) ?></span>
                  </div>
                  <div class="text-container">
                    <?= nl2br($news->text) ?>
                  </div>
                  <div class="shop-link">
                    <a href="/shop/detail/<?= h($news->shop->id) ?>">店舗詳細ページへ</a>
                  </div>
                </article>
              </div>
            </div>
          </div>
    </div>
</div>
